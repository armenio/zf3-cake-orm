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
		 * pega as configurações do módulo
		 */
        $config = $e->getApplication()->getServiceManager()->get('config');

        /*
		 * arruma a configuração do cakePHP
		 */
        $config['Cake']['Cache']['_cake_model_']['duration'] = $config['caches']['Zend\Cache']['options']['ttl'];
        $config['Cake']['Datasources']['default']['host'] = $config['db']['adapters']['Zend\Db\Adapter']['host'];
        $config['Cake']['Datasources']['default']['username'] = $config['db']['adapters']['Zend\Db\Adapter']['username'];
        $config['Cake']['Datasources']['default']['password'] = $config['db']['adapters']['Zend\Db\Adapter']['password'];
        $config['Cake']['Datasources']['default']['database'] = $config['db']['adapters']['Zend\Db\Adapter']['dbname'];

        /*
         * seta o namespace padrão do Cake (App\Model)
         */
        foreach ($config['Cake']['Configure'] as $configKey => $configValue) {
            Configure::write($configKey, $configValue);
        }

        /*
         * configura o cache do Cake
         */
        foreach ($config['Cake']['Cache'] as $configKey => $configValue) {
            $cacheDir = ROOT_PATH . '/' . $configValue['path'];
            if (!is_dir($cacheDir)) {
                @mkdir($cacheDir, 0755, true);
            }
            Cache::config($configKey, $configValue);
        }

        /*
         * configura o log do Cake
         */
        foreach ($config['Cake']['Log'] as $configKey => $configValue) {
            $logDir = ROOT_PATH . '/' . $configValue['path'];
            if (!is_dir($logDir)) {
                @mkdir($logDir, 0755, true);
            }
            Log::config($configKey, $configValue);
        }

        /*
         * setup da conexão com banco de dados no Cake
         */
        foreach ($config['Cake']['Datasources'] as $configKey => $configValue) {
            ConnectionManager::config($configKey, $configValue);
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
