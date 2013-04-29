<?php
namespace ZF2Tcpdf ;

use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;
use \TCPDF;
//include '../../tcpdf/tcpdf/tcpdf.php';
    
class Module implements ConsoleUsageProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function onBootstrap(MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'tcpdf' => function(){
                    $config = $this->getConfig();
                    var_dump($config);
                    die;
                    return new TCPDF();
                }
            ),
        );
    }
    public function getViewHelperConfig()
    {
         return array(
            'factories' => array()
        );
    }

    public function getConsoleUsage(Console $console)
    {
         return array(
             "create" => "saved for future use "
          );
    }
}
