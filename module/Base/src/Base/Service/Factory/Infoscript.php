<?php

namespace Base\Service\Factory;

use Zend\ServiceManager\FactoryInterface;

use Base\Constants as C;
use Base\Service\Infoscript as Service;

class Infoscript implements FactoryInterface {
    
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        
        $service = new Service();
        $service->setMapper($serviceLocator->get(C::SERVICE_MAPPER_INFOSCRIPT));
        
        return $service;
        
    }

}

