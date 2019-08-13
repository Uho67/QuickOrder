<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 06.07.19
 * Time: 2:04
 */

namespace MyModules\QuickOrder\Api\Status;


interface StatusSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get Orsers list.
     *
     * @return \MyModules\QuickOrder\Api\Status\StatusInterface[]
     */
    public function getItems();

    /**
     * Set blocks list.
     *
     * @param \MyModules\QuickOrder\Api\Status\StatusInterface[] $items
     * @return \MyModules\QuickOrder\Api\Status\StatusSearchResultsInterface
     */
    public function setItems(array $items);
}