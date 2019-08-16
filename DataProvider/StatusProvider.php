<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2018, Pavel Usachev
 */

namespace MyModules\QuickOrder\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use MyModules\QuickOrder\Api\Status\StatusInterface;
use MyModules\QuickOrder\Model\ResourceModel\Status\CollectionFactory;

/**
 * Class StatusProvider
 * @package MyModules\QuickOrder\DataProvider
 */
class StatusProvider extends AbstractDataProvider
{
    /**
     * @param string            $name
     * @param string            $primaryFieldName
     * @param string            $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array             $meta
     * @param array             $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        if (empty($items)) {
            return [];
        }
        /** @var $status StatusInterface */
        foreach ($items as $status) {
            $this->loadedData[$status->getId()] = $status->getData();
        }
        return $this->loadedData;
    }
}
