<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 05.07.19
 * Time: 10:19
 */

namespace MyModules\QuickOrder\Controller\Adminhtml\Status;

use MyModules\QuickOrder\Controller\Adminhtml\MyBaseStatus;

class Listing extends MyBaseStatus
{
    const ACL_RESOURCE      = 'MyModules_QuickOrder::status_grid';
    const MENU_ITEM         = 'MyModules_QuickOrder::status_grid';
    const PAGE_TITLE        = 'Status Grid';
    const BREADCRUMB_TITLE  = 'Status Grid';
}