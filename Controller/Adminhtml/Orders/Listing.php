<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 05.07.19
 * Time: 10:19
 */

namespace MyModules\QuickOrder\Controller\Adminhtml\Orders;

use MyModules\QuickOrder\Controller\Adminhtml\MyBaseQuickOrder;

class Listing extends MyBaseQuickOrder
{
    const ACL_RESOURCE      = 'MyModules_QuickOrder::grid';
    const MENU_ITEM         = 'MyModules_QuickOrder::grid';
    const PAGE_TITLE        = 'Order Grid';
    const BREADCRUMB_TITLE  = 'Order Grid';
}