<?php

/**
 * @author Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio
 */

namespace Armenio\Cake\ORM;

use Armenio\Cake\ORM\Paginator\Adapter\Adapter as PaginatorAdapter;
use Cake\ORM\Query as VendorQuery;
use Zend\Paginator\Paginator;

/**
 * Class Query
 *
 * @package Armenio\Cake\ORM
 */
class Query extends VendorQuery
{
    /**
     * @param int $currentPageNumber
     * @param int $itemCountPerPage
     * @param int $pageRange
     *
     * @return Paginator
     */
    public function paginate($currentPageNumber = 1, $itemCountPerPage = 20, $pageRange = 5)
    {
        $zendPaginator = new Paginator(new PaginatorAdapter($this));
        $zendPaginator->setItemCountPerPage((int)$itemCountPerPage);
        $zendPaginator->setPageRange((int)$pageRange);
        $zendPaginator->setCurrentPageNumber((int)$currentPageNumber);

        return $zendPaginator;
    }
}
