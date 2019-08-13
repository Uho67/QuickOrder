<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 11.07.19
 * Time: 0:24
 */

namespace MyModules\QuickOrder\Controller\Adminhtml\Status;




use MyModules\QuickOrder\Api\Status\StatusInterface;
use MyModules\QuickOrder\Controller\Adminhtml\MyBaseStatus as BaseAction;


class Save extends BaseAction
{
    /** {@inheritdoc} */
    public function execute()
    {
        $isPost = $this->getRequest()->isPost();

        if ($isPost) {
            $model = $this->getModel();
            $formData = $this->getRequest()->getParam('status');

            if (empty($formData)) {
                $formData = $this->getRequest()->getParams();
            }

            if(!empty($formData[StatusInterface::ID_FIELD])) {
                $id = $formData[StatusInterface::ID_FIELD];
                $model = $this->repository->getById($id);
            } else {
                unset($formData[StatusInterface::ID_FIELD]);
            }

            $model->setData($formData);

            try {
                $model = $this->repository->save($model);
                $this->messageManager->addSuccessMessage(__('Status has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }

                return $this->redirectToGrid();
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(__('Status doesn\'t save' ));
            }

            $this->_getSession()->setFormData($formData);

            return (!empty($model->getId())) ?
                $this->_redirect('*/*/edit', ['id' => $model->getId()])
                : $this->_redirect('*/*/create');
        }

        return $this->doRefererRedirect();
    }

}