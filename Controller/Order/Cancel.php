<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 29.08.19
 * Time: 22:21
 */

namespace MyModules\QuickOrder\Controller\Order;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use MyModules\QuickOrder\Api\QuickOrdersRepositoryInterface;

/**
 * Class Cancel
 * @package MyModules\QuickOrder\Controller\Order
 */
class Cancel extends Action
{
    const QUERY_PARAM_ID        = 'id';

    /**
     * @var QuickOrdersRepositoryInterface
     */
    private $repository;

    /**\
     * Cancel constructor.
     * @param QuickOrdersRepositoryInterface $ordersRepository
     * @param Context $context
     */
    public function __construct(QuickOrdersRepositoryInterface $ordersRepository, Context $context)
    {
        $this->repository = $ordersRepository;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);
        $model = $this->repository->getById($id);
        $model->setStatus(2);
        $this->repository->save($model);
        $this->_redirect($this->_redirect->getRefererUrl());
    }
}
