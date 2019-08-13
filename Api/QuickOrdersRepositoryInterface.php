<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 04.07.19
 * Time: 23:53
 */

namespace MyModules\QuickOrder\Api;

interface QuickOrdersRepositoryInterface
{
    /**
     * @param int $id
     * @return \MyModules\QuickOrder\Api\Order\QuickOrderInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param int $id
     * @return \MyModules\QuickOrder\Api\QuickOrdersRepositoryInterface
     */
    public function deleteById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \MyModules\QuickOrder\Api\Order\QuickOrderSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param \MyModules\QuickOrder\Api\Order\QuickOrderInterface $order
     * @return \MyModules\QuickOrder\Api\Order\QuickOrderInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\MyModules\QuickOrder\Api\Order\QuickOrderInterface $order);

    /**
     * @param \MyModules\QuickOrder\Api\Order\QuickOrderInterface $order
     * @return \MyModules\QuickOrder\Api\QuickOrdersRepositoryInterface
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\MyModules\QuickOrder\Api\Order\QuickOrderInterface $order);
}