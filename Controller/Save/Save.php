<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 04.07.19
 * Time: 22:42
 */

namespace MyModules\QuickOrder\Controller\Save;


use Magento\Framework\App\Config\ScopeConfigInterface;
use MyModules\QuickOrder\Api\QuickOrdersRepositoryInterface;

use MyModules\QuickOrder\Model\QuickOrdersFactory;
use Magento\Framework\App\Action\Action as BaseAction;
use Magento\Customer\Model\SessionFactory;

class Save extends BaseAction
{
    protected $scopeConfig;
    protected $ordersFactory;
    protected $ordersRepository;
    protected $sessionFactory;
    public function __construct(
        SessionFactory $sessionFactory,
        QuickOrdersRepositoryInterface $ordersRepository,
        QuickOrdersFactory $ordersFactory,
        \Magento\Framework\App\Action\Context $context,
     ScopeConfigInterface $scopeConfig)
    {
        $this->sessionFactory = $sessionFactory;
        $this->ordersRepository    = $ordersRepository;
        $this->ordersFactory       = $ordersFactory;
        $this->scopeConfig         = $scopeConfig;
        parent::__construct($context);
    }

    public function execute()
     {

         $isPost = $this->getRequest()->isPost();

         if ($isPost) {
             $model = $this->ordersFactory->create();
             $formData = $this->getRequest()->getParams();

             if(!isset($formData['status'])){
                 $storeTipe = \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE;
                 $path = 'my_quick_orders/general/default_status';
                 $result = $this->scopeConfig->getValue($path,$storeTipe);
                 $formData['status'] = $result;
             }
             $model->setData($formData);
             $this->ordersRepository->save($model);

         }
         $this->_redirect($this->_redirect->getRefererUrl());
     }


}