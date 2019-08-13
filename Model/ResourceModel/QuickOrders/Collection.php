<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 04.07.19
 * Time: 22:03
 */

namespace MyModules\QuickOrder\Model\ResourceModel\QuickOrders;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /** {@inheritdoc} */
    protected function _construct()
{
    $this->_init(\MyModules\QuickOrder\Model\QuickOrders::class, \MyModules\QuickOrder\Model\ResourceModel\QuickOrders::class);
}
}