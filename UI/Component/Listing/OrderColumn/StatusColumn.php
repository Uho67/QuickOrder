<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 06.07.19
 * Time: 4:33
 */

namespace MyModules\QuickOrder\UI\Component\Listing\OrderColumn;


use MyModules\QuickOrder\Model\ResourceModel\Status\CollectionFactory;



class StatusColumn implements \Magento\Framework\Data\OptionSourceInterface
{
    protected $collectionFactory;

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