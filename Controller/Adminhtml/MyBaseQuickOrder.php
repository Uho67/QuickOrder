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
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

use MyModules\QuickOrder\Api\Order\QuickOrderInterface;
use MyModules\QuickOrder\Api\QuickOrdersRepositoryInterface;
use MyModules\QuickOrder\Model\QuickOrdersFactory;

abstract class MyBaseQuickOrder extends Action
{
    const ACL_RESOURCE          = 'MyModules_QuickOrder::all';
    const MENU_ITEM             = 'MyModules_QuickOrder::all';
    const PAGE_TITLE            = 'MyModules_QuickOrder Quick Orders';
    const BREADCRUMB_TITLE      = 'Orders';
    const QUERY_PARAM_ID        = 'id';


    /** @var Registry  */
    protected $registry;

    /** @var PageFactory  */
    protected $pageFactory;

    /** @var  QuickOrdersFactory */
    protected $modelFactory;

    /** @var QuickOrderInterface */
    protected $model;

    /** @var Page */
    protected $resultPage;

    /** @var QuickOrdersRepositoryInterface */
    protected $repository;

    public function __construct(Registry $registry,Context $context,PageFactory $pageFactory,
                                QuickOrdersFactory $quickOrdersFactory,
                                QuickOrdersRepositoryInterface $quickOrdersRepository)
    {
        $this->registry     = $registry;
        $this->pageFactory  =  $pageFactory;
        $this->modelFactory = $quickOrdersFactory;
        $this->repository   = $quickOrdersRepository;
        parent::__construct($context);
    }

    /** @return QuickOrderInterface */
    protected function getModel()
    {
        if (null === $this->model) {
            $this->model = $this->modelFactory->create();
        }
        return $this->model;
    }

    protected function redirectLastPage()
    {
        $this->_redirect($this->_redirect->getRefererUrl());
        return;
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
     * @return ResponseInterface
     */
    protected function redirectToGrid()
    {
        return $this->_redirect('*/*/listing');
    }

    /**
     * @return Order
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