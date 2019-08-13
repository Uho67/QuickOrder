<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 04.07.19
 * Time: 21:43
 */

namespace MyModules\QuickOrder\Model\ResourceModel;


class QuickOrders extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::TABLE_NAME, \MyModules\QuickOrder\Api\Order\QuickOrderInterface::ID_FIELD);
    }
}