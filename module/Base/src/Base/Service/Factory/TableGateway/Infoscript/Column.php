<?php

namespace Base\Service\Factory\TableGateway\Infoscript;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\Feature\SequenceFeature;

use Base\Constants as C;

class Column implements \Zend\ServiceManager\FactoryInterface {

    const TABLE    = 'infospalte';
    const PRIMARY  = 'id';
    const SEQUENCE = 'infospalte_id_seq';

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $adapter             = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $hydrator            = $serviceLocator->get(C::SERVICE_HYDRATOR_MODEL_INFOSCRIPT_COLUMN);

        $feature             = new SequenceFeature(self::PRIMARY, self::SEQUENCE);

        $objectPrototype     = $serviceLocator->get(C::SERVICE_ENTITY_INFOSCRIPT_COLUMN);
        $resultSetPrototype  = new HydratingResultSet($hydrator, $objectPrototype);

        return new TableGateway(self::TABLE, $adapter, $feature, $resultSetPrototype);
    }
}
