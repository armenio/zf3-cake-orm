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
     * @var int
     */
    protected $count;

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
        if ($this->count !== null) {
            return $this->count;
        }

        $this->count = $this->query->count();

        return $this->count;
    }
}
