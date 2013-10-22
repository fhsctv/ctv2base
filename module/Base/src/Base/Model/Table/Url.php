<?php

namespace Base\Model\Table;

use Zend\Db\Sql\Select;

use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;


class Url implements HydratorAwareInterface {
    
    
    protected $tableGateway;
    
    protected $hydrator;

    
    public function fetchAll(){
        
        return $this->getTableGateway()->select();
    }
    
    public function get($id) {
        
        $id = (int) $id;
        
        $resultSet = $this->getTableGateway()->select(
                
                function (Select $select) use ($id) {
                    $table = $this->getTableGateway()->getTable();
            
                    $select->where($table . '.' . C::URL_ID . '=' . $id );
                }
        );
        
        $result = $resultSet->current();
        
        if(!$result){
            throw new Exception\NotFound("Konnte Url mit der Id $id nicht finden!");
        }
        
        return $result;
    }
    
    public function save(\Base\Model\Entity\Url $url){
        
        if($url->getId() === null){
            
            return $this->insert($url);
        }
        
        return $this->update($url);
        
    }

    
    public function insert(\Base\Model\Entity\Url $url){
        
        $data = $this->getHydrator()->extract($url);
        
        $this->getTableGateway()->insert($data);
        
        return $this->getTableGateway()->getLastInsertValue();
    }
    
    public function update(\Base\Model\Entity\Url $url){
        
        $data = $this->getHydrator()->extract($url);
        
        $this->getTableGateway()->update($data, array(C::URL_ID => $url->getId()));
        
        return $url->getId();
        
    }

    public function delete($id){
        
        return $this->getTableGateway()->delete(array(C::URL_ID => (int) $id));
        
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