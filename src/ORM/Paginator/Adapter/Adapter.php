<?php
namespace Armenio\Cake\ORM\Paginator\Adapter;

use Armenio\Cake\ORM\Query;
use Zend\Paginator\Adapter\AdapterInterface;

/**
 * Class Adapter
 * @package Armenio\Cake\ORM\Paginator\Adapter
 */
class Adapter implements AdapterInterface
{
    /**
     * @var Query
     */
    protected $query;

    /**
     * Adapter constructor.
     * @param Query $query
     */
    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    /**
     * @param int $offset
     * @param int $itemsPerPage
     * @return $this
     */
    public function getItems($offset, $itemsPerPage)
    {
        return $this->query->limit($itemsPerPage)->offset($offset);
    }

    /**
     * @return int|null
     */
    public function count()
    {
        return $this->query->count();
    }
}
