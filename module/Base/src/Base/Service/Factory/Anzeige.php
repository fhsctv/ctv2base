<?php

namespace Base\Service\Factory;

use Zend\ServiceManager\FactoryInterface;

use Base\Constants as C;
use Base\Service\Anzeige as Service;

class Anzeige implements FactoryInterface {
    
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        
        $service = new Service();
        $service->setMapper($serviceLocator->get(C::SERVICE_MAPPER_ANZEIGE));
        
        return $service;
        
    }

}

