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
                C::SM_TGW_INSERATBILDSCHIRMLINKER       => '\Base\Service\Factory\TableGateway\InseratBildschirmLinker',
                C::SM_TGW_INSERAT                       => '\Base\Service\Factory\TableGateway\Inserat',
                C::SM_TGW_INFOSCRIPT                    => '\Base\Service\Factory\TableGateway\Infoscript',
                C::SM_TGW_INFOSCRIPT_COLUMN             => '\Base\Service\Factory\TableGateway\Infoscript\Column',
                C::SM_TGW_BILDSCHIRM                    => '\Base\Service\Factory\TableGateway\Bildschirm',

                C::SM_TGW_USER                          => '\Base\Service\Factory\TableGateway\User',
                C::SM_TGW_FACHHOCHSCHULE                => '\Base\Service\Factory\TableGateway\Fachhochschule',


                // ------------------------------------------------------ Tables
                C::SM_TBL_INSERAT                       => '\Base\Service\Factory\Table\Inserat',
                C::SM_TBL_INSERATBILDSCHIRMLINKER       => '\Base\Service\Factory\Table\InseratBildschirmLinker',
                C::SM_TBL_INFOSCRIPT                    => '\Base\Service\Factory\Table\Infoscript',
                C::SM_TBL_BILDSCHIRM                    => '\Base\Service\Factory\Table\Bildschirm',

                C::SM_TBL_USER                          => '\Base\Service\Factory\Table\User',
                C::SM_TBL_FACHHOCHSCHULE                => '\Base\Service\Factory\Table\Fachhochschule',


                // ----------------------------------------------------- Mappers
                C::SM_MAP_INFOSCRIPT                    => '\Base\Service\Factory\Mapper\Infoscript',
                C::SM_MAP_FACHHOCHSCHULE                => '\Base\Service\Factory\Mapper\Fachhochschule',


                // ----------------------------------------------------- Services
                C::SERVICE_INFOSCRIPT                   => '\Base\Service\Factory\Infoscript',
                C::SERVICE_DISPLAYLINK                  => '\Base\Service\Factory\DisplayLink',
            ),
            'invokables' => array (

                // ---------------------------------------------------- Entities
                C::SM_ENTITY_INSERAT                    => '\Base\Model\Entity\Inserat',
                C::SM_ENTITY_INFOSCRIPT                 => '\Base\Model\Entity\Infoscript',
                C::SM_ENTITY_INFOSCRIPT_COLUMN          => '\Base\Model\Entity\Infoscript\Column',
                C::SM_ENTITY_BILDSCHIRM                 => '\Base\Model\Entity\Bildschirm',

                C::SM_ENTITY_USER                       => '\Base\Model\Entity\User',
                C::SM_ENTITY_FACHHOCHSCHULE             => '\Base\Model\Entity\Fachhochschule',

                // ------------------------------------------------------- Forms
                C::SM_FORM_INFOSCRIPT                   => '\Base\Form\Infoscript',
                C::SM_FORM_DELETE                       => '\Base\Form\Delete',

                // ------------------------------------------------- DbHydrators
                C::SM_HYD_MODEL_INSERAT                 => '\Base\Model\Hydrator\Inserat',
                C::SM_HYD_MODEL_INFOSCRIPT              => '\Base\Model\Hydrator\Infoscript',
                C::SM_HYD_MODEL_INFOSCRIPT_COLUMN       => '\Base\Model\Hydrator\Infoscript\Column',
                C::SM_HYD_MODEL_BILDSCHIRM              => '\Base\Model\Hydrator\Bildschirm',

                C::SM_HYD_MODEL_USER                    => '\Base\Model\Hydrator\User',
                C::SM_HYD_MODEL_FACHHOCHSCHULE          => '\Base\Model\Hydrator\Fachhochschule',


            ),
            'shared' => array(

                // ---------------------------------------------------- Entities
                C::SM_ENTITY_INSERAT                    => false,
                C::SM_ENTITY_INFOSCRIPT                 => false,
                C::SM_ENTITY_INFOSCRIPT_COLUMN          => false,
                C::SM_ENTITY_BILDSCHIRM                 => false,

                C::SM_ENTITY_USER                       => false,
                C::SM_ENTITY_FACHHOCHSCHULE             => false,

                // ------------------------------------------------------- Forms
                C::SM_FORM_INFOSCRIPT                   => false,

                C::SM_FORM_DELETE                       => false,

            )

        );

    }

//    public function getViewHelperConfig()   {
//        return [
//            'invokables' => [
////                'FormRow'        => 'Base\View\Helper\FormRow',
//             ]
//        ];
//    }
}
