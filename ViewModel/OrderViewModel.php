<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 17.06.19
 * Time: 13:04
 */

namespace MyModules\QuickOrder\ViewModel;

use MyModules\QuickOrder\Api\PersonFront\OrderViewModelInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Helper\Data;
use Magento\Customer\Model\SessionFactory;

/**
 * Class OrderViewModel
 * @package MyModules\QuickOrder\ViewModel
 */
class OrderViewModel implements ArgumentInterface, OrderViewModelInterface
{
    /**
     * @var Data
     */
    private $helperProduct;
    /**
     * @var SessionFactory
     */
    private $sesionFactory;
    /**
     * OrderViewModel constructor.
     * @param SessionFactory $sessionFactory
     * @param Data $data
     */
    public function __construct(SessionFactory $sessionFactory, Data $data)
    {
        $this->sesionFactory  =  $sessionFactory;
        $this->helperProduct = $data;
    }
    /**
     * @return \Magento\Catalog\Model\Product|null
     */
    public function getProduct()
    {
        return $this->helperProduct->getProduct();
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
    /**
     * @return false|string
     */
    public function getCustomerData()
    {
        $data = array();
        $data['name']  = $this->getName();
        $data['phone'] = $this->getPhone();
        $data['email'] = $this->getEmail();
        return json_encode($data);
    }
}
