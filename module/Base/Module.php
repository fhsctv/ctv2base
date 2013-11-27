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
                C::SERVICE_TABLEGATEWAY_BILDSCHIRM   => '\Base\Service\Factory\TableGateway\Bildschirm',
                
                C::SM_TABLEGATEWAY_USER              => '\Base\Service\Factory\TableGateway\User',
                C::SM_TABLEGATEWAY_FACHHOCHSCHULE    => '\Base\Service\Factory\TableGateway\Fachhochschule',
                
                
                // ------------------------------------------------------ Tables
                C::SERVICE_TABLE_INSERAT             => '\Base\Service\Factory\Table\Inserat',
                C::SERVICE_TABLE_INSERATBILDSCHIRMLINKER             => '\Base\Service\Factory\Table\InseratBildschirmLinker',
                C::SERVICE_TABLE_INFOSCRIPT          => '\Base\Service\Factory\Table\Infoscript',
                C::SERVICE_TABLE_BILDSCHIRM          => '\Base\Service\Factory\Table\Bildschirm',
                
                C::SM_TABLE_USER                     => '\Base\Service\Factory\Table\User',
                C::SM_TABLE_FACHHOCHSCHULE           => '\Base\Service\Factory\Table\Fachhochschule',
                
                
                // ----------------------------------------------------- Mappers
                C::SERVICE_MAPPER_INFOSCRIPT         => '\Base\Service\Factory\Mapper\Infoscript',
                C::SM_MAPPER_FACHHOCHSCHULE          => '\Base\Service\Factory\Mapper\Fachhochschule',
                
                
                // ----------------------------------------------------- Services
                C::SERVICE_INFOSCRIPT               => '\Base\Service\Factory\Infoscript',
                C::SERVICE_DISPLAYLINK              => '\Base\Service\Factory\DisplayLink',
            ),
            'invokables' => array (
                
                // ---------------------------------------------------- Entities
                C::SERVICE_ENTITY_INSERAT            => '\Base\Model\Entity\Inserat',
                C::SERVICE_ENTITY_INFOSCRIPT         => '\Base\Model\Entity\Infoscript',
                C::SERVICE_ENTITY_BILDSCHIRM         => '\Base\Model\Entity\Bildschirm',
                
                C::SM_ENTITY_USER                    => '\Base\Model\Entity\User',
                C::SM_ENTITY_FACHHOCHSCHULE          => '\Base\Model\Entity\Fachhochschule',
                
                // ------------------------------------------------------- Forms
                C::SERVICE_FORM_INFOSCRIPT           => '\Base\Form\Infoscript',
                C::SERVICE_FORM_DELETE               => '\Base\Form\Delete',
                
                // ------------------------------------------------- DbHydrators
                C::SERVICE_HYDRATOR_MODEL_INSERAT    => '\Base\Model\Hydrator\Inserat',
                C::SERVICE_HYDRATOR_MODEL_INFOSCRIPT => '\Base\Model\Hydrator\Infoscript',
                C::SERVICE_HYDRATOR_MODEL_BILDSCHIRM => '\Base\Model\Hydrator\Bildschirm',
                
                C::SM_HYDRATOR_MODEL_USER            => '\Base\Model\Hydrator\User',
                C::SM_HYDRATOR_MODEL_FACHHOCHSCHULE  => '\Base\Model\Hydrator\Fachhochschule',
                
                
            ),
            'shared' => array(
                
                // ---------------------------------------------------- Entities
                C::SERVICE_ENTITY_INSERAT    => false,
                C::SERVICE_ENTITY_INFOSCRIPT => false,
                C::SERVICE_ENTITY_BILDSCHIRM => false,
                
                C::SM_ENTITY_USER            => false,
                C::SM_ENTITY_FACHHOCHSCHULE  => false,
                
                // ------------------------------------------------------- Forms
                C::SERVICE_FORM_INFOSCRIPT   => false,
                
                C::SERVICE_FORM_DELETE       => false,
                
            )
            
        );
        
    }
    
    public function getViewHelperConfig()   {
        return [
            'invokables' => [
//                'FormCollection' => 'Base\View\Helper\FormCollection',
                'FormRow'        => 'Base\View\Helper\FormRow',
             ]
        ];
    }
}
