<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 06.07.19
 * Time: 2:01
 */

namespace MyModules\QuickOrder\Api\Status;


interface StatusInterface
{
    const TABLE_NAME                = 'my_status_quick_order_table';
    const ID_FIELD                  = 'status_id';
    const NAME_FIELD                = 'name';
    const CACHE_TAG                 = 'my_status_quick_order_table';
    const REGISTRY_KEY              = 'my_status_quick_order_table';

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @param $name
     * @return mixed
     */
    public function setName($name);

}