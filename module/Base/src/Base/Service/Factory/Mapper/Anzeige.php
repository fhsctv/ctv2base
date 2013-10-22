<?php

namespace Base\Service\Factory\Mapper;

use Zend\ServiceManager\FactoryInterface;

use Base\Constants as C;
use Base\Model\Mapper\Anzeige as Mapper;

class Anzeige implements FactoryInterface {

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $mapper = new Mapper();
        $mapper->setTableAnzeige($serviceLocator->get(C::SERVICE_TABLE_ANZEIGE));
        $mapper->setTableUrl($serviceLocator->get(C::SERVICE_TABLE_URL));
        $mapper->setConnection($serviceLocator->get('Zend\Db\Adapter\Adapter')->getDriver()->getConnection());

        return $mapper;
    }

}

