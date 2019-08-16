<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 04.07.19
 * Time: 21:35
 */

namespace MyModules\QuickOrder\Api\Order;

interface QuickOrderSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get Orders list.
     *
     * @return \MyModules\QuickOrder\Api\Order\QuickOrderInterface[]
     */
    public function getItems();

    /**
     * Set blocks list.
     *
     * @param \MyModules\QuickOrder\Api\Order\QuickOrderInterface[] $items
     * @return \MyModules\QuickOrder\Api\Order\QuickOrderSearchResultsInterface
     */
    public function setItems(array $items);
}
