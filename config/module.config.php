<?php
/**
 * Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio for the source repository
 */

namespace Armenio\Cake;

use Zend\Cache\Storage\StorageInterface as CacheStorageInterface;
use Zend\Db\Adapter as DbAdapter;

return [
    'Cake' => [
        'Configure' => [
            'App' => [
                'namespace' => 'Application',
            ],
        ],
        'Cache' => [
            '_cake_core_' => [
                'className' => 'File',
                'prefix' => '',
                'path' => 'data/cakephp/cache/core/',
                'serialize' => true,
                'duration' => 0,
            ],
            '_cake_model_' => [
                'className' => 'File',
                'prefix' => '',
                'path' => 'data/cakephp/cache/models/',
                'serialize' => true,
                'duration' => 0,
            ],
        ],
        'Log' => [
            'queries' => [
                'className' => 'File',
                'path' => 'data/cakephp/logs/',
                'file' => 'queries.log',
                'scopes' => ['queriesLog'],
            ],
        ],
        'Datasources' => [
            'default' => [
                'className' => 'Cake\Database\Connection',
                'driver' => 'Cake\Database\Driver\Mysql',
                'persistent' => false,
                'host' => 'localhost',
                //'port' => 'non_standard_port_number',
                'username' => 'username',
                'password' => '',
                'database' => 'database',
                //'encoding' => 'utf8',
                'timezone' => 'UTC',
                //'flags' => [],
                'cacheMetadata' => false,
                'log' => false,
                'quoteIdentifiers' => true,
                //'init' => array('SET GLOBAL innodb_stats_on_metadata = 0'),
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            ORM\TableManager::class => ORM\TableManagerServiceFactory::class,
        ],
    ],
    /*
     * Remover este comentário caso não tenha o zf cache configurado em outro módulo
     *
    'caches' => array(
        CacheStorageInterface::class => array(
            'adapter' => array(
                'name' => 'filesystem',
            ),
            'options' => array(
                'cache_dir' => 'data/cache/',
                'ttl' => 31557600,
            ),
            'plugins' => array(
                'Serializer',
            ),
        ),
    ),
    */

    /*
     * Remover este comentário caso não tenha o zf db configurado em outro módulo
     *
    'db' => array(
        'adapters' => array(
            DbAdapter::class => array(
                'driver' => 'Pdo_Mysql',
                'host' => 'localhost',
                'username' => 'username',
                'password' => '',
                'dbname' => 'dbname',
            ),
        ),
    ),
    */
];
