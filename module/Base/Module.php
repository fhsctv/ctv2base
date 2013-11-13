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
                
                // ----------------------------------------------- TableGateways
                C::SERVICE_TABLEGATEWAY_INSERATBILDSCHIRMLINKER      => '\Base\Service\Factory\TableGateway\InseratBildschirmLinker',
                C::SERVICE_TABLEGATEWAY_INSERAT      => '\Base\Service\Factory\TableGateway\Inserat',
                C::SERVICE_TABLEGATEWAY_INFOSCRIPT   => '\Base\Service\Factory\TableGateway\Infoscript',
                
                
                // ------------------------------------------------------ Tables
                C::SERVICE_TABLE_INSERAT             => '\Base\Service\Factory\Table\Inserat',
                C::SERVICE_TABLE_INSERATBILDSCHIRMLINKER             => '\Base\Service\Factory\Table\InseratBildschirmLinker',
                C::SERVICE_TABLE_INFOSCRIPT          => '\Base\Service\Factory\Table\Infoscript',
                
                
                // ----------------------------------------------------- Mappers
                C::SERVICE_MAPPER_INFOSCRIPT         => '\Base\Service\Factory\Mapper\Infoscript',
                
                
                // ----------------------------------------------------- Services
                C::SERVICE_INFOSCRIPT               => '\Base\Service\Factory\Infoscript',
            ),
            'invokables' => array (
                
                // ---------------------------------------------------- Entities
                C::SERVICE_ENTITY_INSERAT            => '\Base\Model\Entity\Inserat',
                C::SERVICE_ENTITY_INFOSCRIPT         => '\Base\Model\Entity\Infoscript',
                
                // ------------------------------------------------------- Forms
                C::SERVICE_FORM_INFOSCRIPT           => '\Base\Form\Infoscript',
                C::SERVICE_FORM_DELETE               => '\Base\Form\Delete',
                
                // ------------------------------------------------- DbHydrators
                C::SERVICE_HYDRATOR_MODEL_INSERAT    => '\Base\Model\Hydrator\Inserat',
                C::SERVICE_HYDRATOR_MODEL_INFOSCRIPT => '\Base\Model\Hydrator\Infoscript',
                
                
            ),
            'shared' => array(
                
                // ---------------------------------------------------- Entities
                C::SERVICE_ENTITY_INSERAT    => false,
                C::SERVICE_ENTITY_INFOSCRIPT => false,
                
                // ------------------------------------------------------- Forms
                C::SERVICE_FORM_INFOSCRIPT => false,
                
                C::SERVICE_FORM_DELETE     => false,
                
            )
            
        );
        
    }
    
}
