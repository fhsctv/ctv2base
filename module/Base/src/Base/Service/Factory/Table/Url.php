<?php

namespace Base\Service\Factory\Table;

use Zend\ServiceManager\FactoryInterface;

use Base\Constants as C;
use Base\Model\Table\Url as Table;

class Url implements FactoryInterface {
    
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        
        $table = new Table();
        $table->setTableGateway($serviceLocator->get(C::SERVICE_TABLEGATEWAY_URL));
        $table->setHydrator($serviceLocator->get(C::SERVICE_HYDRATOR_MODEL_URL));
        
        return $table;
        
    }

}

