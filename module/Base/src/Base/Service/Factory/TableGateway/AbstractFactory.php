<?php

namespace Base\Service\Factory\TableGateway;

use Zend\Db\TableGateway\Feature\SequenceFeature;
use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\Adapter\AdapterInterface;

abstract class AbstractFactory  implements \Zend\ServiceManager\FactoryInterface {

    const ADAPTER  = 'Zend\Db\Adapter\Adapter';

    protected $adapter;
    protected $table;
    protected $feature;
    protected $resultSetPrototype;
    protected $hydrator;
    protected $entity;


    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $this->setAdapter($serviceLocator->get(self::ADAPTER));
        $this->setFeature(new SequenceFeature($this->getIdName(), $this->getSequenceName()));
        $this->setTable($this->getTableName());

    }

    protected abstract function getTableName();
    protected abstract function getSequenceName();
    protected abstract function getIdName();

    public function getAdapter() {
        return $this->adapter;
    }

    public function setAdapter(AdapterInterface $adapter) {
        $this->adapter = $adapter;
        return $this;
    }

    public function getTable() {
        return $this->table;
    }

    public function setTable($table) {

        assert(is_string($table));

        $this->table = $table;
        return $this;
    }

    public function getFeature() {
        return $this->feature;
    }

    public function setFeature(SequenceFeature $feature) {
        $this->feature = $feature;
        return $this;
    }

    public function getResultSetPrototype() {
        return $this->resultSetPrototype;
    }

    public function setResultSetPrototype(ResultSetInterface $resultSetPrototype) {
        $this->resultSetPrototype = $resultSetPrototype;
        return $this;
    }

    public function getHydrator() {
        return $this->hydrator;
    }

    public function setHydrator($hydrator) {
        $this->hydrator = $hydrator;
        return $this;
    }

    public function getEntity() {
        return $this->entity;
    }

    public function setEntity($entity) {
        $this->entity = $entity;
        return $this;
    }

}