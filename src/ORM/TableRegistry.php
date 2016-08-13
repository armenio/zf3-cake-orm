<?php
/**
 * Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio for the source repository
 */

namespace Armenio\Cake\ORM;

use Cake\ORM\TableRegistry as CakeORMTableRegistry;

/**
 * Class TableRegistry
 * @package Armenio\Cake\ORM
 */
class TableRegistry
{
    /**
     * @param $alias
     * @param array $options
     * @return \Cake\ORM\Table
     */
    public function get($alias, array $options = [])
    {
        $table = CakeORMTableRegistry::get($alias, $options);

        return $table;
    }
}