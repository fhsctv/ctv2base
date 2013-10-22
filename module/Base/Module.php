<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Base\Constants as C;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

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
    
    
    public function getServiceConfig(){
        
        return array(
            'factories' => array(
                
                C::SERVICE_TABLEGATEWAY_INFOSCRIPT   => '\Base\Service\Factory\TableGateway\Infoscript',
                C::SERVICE_TABLEGATEWAY_ANZEIGE      => '\Base\Service\Factory\TableGateway\Anzeige',
                C::SERVICE_TABLEGATEWAY_URL          => '\Base\Service\Factory\TableGateway\Url',
                
                C::SERVICE_TABLE_INFOSCRIPT          => '\Base\Service\Factory\Table\Infoscript',
                C::SERVICE_TABLE_ANZEIGE             => '\Base\Service\Factory\Table\Anzeige',
                C::SERVICE_TABLE_URL                 => '\Base\Service\Factory\Table\Url',
                
                C::SERVICE_MAPPER_INFOSCRIPT         => '\Base\Service\Factory\Mapper\Infoscript',
                C::SERVICE_MAPPER_ANZEIGE            => '\Base\Service\Factory\Mapper\Anzeige',
                
                C::SERVICE_INFOSCRIPT               => '\Base\Service\Factory\Infoscript',
                C::SERVICE_ANZEIGE                  => '\Base\Service\Factory\Anzeige',
            ),
            'invokables' => array (
                
                C::SERVICE_ENTITY_INFOSCRIPT         => '\Base\Model\Entity\Infoscript',
                C::SERVICE_ENTITY_ANZEIGE            => '\Base\Model\Entity\Anzeige',
                C::SERVICE_ENTITY_URL                => '\Base\Model\Entity\Url',
                
                C::SERVICE_FORM_INFOSCRIPT           => '\Base\Form\Infoscript',
                C::SERVICE_FORM_ANZEIGE              => '\Base\Form\Anzeige',
                C::SERVICE_FORM_DELETE               => '\Base\Form\Delete',
                
                C::SERVICE_HYDRATOR_MODEL_INFOSCRIPT => '\Base\Model\Hydrator\Infoscript',
                C::SERVICE_HYDRATOR_MODEL_ANZEIGE    => '\Base\Model\Hydrator\Anzeige',
                C::SERVICE_HYDRATOR_MODEL_URL        => '\Base\Model\Hydrator\Url',
                
                
            ),
            'shared' => array(
                
                C::SERVICE_ENTITY_INFOSCRIPT => false,
                C::SERVICE_ENTITY_ANZEIGE    => false,
                C::SERVICE_ENTITY_URL        => false,
                
                
                C::SERVICE_FORM_INFOSCRIPT => false,
                C::SERVICE_FORM_ANZEIGE    => false,
                C::SERVICE_FORM_DELETE     => false,
                
            )
            
        );
        
    }
    
}
