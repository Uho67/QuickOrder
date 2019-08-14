<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 04.07.19
 * Time: 21:09
 */

namespace MyModules\QuickOrder\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;

use MyModules\QuickOrder\Api\Status\StatusInterface;
use MyModules\QuickOrder\Api\StatusRepositoryInterface;
use MyModules\QuickOrder\Model\StatusFactory;
use Magento\Framework\Controller\ResultInterface;

abstract class MyBaseStatus extends Action
{
    const ACL_RESOURCE          = 'MyModules_QuickOrder::statusAll';
    const MENU_ITEM             = 'MyModules_QuickOrder::statusAll';
    const PAGE_TITLE            = 'MyModules_QuickOrder Status';
    const BREADCRUMB_TITLE      = 'Status';
    const QUERY_PARAM_ID        = 'id';

    /** @var PageFactory  */
    protected $pageFactory;

    /** @var  StatusFactory */
    protected $modelFactory;

    /** @var StatusInterface */
    protected $model;

    /** @var Page */
    protected $resultPage;

    /** @var StatusRepositoryInterface */
    protected $repository;

    /**
     * MyBaseStatus constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param StatusFactory $statusFactory
     * @param StatusRepositoryInterface $statusRepository
     */
    public function __construct(Context $context,PageFactory $pageFactory,
                                StatusFactory $statusFactory,
                                StatusRepositoryInterface $statusRepository)
    {
        $this->pageFactory  =  $pageFactory;
        $this->modelFactory = $statusFactory;
        $this->repository   = $statusRepository;
        parent::__construct($context);
    }

    /** @return StatusInterface */
    protected function getModel()
    {
        if (null === $this->model) {
            $this->model = $this->modelFactory->create();
        }
        return $this->model;
    }

    /**
     *
     */
    protected function redirectLastPage()
    {
        $this->_redirect($this->_redirect->getRefererUrl());
    }

    /** {@inheritdoc} */
    protected function _isAllowed()
    {
        $result = parent::_isAllowed();
        $result = $result && $this->_authorization->isAllowed(static::ACL_RESOURCE);

        return $result;
    }

    /**
     * @return Page
     */
    protected function _getResultPage()
    {
        if (null === $this->resultPage) {
            $this->resultPage = $this->pageFactory->create();
        }

        return $this->resultPage;
    }

    /** {@inheritdoc} */
    public function execute()
    {
        $this->_setPageData();
        return $this->resultPage;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface
     */
    protected function redirectToGrid()
    {
        return $this->_redirect('*/status/listing');
    }

    /**
     * @return $this
     */
    protected function _setPageData()
    {
        $resultPage = $this->_getResultPage();
        $resultPage->setActiveMenu(static::MENU_ITEM);
        $resultPage->getConfig()->getTitle()->prepend((__(static::PAGE_TITLE)));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));

        return $this;
    }
    /**
     * @return ResultInterface
     */

    protected function doRefererRedirect()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl($this->_redirect->getRefererUrl());

        return $redirect;
    }

}