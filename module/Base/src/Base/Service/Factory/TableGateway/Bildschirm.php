<?php

namespace Base\Service\Factory\TableGateway;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\Feature\SequenceFeature;

use Base\Constants as C;

class Bildschirm implements \Zend\ServiceManager\FactoryInterface {
    
    const TABLE    = 'bildschirm';
    const PRIMARY  = 'bildschirm_id';
    const SEQUENCE = 'bildschirm_bildschirm_id_seq';

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $adapter             = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $hydrator            = $serviceLocator->get(C::SERVICE_HYDRATOR_MODEL_BILDSCHIRM);
        
        $feature             = new SequenceFeature(self::PRIMARY, self::SEQUENCE);
        
        $objectPrototype     = $serviceLocator->get(C::SERVICE_ENTITY_BILDSCHIRM);
        $resultSetPrototype  = new HydratingResultSet($hydrator, $objectPrototype);

        return new TableGateway(self::TABLE, $adapter, $feature, $resultSetPrototype);
    }
}
