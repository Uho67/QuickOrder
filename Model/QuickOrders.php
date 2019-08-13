<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 04.07.19
 * Time: 22:05
 */

namespace MyModules\QuickOrder\Model;


class QuickOrders extends \Magento\Framework\Model\AbstractModel
    implements \MyModules\QuickOrder\Api\Order\QuickOrderInterface

{

    /** {@inheritdoc} */
    public function _construct()
    {
        $this->_init(\MyModules\QuickOrder\Model\ResourceModel\QuickOrders::class);
    }

    public function getName()
    {
        return $this->getData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::NAME_FIELD);
    }
    public function setName($name)
    {
        $this->setData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::NAME_FIELD, $name);
        return $this;
    }

    public function getSku()
    {
        return $this->getData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::SKU_FIELD);
    }
    public function setSku($sku)
    {
        $this->setData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::SKU_FIELD, $sku);
        return $this;
    }

    public function getEmail()
    {
        return $this->getData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::EMAIL_FIELD);

    }
    public function setEmail($email)
    {
        $this->setData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::EMAIL_FIELD, $email);
        return $this;
    }

    public function getPhone()
    {
        return $this->getData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::PHONE_FIELD);
    }
    public function setPhone($phone)
    {
        $this->setData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::PHONE_FIELD, $phone);
        return $this;
    }

    public function getStatus()
    {
        return $this->getData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::STATUS_FIELD);
    }

    public function setStatus($status)
    {
        $this->setData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::STATUS_FIELD, $status);
        return $this;
    }

    public function getCreateData()
    {
        return $this->getData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::CREATE_FIELD);
    }

    public function setCreateData($data)
    {
        return $this;
    }

    public function getUpdateData()
    {
        return $this->getData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::UPDATE_FIELD);
    }

    public function setUpdateData($data)
    {
        return $this;
    }



}