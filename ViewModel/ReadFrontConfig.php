<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 17.06.19
 * Time: 13:04
 */

namespace MyModules\QuickOrder\ViewModel;

use MyModules\QuickOrder\Api\PersonFront\ConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Helper\Data;
use Magento\Customer\Model\SessionFactory;

class ReadFrontConfig  implements ArgumentInterface , ConfigInterface
{
    private $name = '';
    private $phone = '';
    private $email = '';
    protected $helperProduct;

    public function __construct(SessionFactory $sessionFactory, Data $data)
    {
        if ($sessionFactory->create()->getCustomerId()) {
            $customer = $sessionFactory->create()->getCustomer();
            $this->name = $customer->getName();
            $this->email = $customer->getEmail();
            if ($customer->getDefaultShippingAddress()->getTelephone()) {
                $this->phone = $customer->getDefaultShippingAddress()->getTelephone();
            }
        }
        $this->helperProduct = $data;
    }

    public function getProduct()
    {
        return $this->helperProduct->getProduct();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

}