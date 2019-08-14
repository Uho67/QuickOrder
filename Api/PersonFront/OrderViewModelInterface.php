<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 17.06.19
 * Time: 12:56
 */

namespace MyModules\QuickOrder\Api\PersonFront;


interface OrderViewModelInterface
{
    /**
     * @return \Magento\Catalog\Model\Product|null
     */
    public function getProduct();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getPhone();

    /**
     * @return string
     */
    public function getEmail();
}