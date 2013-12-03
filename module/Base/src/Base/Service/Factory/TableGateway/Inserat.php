<?php

namespace Base\Service\Factory\TableGateway;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\Feature\SequenceFeature;

use Base\Constants as C;

class Inserat implements \Zend\ServiceManager\FactoryInterface {

    const TABLE    = C::DB_TBL_INSERAT;
    const PRIMARY  = C::DB_PK_INSERAT;
    const SEQUENCE = 'inserat_inserat_id_seq';

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $adapter             = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $hydrator            = $serviceLocator->get(C::SM_HYD_MODEL_INSERAT);

        $feature             = new SequenceFeature(self::PRIMARY, self::SEQUENCE);

        $objectPrototype     = $serviceLocator->get(C::SM_ENTITY_INSERAT);
        $resultSetPrototype  = new HydratingResultSet($hydrator, $objectPrototype);

        return new TableGateway(self::TABLE, $adapter, $feature, $resultSetPrototype);
    }
}
