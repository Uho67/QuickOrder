<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MyModules\QuickOrder\Controller\Adminhtml\Status;

use MyModules\QuickOrder\Controller\Adminhtml\MyBaseStatus as BaseAction;

class Create extends BaseAction
{
    const ACL_RESOURCE      = 'MyModules_QuickOrder::create';
    const MENU_ITEM         = 'MyModules_QuickOrder::create';
    const PAGE_TITLE        = 'Add Status';
    const BREADCRUMB_TITLE  = 'Add Status';

}
