<?php

/**
 * @author Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio
 */

namespace Armenio\Cake\ORM;

use Cake\ORM\TableRegistry;

/**
 * Class TableManager
 *
 * @package Armenio\Cake\ORM
 */
class TableManager
{
    /**
     * @param $alias
     * @param array $options
     *
     * @return Table
     */
    public function get($alias, array $options = [])
    {
        $table = TableRegistry::getTableLocator()->get($alias, $options);

        return $table;
    }
}
