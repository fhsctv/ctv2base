<?php

namespace Base\Model\Table;

use Zend\Db\Sql\Select;

use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class InseratBildschirmLinker implements HydratorAwareInterface {
    

    protected $tableGateway;
    
    protected $hydrator;



    public function save($data){
        
        return $this->insert($data);
    }

    
    
    
    
    
    public function insert($data){
        
        $this->getTableGateway()->insert($data);
        
        return $this->getTableGateway()->getLastInsertValue();
    }
    


    public function delete($inseratId, $bildschirmId){
        
        return $this->getTableGateway()->delete(
                array('inserat_id' => (int) $inseratId, 
                      'bildschirm_id' => (int) $bildschirmId));
    }


    public function getByInseratId($inseratId) {

        $inseratId = (int) $inseratId;

        $resultSet = $this->tableGateway->select(

                function (Select $select) use ($inseratId) {

                    $select->where("inserat_id = $inseratId");
                    $select->columns(array('bildschirm_id'));
                    return $select;
                }
        );

        return $resultSet;
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