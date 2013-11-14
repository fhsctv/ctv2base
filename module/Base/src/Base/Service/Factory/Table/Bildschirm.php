<?php

namespace Base\Service\Factory\Table;

use Zend\ServiceManager\FactoryInterface;

use Base\Constants as C;
use Base\Model\Table\Bildschirm as Table;

class Bildschirm implements FactoryInterface {
    
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        
        $table = new Table();
        $table->setTableGateway($serviceLocator->get(C::SERVICE_TABLEGATEWAY_BILDSCHIRM));
        $table->setHydrator($serviceLocator->get(C::SERVICE_HYDRATOR_MODEL_BILDSCHIRM));
        
        return $table;
    }
}

