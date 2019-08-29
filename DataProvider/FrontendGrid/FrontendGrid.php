<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 29.08.19
 * Time: 1:43
 */

namespace MyModules\QuickOrder\DataProvider\FrontendGrid;

use MyModules\QuickOrder\Model\ResourceModel\QuickOrders\Collection;
use Magento\Customer\Model\SessionFactory;

class FrontendGrid extends \Magento\Ui\DataProvider\AbstractDataProvider
{
     protected $sessionFactory;
     protected $collection;
     public function __construct(
         SessionFactory $sessionFactory,
         Collection $collection,
         $name,
         $primaryFieldName,
         $requestFieldName,
         array $meta = [],
         array $data = []
     ) {
         $this->sessionFactory = $sessionFactory;
         $this->collection = $collection;
         parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
     }
     public function getCollection()
     {
         $this->collection = $this->collection->addFilter('customer_id',$this->sessionFactory->create()->getCustomerId())
         ->addFieldToFilter('status', ['neq' => 2]);
         return parent::getCollection(); // TODO: Change the autogenerated stub
     }
}