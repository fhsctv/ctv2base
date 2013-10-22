<?php

namespace Base\Model\Table;

use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;


class Url implements HydratorAwareInterface {
    
    
    protected $tableGateway;
    
    protected $hydrator;

    
    public function save(\Base\Model\Entity\Url $url){
        
        $data = $this->getHydrator()->extract($url);
//        unset($data[C::URL_DEPENDENCY]);
        
//        var_dump($data);
        
        return ($url->getDependency()->getUrlId() === null) ?
            $this->insert($data):
            $this->update($data);
    }

    
    public function insert(array $data){
        
        $this->getTableGateway()->insert($data);
        
        return $this->getTableGateway()->getLastInsertValue();
    }
    
    public function update(array $data){
        
        $this->getTableGateway()->update($data);
        
        return $data[C::URL_ID];
        
    }

    
    public function getTableGateway() {
        return $this->tableGateway;
    }

    public function setTableGateway($tableGateway) {
        $this->tableGateway = $tableGateway;
        return $this;
    }

    public function getHydrator() {
        
        return $this->hydrator;
    }

    public function setHydrator(HydratorInterface $hydrator) {
        
        $this->hydrator = $hydrator;
    }

}