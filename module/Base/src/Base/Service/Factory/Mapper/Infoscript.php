<?php

namespace Base\Service\Factory\Mapper;

use Zend\ServiceManager\FactoryInterface;

use Base\Constants as C;
use Base\Model\Mapper\Infoscript as Mapper;

class Infoscript implements FactoryInterface {

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $mapper = new Mapper();
        $mapper->setTableInfoscript($serviceLocator->get(C::SERVICE_TABLE_INFOSCRIPT));
        $mapper->setTableUrl($serviceLocator->get(C::SERVICE_TABLE_URL));
        $mapper->setConnection($serviceLocator->get('Zend\Db\Adapter\Adapter')->getDriver()->getConnection());

        return $mapper;
    }

}
