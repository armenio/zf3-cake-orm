<?php
/**
 * Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio for the source repository
 */

namespace Armenio\Cake\ORM;

use Cake\ORM\TableRegistry as CakeORMTableRegistry;
use Zend\Cache\Storage\StorageInterface as CacheStorageInterface;

/**
 * Class TableRegistry
 * @package Armenio\Cake\ORM
 */
class TableRegistry
{
    /**
     * @var CacheStorageInterface
     */
    protected $cache;

    /**
     * TableRegistry constructor.
     * @param CacheStorageInterface $cache
     */
    public function __construct(CacheStorageInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param $alias
     * @param array $options
     * @return \Cake\ORM\Table
     */
    public function get($alias, array $options = [])
    {
        $table = CakeORMTableRegistry::get($alias, $options);
        $table->setCache($this->cache);

        return $table;
    }
}