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

/**
 * Class Table
 * @package Armenio\Cake\ORM
 */
class Table extends CakeORMTable
{
    /**
     * @param EntityInterface $entity
     * @param array $options
     * @return mixed
     */
    public function save(EntityInterface $entity, $options = [])
    {
        $now = (new DateTime())->format('Y-m-d H:i:s');

        if ($entity->isNew()) {
            if ($this->hasField('active')) {
                $entity->active = 1;
            }
            if ($this->hasField('created_at')) {
                $entity->created_at = $now;
            }
        }

        if ($this->hasField('updated_at')) {
            $entity->updated_at = $now;
        }

        return parent::save($entity, $options);
    }

    /**
     * @param EntityInterface $entity
     * @param array $options
     * @return mixed
     */
    public function delete(EntityInterface $entity, $options = [])
    {
        if ($this->hasField('active')) {
            $entity->active = 0;
            if ($this->hasField('deleted_at')) {
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
     * @return mixed
     */
    public function find($type = 'all', $options = [])
    {
        if (!isset($options['conditions'])) {
            $options['conditions'] = [];
        }

        if (!is_array($options['conditions'])) {
            $options['conditions'] = [$options['conditions']];
        }

        if ($this->hasField('active')) {
            if ((!isset($options['conditions'][sprintf('%s.active', $this->getAlias())])) && (!isset($options['conditions']['active']))) {
                $options['conditions'][sprintf('%s.active', $this->getAlias())] = 1;
            }
        }

        return parent::find($type, $options);
    }

    /**
     * @return Query
     */
    public function query()
    {
        return new Query($this->getConnection(), $this);
    }
}