<?php

namespace Base\Service\Factory\Table;

use Zend\ServiceManager\FactoryInterface;

use Base\Constants as C;
use Base\Model\Table\Inserat as Table;

class Inserat implements FactoryInterface {
    
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        
        $table = new Table();
        $table->setTableGateway($serviceLocator->get(C::SM_TGW_INSERAT));
        $table->setHydrator($serviceLocator->get(C::SM_HYD_MODEL_INSERAT));
        
        return $table;
    }
}

