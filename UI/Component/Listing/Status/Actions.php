<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 05.07.19
 * Time: 16:46
 */

namespace MyModules\QuickOrder\UI\Component\Listing\Status;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class Actions extends Column
{
    const URL_PATH_DELETE = 'mymodules_quickorder/status/delete';
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
                if (isset($item['status_id'])) {
                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl(self::URL_PATH_DELETE, ['id' => $item['status_id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete this STATUS ?'),
                            'message' => __('Are you sure you wan\'t to delete this Status ? 
                            All orders who are in thise status will change to Deault Status')
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }


}