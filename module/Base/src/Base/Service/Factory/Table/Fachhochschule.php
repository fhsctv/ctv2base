<?php

namespace Base\Service\Factory\Table;

use Zend\ServiceManager\FactoryInterface;

use Base\Constants as C;
use Base\Model\Table\Fachhochschule as Table;

class Fachhochschule implements FactoryInterface {
    
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        
        $table = new Table();
        $table->setTableGateway($serviceLocator->get(C::SM_TGW_FACHHOCHSCHULE));
        $table->setHydrator($serviceLocator->get(C::SM_HYD_MODEL_FACHHOCHSCHULE));
        
        return $table;
        
    }

}

