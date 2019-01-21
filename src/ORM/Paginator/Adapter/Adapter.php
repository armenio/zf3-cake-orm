<?php
namespace Armenio\Cake\ORM\Paginator\Adapter;

use Cake\ORM\Table;
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
     * Adapter constructor.
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

        $finder = $this->table->find('all', $params);

        if (isset($params['matching']) && !empty($params['matching'])) {
            foreach ($params['matching'] as $assoc => $builder) {
                $finder->matching($assoc, $builder);
            }
        }

        if (isset($params['inner_join']) && !empty($params['inner_join'])) {
            foreach ($params['inner_join'] as $assoc => $builder) {
                $finder->innerJoinWith($assoc, $builder);
            }
        }

        if (isset($params['not_matching']) && !empty($params['not_matching'])) {
            foreach ($params['not_matching'] as $assoc => $builder) {
                $finder->notMatching($assoc, $builder);
            }
        }

        if (isset($params['left_join']) && !empty($params['left_join'])) {
            foreach ($params['left_join'] as $assoc => $builder) {
                $finder->leftJoinWith($assoc, $builder);
            }
        }

        return $finder->all();
    }

    /**
     * @return int
     */
    public function count()
    {
        $params = $this->params;

        $finder = $this->table->find('all', $params);

        if (isset($params['matching']) && !empty($params['matching'])) {
            foreach ($params['matching'] as $assoc => $builder) {
                $finder->matching($assoc, $builder);
            }
        }

        if (isset($params['inner_join']) && !empty($params['inner_join'])) {
            foreach ($params['inner_join'] as $assoc => $builder) {
                $finder->innerJoinWith($assoc, $builder);
            }
        }

        if (isset($params['not_matching']) && !empty($params['not_matching'])) {
            foreach ($params['not_matching'] as $assoc => $builder) {
                $finder->notMatching($assoc, $builder);
            }
        }

        if (isset($params['left_join']) && !empty($params['left_join'])) {
            foreach ($params['left_join'] as $assoc => $builder) {
                $finder->leftJoinWith($assoc, $builder);
            }
        }

        return $finder->count();
    }
}
