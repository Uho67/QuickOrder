<?php

namespace MyModules\QuickOrder\Model;

/**
 * Class Status
 * @package MyModules\QuickOrder\Model
 */
class Status extends \Magento\Framework\Model\AbstractModel implements \MyModules\QuickOrder\Api\Status\StatusInterface
{
    /** {@inheritdoc} */
    public function _construct()
    {
        $this->_init(\MyModules\QuickOrder\Model\ResourceModel\Status::class);
    }
    /** {@inheritdoc} */
    public function getName()
    {
        return $this->getData(\MyModules\QuickOrder\Api\Status\StatusInterface::NAME_FIELD);
    }
    /** {@inheritdoc} */
    public function setName($name)
    {
        $this->setData(\MyModules\QuickOrder\Api\Status\StatusInterface::NAME_FIELD, $name);
        return $this;
    }
}
