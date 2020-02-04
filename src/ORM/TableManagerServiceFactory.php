<?php
/**
 * Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio
 */

namespace Armenio\Cake\ORM;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class TableManagerServiceFactory
 * @package Armenio\Cake\ORM
 */
class TableManagerServiceFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $name
     * @param array|null $options
     * @return TableManager|object
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $tableManager = new TableManager();

        return $tableManager;
    }
}
