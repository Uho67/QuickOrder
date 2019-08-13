<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 06.07.19
 * Time: 2:16
 */

namespace MyModules\QuickOrder\Model;


class StatusRepository implements \MyModules\QuickOrder\Api\StatusRepositoryInterface
{
    /** @var \MyModules\QuickOrder\Model\ResourceModel\Status */
    protected $resource;

    /** @var \MyModules\QuickOrder\Model\StatusFactory  */
    protected $statusFactory;

    /** @var \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface */
    protected $collectionProcessor;

    /** @var \MyModules\QuickOrder\Model\ResourceModel\Status\CollectionFactory */
    protected $collectionFactory;

    /** @var \MyModules\QuickOrder\Api\Status\StatusSearchResultsInterfaceFactory */
    protected $searchResultsFactory;

    protected $messageManager;

    public function __construct(

        \MyModules\QuickOrder\Model\ResourceModel\Status $resource,
        \MyModules\QuickOrder\Model\StatusFactory $statusFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
        \MyModules\QuickOrder\Model\ResourceModel\Status\CollectionFactory $collectionFactory,
        \MyModules\QuickOrder\Api\Status\StatusSearchResultsInterfaceFactory $statusSearchResultsFactory,
        \Magento\Framework\App\Action\Context $context
    ) {
        $this->resource                 = $resource;
        $this->statusFactory            = $statusFactory;
        $this->collectionProcessor      = $collectionProcessor;
        $this->collectionFactory        = $collectionFactory;
        $this->searchResultsFactory     = $statusSearchResultsFactory;
        $this->messageManager           = $context->getMessageManager();
    }

    /** {@inheritdoc} */
    public function getById($id)
    {
        $status = $this->statusFactory->create();
        $this->resource->load($status, $id);
        if (!$status->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(__('status with id "%1" does not exist.', $id));
        }
        return $status;
    }

    /** {@inheritdoc} */
    public function deleteById($id)
    {
        $this->delete($this->getById($id));
    }

    /** {@inheritdoc} */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria )
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /** {@inheritdoc} */
    public function save(\MyModules\QuickOrder\Api\Status\StatusInterface $status)
    {

        try {
            $this->resource->save($status);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(__($exception->getMessage()));
        }

        return $status;
    }

    /** {@inheritdoc} */
    public function delete(\MyModules\QuickOrder\Api\Status\StatusInterface $status)
    {
        try {
            $this->resource->delete($status);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(__($exception->getMessage()));
        }
        return $this;
    }


}