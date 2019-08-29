<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 29.08.19
 * Time: 22:17
 */

namespace MyModules\QuickOrder\UI\Component\FrontendAction;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use Magento\Backend\Model\Auth\Session;

/**
 * Class Actions
 * @package MyModules\QuickOrder\UI\Component
 */
class Action extends Column
{
    const URL_PATH_CANCEL      = 'quick_order_frontend/order/cancel';
    /** @var UrlInterface */
    protected $urlBuilder;
    /**
     * @param ContextInterface      $context
     * @param UiComponentFactory    $uiComponentFactory
     * @param UrlInterface          $urlBuilder
     * @param array                 $components
     * @param array                 $data
     * @param string                $editUrl
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    /** {@inheritdoc} */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['order_id'])) {
                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl(self::URL_PATH_CANCEL, ['id' => $item['order_id']]),
                        'label' => __('Cancel'),
                        'confirm' => [
                            'title' => __('Cancel "${ $.$data.title }"'),
                            'message' => __('Are you sure you wan\'t to cancel a "${ $.$data.title }" record?')
                        ]
                    ];
                }
            }
        }
        return $dataSource;
    }
}
