<?php
/**
 * Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio for the source repository
 */

namespace Armenio\Cake\ORM;

use Interop\Container\ContainerInterface;
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
        $tableRegistry = new TableRegistry();

        return $tableRegistry;
    }
}
