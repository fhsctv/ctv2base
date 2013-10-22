<?php

namespace Base\Service\Factory\TableGateway;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\HydratingResultSet;

use Base\Constants as C;

use Base\Model\Hydrator\Url as Hydrator;
use Base\Model\Entity\Url   as UrlEntity;

class Url extends AbstractFactory {
    
    const TABLE    = C::URL_TABLE;
    const ID       = C::URL_ID;
    const SEQUENCE = 'url_id_seq';


    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        parent::createService($serviceLocator);

        $this->setEntity(new UrlEntity());
        $this->setHydrator(new Hydrator());
        $this->setResultSetPrototype(new HydratingResultSet($this->getHydrator(), $this->getEntity()));

        return new TableGateway(
                $this->getTable(),
                $this->getAdapter(),
                $this->getFeature(),
                $this->getResultSetPrototype()
        );
    }

    protected function getIdName() {
        return self::ID;
    }

    protected function getSequenceName() {
        return self::SEQUENCE;
    }

    protected function getTableName() {
        return self::TABLE;
    }

}
