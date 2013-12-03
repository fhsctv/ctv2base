<?php

namespace Base\Service\Factory\TableGateway;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\HydratingResultSet;

use Base\Constants as C;

class Fachhochschule implements \Zend\ServiceManager\FactoryInterface {

    const TABLE    = C::DB_TBL_FACHHOCHSCHULE;


    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $hydrator            = $serviceLocator->get(C::SM_HYD_MODEL_FACHHOCHSCHULE);
        $objectPrototype     = $serviceLocator->get(C::SM_ENTITY_FACHHOCHSCHULE);
        $resultSetPrototype  = new HydratingResultSet($hydrator, $objectPrototype);

        return new TableGateway(self::TABLE, $serviceLocator->get('Zend\Db\Adapter\Adapter'), null, $resultSetPrototype);
    }
}
