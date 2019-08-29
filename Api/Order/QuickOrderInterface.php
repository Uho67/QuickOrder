<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 04.07.19
 * Time: 21:21
 */

namespace MyModules\QuickOrder\Api\Order;

interface QuickOrderInterface
{
    const TABLE_NAME                = 'my_quick_order_table';
    const ID_FIELD                  = 'order_id';
    const NAME_FIELD                = 'name';
    const SKU_FIELD                 = 'sku';
    const EMAIL_FIELD               = 'email';
    const PHONE_FIELD               = 'phone';
    const STATUS_FIELD              = 'status';
    const CREATE_FIELD              = 'create_data';
    const UPDATE_FIELD              = 'update_data';
    const CUSTOMER_ID_FIELD         = 'customer_id';
    const CACHE_TAG                 = 'my_quick_order_table';
    const REGISTRY_KEY              = 'my_quick_order_table';

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @param $name
     * @return mixed
     */
    public function setName($name);

    /**
     * @return mixed
     */
    public function getSku();

    /**
     * @param $sku
     * @return mixed
     */
    public function setSku($sku);

    /**
     * @return mixed
     */
    public function getEmail();

    /**
     * @param $email
     * @return mixed
     */
    public function setEmail($email);

    /**
     * @return mixed
     */
    public function getPhone();

    /**
     * @param $phone
     * @return mixed
     */
    public function setPhone($phone);

    /**
     * @return mixed
     */
    public function getStatus();

    /**
     * @param $status
     * @return mixed
     */
    public function setStatus($status);

    /**
     * @return mixed
     */
    public function getCreateData();

    /**
     * @param $data
     * @return mixed
     */
    public function setCreateData($data);

    /**
     * @return mixed
     */
    public function getUpdateData();

    /**
     * @param $data
     * @return mixed
     */
    public function setUpdateData($data);

    /**
     * @param $id
     * @return mixed
     */
    public function setCustomerId($id);

    /**
     * @return mixed
     */
    public function getCustomerId();
}
