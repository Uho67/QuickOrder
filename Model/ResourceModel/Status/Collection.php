<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 06.07.19
 * Time: 2:28
 */

namespace MyModules\QuickOrder\Model\ResourceModel\Status;

/**
 * Class Collection
 * @package MyModules\QuickOrder\Model\ResourceModel\Status
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(\MyModules\QuickOrder\Model\Status::class, \MyModules\QuickOrder\Model\ResourceModel\Status::class);
    }
}
