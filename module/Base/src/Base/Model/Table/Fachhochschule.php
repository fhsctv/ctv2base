<?php

namespace Base\Model\Table;

use Zend\Db\Sql\Select;

use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class Fachhochschule implements HydratorAwareInterface {
    

    protected $tableGateway;
    
    protected $hydrator;


    public function fetchAll(){
        
        return $this->getTableGateway()->select();
        
    }

    public function getById($id) {
        
        $id = (int) $id;
        
        $resultSet = $this->getTableGateway()->select(
                
                function (Select $select) use ($id) {
                    $table = $this->getTableGateway()->getTable();
            
                    $select->where($table . '.' . 'user_id' . '=' . $id );
                }
        );
        
        $result = $resultSet->current();
        
        if(!$result){
            throw new Exception\NotFound("Konnte User mit der Id $id nicht finden!");
        }
        
        return $result;
    }


    
    public function insert(\Base\Model\Entity\Fachhochschule $fachhochschule){
        
        $data = $this->getHydrator()->extract($fachhochschule);
        
        $this->getTableGateway()->insert($data);
        
        return $this->getTableGateway()->getLastInsertValue();
    }
    
    public function update(\Base\Model\Entity\Fachhochschule $fachhochschule){
        
        $data = $this->getHydrator()->extract($fachhochschule);
        
        $this->getTableGateway()->update($data, array('inserat_id' => $fachhochschule->getInseratId()));
        
        return $fachhochschule->getInseratId();
        
    }

    public function delete($id){
        
        return $this->getTableGateway()->delete(array('user_id' => (int) $id));
        
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