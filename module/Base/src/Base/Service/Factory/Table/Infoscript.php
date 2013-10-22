<?php

namespace Base\Service\Factory\Table;

use Zend\ServiceManager\FactoryInterface;

use Base\Constants as C;
use Base\Model\Table\Infoscript as Table;

class Infoscript implements FactoryInterface {
    
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        
        $table = new Table();
        $table->setTableGateway($serviceLocator->get(C::SERVICE_TABLEGATEWAY_INFOSCRIPT));
        $table->setHydrator($serviceLocator->get(C::SERVICE_HYDRATOR_MODEL_INFOSCRIPT));
        
        return $table;
        
    }

}

