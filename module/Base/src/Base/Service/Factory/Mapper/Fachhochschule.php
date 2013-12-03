<?php

namespace Base\Service\Factory\Mapper;

use Zend\ServiceManager\FactoryInterface;

use Base\Constants as C;
use Base\Model\Mapper\Fachhochschule as Mapper;

class Fachhochschule implements FactoryInterface {

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $mapper = new Mapper();
        $mapper->setTableUser($serviceLocator->get(C::SM_TBL_USER));
        $mapper->setTableFachhochschule($serviceLocator->get(C::SM_TBL_FACHHOCHSCHULE));
        $mapper->setMapperInfoscript($serviceLocator->get(C::SM_MAP_INFOSCRIPT));

        $mapper->setConnection($serviceLocator->get('Zend\Db\Adapter\Adapter')->getDriver()->getConnection());

        return $mapper;
    }

}

