<?php

namespace MyModules\QuickOrder\Controller\Adminhtml\Status;

use MyModules\QuickOrder\Controller\Adminhtml\MyBaseStatus as BaseAction;

/**
 * Class Create
 * @package MyModules\QuickOrder\Controller\Adminhtml\Status
 */
class Create extends BaseAction
{
    const ACL_RESOURCE      = 'MyModules_QuickOrder::create_status';
    const MENU_ITEM         = 'MyModules_QuickOrder::create_status';
    const PAGE_TITLE        = 'Add Status';
    const BREADCRUMB_TITLE  = 'Add Status';
}
