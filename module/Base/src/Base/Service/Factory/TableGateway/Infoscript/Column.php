<?php

namespace Base\Service\Factory\TableGateway\Infoscript;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\Feature\SequenceFeature;

use Base\Constants as C;

class Column implements \Zend\ServiceManager\FactoryInterface {

    const TABLE    = C::DB_TBL_INFOSCRIPT_COLUMN;
    const PRIMARY  = C::DB_PK_INFOSCRIPT_COLUMN;
    const SEQUENCE = 'infospalte_id_seq';

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $adapter             = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $hydrator            = $serviceLocator->get(C::SM_HYD_MODEL_INFOSCRIPT_COLUMN);

        $feature             = new SequenceFeature(self::PRIMARY, self::SEQUENCE);

        $objectPrototype     = $serviceLocator->get(C::SM_ENTITY_INFOSCRIPT_COLUMN);
        $resultSetPrototype  = new HydratingResultSet($hydrator, $objectPrototype);

        return new TableGateway(self::TABLE, $adapter, $feature, $resultSetPrototype);
    }
}
