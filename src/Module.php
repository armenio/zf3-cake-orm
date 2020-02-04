<?php
/**
 * Cake Module
 *
 * @author Rafael Armenio <rafael.armenio@gmail.com>
 */

namespace Armenio\Cake;

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Log\Log;
use Zend\Cache\Storage\StorageInterface as CacheStorageInterface;
use Zend\Db\Adapter as ZendDbAdapter;
use Zend\Mvc\MvcEvent;

/**
 * Class Module
 * @package Armenio\Cake
 */
class Module
{
    /**
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
        /*
		 * Configurações do módulo
		 */
        $config = $e->getApplication()->getServiceManager()->get('config');

        if (isset($config['caches'][CacheStorageInterface::class]['options']['ttl'])) {
            $config['Cake']['Cache']['_cake_model_']['duration'] = $config['caches'][CacheStorageInterface::class]['options']['ttl'];
        }

        if (isset($config['db']['adapters'][ZendDbAdapter::class]['host'])) {
            $config['Cake']['Datasources']['default']['host'] = $config['db']['adapters'][ZendDbAdapter::class]['host'];
        }

        if (isset($config['db']['adapters'][ZendDbAdapter::class]['username'])) {
            $config['Cake']['Datasources']['default']['username'] = $config['db']['adapters'][ZendDbAdapter::class]['username'];
        }

        if (isset($config['db']['adapters'][ZendDbAdapter::class]['password'])) {
            $config['Cake']['Datasources']['default']['password'] = $config['db']['adapters'][ZendDbAdapter::class]['password'];
        }

        if (isset($config['db']['adapters'][ZendDbAdapter::class]['dbname'])) {
            $config['Cake']['Datasources']['default']['database'] = $config['db']['adapters'][ZendDbAdapter::class]['dbname'];
        }

        /*
         * Configura o namespace dos models. O padrão é App\Model
         */
        foreach ($config['Cake']['Configure'] as $configKey => $configValue) {
            Configure::write($configKey, $configValue);
        }

        /*
         * Configura o cache
         */
        foreach ($config['Cake']['Cache'] as $configKey => $configValue) {
            $cacheDir = ROOT_PATH . DIRECTORY_SEPARATOR . $configValue['path'];
            if (!is_dir($cacheDir)) {
                @mkdir($cacheDir, 0755, true);
            }

            if (!Cache::getConfig($configKey)) {
                Cache::setConfig($configKey, $configValue);
            }
        }

        /*
         * Configura o log
         */
        foreach ($config['Cake']['Log'] as $configKey => $configValue) {
            $logDir = ROOT_PATH . DIRECTORY_SEPARATOR . $configValue['path'];
            if (!is_dir($logDir)) {
                @mkdir($logDir, 0755, true);
            }

            if (!Log::getConfig($configKey)) {
                Log::setConfig($configKey, $configValue);
            }
        }

        /*
         * Setup da conexão com banco de dados no Cake
         */
        foreach ($config['Cake']['Datasources'] as $configKey => $configValue) {
            if (!ConnectionManager::getConfig($configKey)) {
                ConnectionManager::setConfig($configKey, $configValue);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
