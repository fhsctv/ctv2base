<?php

namespace Base\Service\Factory\TableGateway;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\Feature\SequenceFeature;

use Base\Constants as C;

class User implements \Zend\ServiceManager\FactoryInterface {

    const TABLE    = C::DB_TBL_USER;
    const PRIMARY  = C::DB_PK_USER;
    const SEQUENCE = 'user_user_id_seq';

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $adapter             = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $hydrator            = $serviceLocator->get(C::SM_HYD_MODEL_USER);

        $feature             = new SequenceFeature(self::PRIMARY, self::SEQUENCE);

        $objectPrototype     = $serviceLocator->get(C::SM_ENTITY_USER);
        $resultSetPrototype  = new HydratingResultSet($hydrator, $objectPrototype);

        return new TableGateway(self::TABLE, $adapter, $feature, $resultSetPrototype);
    }
}
