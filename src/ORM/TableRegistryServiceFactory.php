<?php
/**
 * Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio for the source repository
 */

namespace Armenio\Cake\ORM;

use Interop\Container\ContainerInterface;
use Zend\Cache\Storage\StorageInterface as CacheStorageInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class TableRegistryServiceFactory
 * @package Armenio\Cake\ORM
 */
class TableRegistryServiceFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $name
     * @param array|null $options
     * @return TableRegistry
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $cache = $container->get(CacheStorageInterface::class);

        $tableRegistry = new TableRegistry($cache);

        return $tableRegistry;
    }
}
