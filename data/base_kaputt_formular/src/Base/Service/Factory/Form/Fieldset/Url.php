<?php

namespace Base\Service\Factory\Form\Fieldset;

use Zend\ServiceManager\FactoryInterface;

class Url implements FactoryInterface {
    
    
    
    
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        
        $urlHydrator  = $serviceLocator->get('Base\Form\Hydrator\Url');
        $url = $serviceLocator->get('Base\Entity\Url');
        
        $fieldSet = new \Base\Form\Fieldset\Url();
        $fieldSet->setHydrator($urlHydrator);
        $fieldSet->setObject($url);
        
        return $fieldSet;
        
    }

}