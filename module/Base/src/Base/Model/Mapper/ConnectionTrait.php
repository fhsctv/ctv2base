<?php

namespace Base\Model\Mapper;

trait ConnectionTrait {
    
    /**
     * 
     * @var \Zend\Db\Adapter\Driver\ConnectionInterface
     */
    protected $connection;
    
    /**
     * 
     * @return \Zend\Db\Adapter\Driver\ConnectionInterface
     */
    public function getConnection() {
        return $this->connection;
    }

    /**
     * @return \Base\Model\Mapper\ConnectionTrait
     */
    public function setConnection(\Zend\Db\Adapter\Driver\ConnectionInterface $connection) {
        $this->connection = $connection;
        return $this;
    }
    
}