<?php


namespace MyModules\QuickOrder\Block\Adminhtml\QuickOrder;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

use MyModules\QuickOrder\Api\QuickOrdersRepositoryInterface;

class GenericButton
{
    /** @var Context */
    protected $context;

    /** @var QuickOrdersRepositoryInterface */
    protected $repository;

    public function __construct(
        Context $context,
        QuickOrdersRepositoryInterface $repository
    )
    {
        $this->context = $context;
        $this->repository = $repository;
    }

    /**
     * Return Order ID
     *
     * @return int|null
     */
    public function getOrderId()
    {
        try {
            return $this->repository->getById(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}