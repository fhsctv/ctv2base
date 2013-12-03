<?php

namespace Base\Service\Factory\Mapper;

use Zend\ServiceManager\FactoryInterface;

use Base\Constants as C;
use Base\Model\Mapper\Infoscript as Mapper;

class Infoscript implements FactoryInterface {

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $mapper = new Mapper();
        $mapper->setTableInfoscript($serviceLocator->get(C::SM_TBL_INFOSCRIPT));
        $mapper->setTableInserat($serviceLocator->get(C::SM_TBL_INSERAT));
        $mapper->setTableInseratBildschirmLinker($serviceLocator->get(C::SM_TBL_INSERATBILDSCHIRMLINKER));
        $mapper->setTableBildschirm($serviceLocator->get(C::SM_TBL_BILDSCHIRM));
        $mapper->setTgwColumns($serviceLocator->get(C::SM_TGW_INFOSCRIPT_COLUMN));

        $mapper->setConnection($serviceLocator->get('Zend\Db\Adapter\Adapter')->getDriver()->getConnection());

        return $mapper;
    }

}

