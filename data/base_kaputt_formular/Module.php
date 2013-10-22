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

                'Base\Entity\Infoscript' => function($sm) {
                    $urlEnt = $sm->get('Base\Entity\Url');
                    return new \Base\Model\Entity\Infoscript($urlEnt);
                },
                
//                'Base\Form\Infoscript'   => '\Base\Service\Factory\Form\Infoscript',
                'Base\Form\Fieldset\Url' => '\Base\Service\Factory\Form\Fieldset\Url',
                   
            ),
            'invokables' => array(
                
                'Base\Entity\Url' => '\Base\Model\Entity\Url',
                
                'Base\Form\Hydrator\Infoscript'   => '\Base\Form\Hydrator\Infoscript',
                'Base\Form\Hydrator\Url'          => '\Base\Form\Hydrator\Url',
                
                'Base\Form\Infoscript'            => '\Base\Form\Infoscript',
            ),
            'shared' => array(
                'Base\Entity\Infoscript' => false,
                'Base\Entity\Url'        => false,
                
                'Base\Form\Infoscript'   => false,
                'Base\Form\Fieldset\Url' => false,
            )
        );
    }
}
