<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 11.07.19
 * Time: 0:24
 */

namespace MyModules\QuickOrder\Controller\Adminhtml\Orders;




use MyModules\QuickOrder\Api\Order\QuickOrderInterface;
use MyModules\QuickOrder\Controller\Adminhtml\MyBaseQuickOrder as BaseAction;

class Save extends BaseAction
{
    const ACL_RESOURCE      = 'MyModules_QuickOrder::edit_order';
    /** {@inheritdoc} */
    public function execute()
    {
        $isPost = $this->getRequest()->isPost();
        if ($isPost) {
            $model = $this->getModel();
            $formData = $this->getRequest()->getParam('orders');

            if (empty($formData)) {
                $formData = $this->getRequest()->getParams();
            }
            unset($formData[QuickOrderInterface::ID_FIELD]);
            $model->setData($formData);

            try {
                $model = $this->repository->save($model);
                $this->messageManager->addSuccessMessage(__('Order has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }

                return $this->redirectToGrid();
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(__('Order doesn\'t save' ));
            }

            $this->_getSession()->setFormData($formData);
            return $this->_redirect('*/*/edit', ['id' => $model->getId()]);
        }

        return $this->doRefererRedirect();
    }

}