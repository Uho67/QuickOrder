<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 12.08.19
 * Time: 20:34
 */

namespace MyModules\QuickOrder\Controller\Save;

use Magento\Framework\App\Action\Action as BaseAction;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\SessionFactory;
use Magento\Framework\Controller\Result\JsonFactory;


class Customer extends BaseAction
{
    protected $_sessionFactory;
    protected $resultJsonFactory;
    public function __construct(JsonFactory $jsonFactory,
                                SessionFactory $sessionFactory,
                                Context $context)
    {
        $this->resultJsonFactory      = $jsonFactory;
        $this->_sessionFactory        = $sessionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $customer = $this->_sessionFactory->create()->getCustomer();
        $resultJson  =  $this->resultJsonFactory->create();
        if($customer->getId()){
            $name = $customer->getName();
            $email = $customer->getEmail();
            $phone = $customer->getDefaultShippingAddress()->getTelephone();

            return $resultJson->setData([
                'result' => 1,
                'name' => $name,
                'email' => $email,
                'phone' => $phone
            ]);
        }
            return $resultJson->setData([
                'result' => 0
            ]);

    }

}