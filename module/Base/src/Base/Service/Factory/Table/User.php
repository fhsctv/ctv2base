<?php

namespace Base\Service\Factory\Table;

use Zend\ServiceManager\FactoryInterface;

use Base\Constants as C;
use Base\Model\Table\User as Table;

class User implements FactoryInterface {
    
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        
        $table = new Table();
        $table->setTableGateway($serviceLocator->get(C::SM_TABLEGATEWAY_USER));
        $table->setHydrator($serviceLocator->get(C::SM_HYDRATOR_MODEL_USER));
        
        return $table;
    }
}

