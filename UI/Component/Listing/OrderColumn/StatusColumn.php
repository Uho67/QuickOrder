<?php

namespace MyModules\QuickOrder\UI\Component\Listing\OrderColumn;

use MyModules\QuickOrder\Model\ResourceModel\Status\CollectionFactory;

/**
 * Class StatusColumn
 * @package MyModules\QuickOrder\UI\Component\Listing\OrderColumn
 */
class StatusColumn implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * StatusColumn constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $myReturn = array();
        $collection = $this->collectionFactory->create();
        $items = $collection->getData();
        foreach ($items as $item){
            $arr =  ['value' => $item['status_id'],'label' => $item['name']];
            $myReturn[] = $arr;
        }
        return $myReturn;
    }
}
