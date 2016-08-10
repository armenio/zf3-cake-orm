<?php
namespace Armenio\Cake\ORM\Paginator\Adapter;

use Armenio\Cake\ORM\Table;
use Zend\Paginator\Adapter\AdapterInterface;

/**
 * Class Adapter
 * @package Armenio\Cake\ORM\Paginator\Adapter
 */
class Adapter implements AdapterInterface
{
    /**
     * @var Table
     */
    protected $table;

    /**
     * @var array
     */
    protected $params;

    /**
     * Cake constructor.
     * @param Table $table
     * @param array $params
     */
    public function __construct(Table $table, array $params = [])
    {
        $this->table = $table;
        $this->params = $params;
    }

    /**
     * @param int $offset
     * @param int $itemsPerPage
     * @return \Cake\ORM\Query
     */
    public function getItems($offset, $itemsPerPage)
    {
        $params = $this->params;

        $params['limit'] = $itemsPerPage;
        $params['page'] = null;
        $params['offset'] = $offset;

        return $this->table->find('all', $params)->all();
    }

    /**
     * @return int
     */
    public function count()
    {
        $params = $this->params;
        return $this->table->find('all', $params)->count();
    }
}
