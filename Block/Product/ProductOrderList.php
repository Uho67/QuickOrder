<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 13.08.19
 * Time: 14:33
 */

namespace MyModules\QuickOrder\Block\Product;

use Magento\Catalog\Block\Product\ProductList\Item\Block;
use Magento\Customer\Model\SessionFactory;
use Magento\Catalog\Block\Product\Context;

class ProductOrderList extends Block
{
    private $name = '';
    private $phone = '';
    private $email = '';

    public function __construct(SessionFactory $sessionFactory,Context $context, array $data = [])
    {
        if ($sessionFactory->create()->getCustomerId()) {
            $customer = $sessionFactory->create()->getCustomer();
            $this->name = $customer->getName();
            $this->email = $customer->getEmail();
            if ($customer->getDefaultShippingAddress()->getTelephone()) {
                $this->phone = $customer->getDefaultShippingAddress()->getTelephone();
            }
        }
        parent::__construct($context, $data);
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
