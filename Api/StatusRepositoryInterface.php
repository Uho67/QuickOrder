<?php

namespace MyModules\QuickOrder\Api;

interface StatusRepositoryInterface
{
    /**
     * @param int $id
     * @return \MyModules\QuickOrder\Api\Status\StatusInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param int $id
     * @return \MyModules\QuickOrder\Api\StatusRepositoryInterface
     */
    public function deleteById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \MyModules\QuickOrder\Api\Status\StatusSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param \MyModules\QuickOrder\Api\Status\StatusInterface $status
     * @return \MyModules\QuickOrder\Api\Status\StatusInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\MyModules\QuickOrder\Api\Status\StatusInterface $status);

    /**
     * @param \MyModules\QuickOrder\Api\Status\StatusInterface $status
     * @return \MyModules\QuickOrder\Api\StatusRepositoryInterface
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\MyModules\QuickOrder\Api\Status\StatusInterface $status);
}
