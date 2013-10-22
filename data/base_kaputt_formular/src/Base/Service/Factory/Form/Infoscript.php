<?php

namespace Base\Service\Factory\Form;

use Zend\ServiceManager\FactoryInterface;

class Infoscript implements FactoryInterface {
    
    
    
    
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        
        $infoscriptHydrator  = $serviceLocator->get('Base\Form\Hydrator\Infoscript');
        $infoscript          = $serviceLocator->get('Base\Entity\Infoscript');
        
        $form = new \Base\Form\Infoscript();

        
        $form->setHydrator($infoscriptHydrator);
        $form->setObject($infoscript);
        
        $urlFieldSet = $serviceLocator->get('Base\Form\Fieldset\Url');
        $form->setUrl($urlFieldSet);
        
        return $form;
        
    }

}