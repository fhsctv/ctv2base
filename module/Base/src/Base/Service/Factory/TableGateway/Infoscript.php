<?php

namespace Base\Service\Factory\TableGateway;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\HydratingResultSet;

use Base\Constants as C;

use Base\Model\Hydrator\Infoscript as Hydrator;
use Base\Model\Entity\Infoscript   as InfoscriptEntity;
//use Base\Model\Entity\Url          as UrlEntity;

class Infoscript implements \Zend\ServiceManager\FactoryInterface {

    const TABLE    = 'infoscript';


    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        //:TODO use ServiceManager
        $hydrator            = new Hydrator();
        $objectPrototype     = new InfoscriptEntity();
        $resultSetPrototype  = new HydratingResultSet($hydrator, $objectPrototype);

        return new TableGateway(self::TABLE, $serviceLocator->get('Zend\Db\Adapter\Adapter'), null, $resultSetPrototype);
    }
}
