<?php
/**
 * Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio for the source repository
 */

namespace Armenio\Cake\ORM;

use Cake\Datasource\EntityInterface;
use Cake\ORM\Table as CakeORMTable;
use DateTime;
use Zend\Paginator as ZendPaginator;

/**
 * Class Table
 * @package Armenio\Cake\ORM
 */
class Table extends CakeORMTable
{
    /**
     * @param EntityInterface $entity
     * @param array $options
     * @return bool|EntityInterface|mixed
     */
    public function save(EntityInterface $entity, $options = [])
    {
        $now = (new DateTime())->format('Y-m-d H:i:s');

        $columns = $this->schema()->columns();

        if ($entity->isNew() && in_array('active', $columns)) {
            $entity->active = 1;
        }
        if ($entity->isNew() && in_array('created_at', $columns)) {
            $entity->created_at = $now;
        }
        if (in_array('updated_at', $columns)) {
            $entity->updated_at = $now;
        }

        return parent::save($entity, $options);
    }

    /**
     * @param EntityInterface $entity
     * @param array $options
     * @return bool|EntityInterface|mixed
     */
    public function delete(EntityInterface $entity, $options = [])
    {
        $columns = $this->schema()->columns();

        if (in_array('active', $columns)) {
            $entity->active = 0;
            if (in_array('deleted_at', $columns)) {
                $now = (new DateTime())->format('Y-m-d H:i:s');
                $entity->deleted_at = $now;
            }
            return parent::save($entity, $options);
        }

        return parent::delete($entity, $options);
    }

    /**
     * @param string $type
     * @param array $options
     * @return \Cake\ORM\Query
     */
    public function find($type = 'all', $options = [])
    {
        if (!isset($options['conditions'])) {
            $options['conditions'] = [];
        }

        if (!is_array($options['conditions'])) {
            $options['conditions'] = [$options['conditions']];
        }

        $columns = $this->schema()->columns();

        if (in_array('active', $columns)) {
            if ((!isset($options['conditions'][sprintf('%s.active', $this->alias())])) && (!isset($options['conditions']['active']))) {
                $options['conditions'][sprintf('%s.active', $this->alias())] = 1;
            }
        }

        return parent::find($type, $options);
    }

    /**
     * @param array $params
     * @param int $currentPageNumber
     * @param int $itemCountPerPage
     * @param int $pageRange
     * @return ZendPaginator\Paginator
     */
    public function paginate($params = [], $currentPageNumber = 1, $itemCountPerPage = 20, $pageRange = 5)
    {
        $zendPaginator = new ZendPaginator\Paginator(new Paginator\Adapter\Adapter($this, $params));
        $zendPaginator->setItemCountPerPage((int)$itemCountPerPage);
        $zendPaginator->setPageRange((int)$pageRange);
        $zendPaginator->setCurrentPageNumber((int)$currentPageNumber);

        return $zendPaginator;
    }
}