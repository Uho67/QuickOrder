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
/**
 * Class ProductOrderList
 * @package MyModules\QuickOrder\Block\Product
 */
class ProductOrderList extends Block
{
    /**
     * @var SessionFactory
     */
    private $sesionFactory;

    /**
     * ProductOrderList constructor.
     * @param SessionFactory $sessionFactory
     * @param Context $context
     * @param array $data
     */
    public function __construct(SessionFactory $sessionFactory, Context $context, array $data = [])
    {
        $this->sesionFactory  =  $sessionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getName()
    {
        if ($this->sesionFactory->create()->getCustomerId()) {
            return $this->name = $this->sesionFactory->create()->getCustomer()->getName();
        }
        return '';
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        if ($this->sesionFactory->create()->getCustomerId()) {
            return $this->email = $this->sesionFactory->create()->getCustomer()->getEmail();
        }
        return '';
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        if ($this->sesionFactory->create()->getCustomer()->getDefaultShippingAddress()) {
            return  $this->phone = $this->sesionFactory->create()->getCustomer()->getDefaultShippingAddress()->getTelephone();
        }
        return '';
    }
}
