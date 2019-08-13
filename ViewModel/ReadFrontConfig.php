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

class ReadFrontConfig  implements ArgumentInterface , ConfigInterface
{
    protected $product;
    protected $helperProduct;

    public function __construct( Data $data)
    {
        $this->helperProduct = $data;
    }

    public function getProduct(){
            $this->product = $this->helperProduct->getProduct();
        return $this->product;
    }

}