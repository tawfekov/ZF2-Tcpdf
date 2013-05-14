<?php
namespace ZF2Tcpdf ;

use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;
use \TCPDF;

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
                    $pdf =  new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                    // set some language dependent data:
                    $lg = $config["defaults"]["language"];
                    //set some language-dependent strings
                    $pdf->setLanguageArray($lg);
                    $pdf->setRTL(true);
                    $pdf->setPrintHeader(false);
                    $pdf->setPrintFooter(false);
                    $font = $pdf->addTTFfont(__DIR__ . "/../../../data/TimesNewRoman.ttf", 'TrueTypeUnicode', '', 96);
                    $pdf->SetFont($font, '', 10);
                    return $pdf ;
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
