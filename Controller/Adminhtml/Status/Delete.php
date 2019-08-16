<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MyModules\QuickOrder\Controller\Adminhtml\Status;

use MyModules\QuickOrder\Controller\Adminhtml\MyBaseStatus as BaseAction;

/**
 * Class Delete
 * @package MyModules\QuickOrder\Controller\Adminhtml\Status
 */
class Delete extends BaseAction
{
    const ACL_RESOURCE          = 'MyModules_QuickOrder::delete_status';
    /** {@inheritdoc} */
    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);
        if (!empty($id)) {
            try {
                $this->repository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('Status has been deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(_('Status can\'t delete'));
                return $this->doRefererRedirect();
            }
        } else {
            $this->logger->error(
                sprintf('Require parameter `%s` is missing', static::QUERY_PARAM_ID)
            );
            $this->messageManager->addMessage(__('No item to delete'));
        }
        return $this->redirectToGrid();
    }
}
