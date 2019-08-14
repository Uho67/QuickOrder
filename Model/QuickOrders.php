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

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->getData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::NAME_FIELD);
    }

    /**
     * @param $name
     * @return $this|mixed
     */
    public function setName($name)
    {
        $this->setData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::NAME_FIELD, $name);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->getData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::SKU_FIELD);
    }

    /**
     * @param $sku
     * @return $this|mixed
     */
    public function setSku($sku)
    {
        $this->setData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::SKU_FIELD, $sku);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->getData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::EMAIL_FIELD);

    }

    /**
     * @param $email
     * @return $this|mixed
     */
    public function setEmail($email)
    {
        $this->setData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::EMAIL_FIELD, $email);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->getData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::PHONE_FIELD);
    }

    /**
     * @param $phone
     * @return $this|mixed
     */
    public function setPhone($phone)
    {
        $this->setData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::PHONE_FIELD, $phone);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->getData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::STATUS_FIELD);
    }

    /**
     * @param $status
     * @return $this|mixed
     */
    public function setStatus($status)
    {
        $this->setData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::STATUS_FIELD, $status);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreateData()
    {
        return $this->getData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::CREATE_FIELD);
    }

    /**
     * @param $data
     * @return $this|mixed
     */
    public function setCreateData($data)
    {
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdateData()
    {
        return $this->getData(\MyModules\QuickOrder\Api\Order\QuickOrderInterface::UPDATE_FIELD);
    }

    /**
     * @param $data
     * @return $this|mixed
     */
    public function setUpdateData($data)
    {
        return $this;
    }



}