<?php
/**
 * Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio for the source repository
 */

namespace Armenio\Cake\ORM;

use Cake\ORM\TableRegistry;

/**
 * Class TableManager
 * @package Armenio\Cake\ORM
 */
class TableManager
{
    /**
     * @param $alias
     * @param array $options
     * @return mixed
     */
    public function get($alias, array $options = [])
    {
        $table = TableRegistry::getTableLocator()->get($alias, $options);

        return $table;
    }
}