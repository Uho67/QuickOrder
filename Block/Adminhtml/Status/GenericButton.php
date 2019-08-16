<?php

namespace MyModules\QuickOrder\Block\Adminhtml\Status;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use MyModules\QuickOrder\Api\StatusRepositoryInterface;

class GenericButton
{
    /** @var Context */
    protected $context;

    /** @var StatusRepositoryInterface */
    protected $repository;

    /**
     * GenericButton constructor.
     * @param Context $context
     * @param StatusRepositoryInterface $repository
     */
    public function __construct(
        Context $context,
        StatusRepositoryInterface $repository
    ) {
        $this->context      = $context;
        $this->repository   = $repository;
    }

    /**
     * Return Status ID
     *
     * @return int|null
     */
    public function getStatusId()
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
