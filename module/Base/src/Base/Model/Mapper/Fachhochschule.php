<?php

namespace Base\Model\Mapper;

use Zend\Db\Sql\Select;

use Base\Model\Entity\Fachhochschule as Entity;

class Fachhochschule {

    protected $tableUser;
    protected $tableFachhochschule;

    use ConnectionTrait;


    public function fetchAll(){

        $resultSet = $this->getTableFachhochschule()->getTableGateway()->select(
                
            function (Select $select){
                
                $this->getJoin($select);
                return $select;
            }
        );
        
        return $resultSet;
    }
    

    
    public function getById($id) {

        $id = (int) $id;
        
        $resultSet = $this->getTableFachhochschule()->getTableGateway()->select(
            function (Select $select) use ($id) {
                
                $table = $this->getTableFachhochschule()->getTableGateway()->getTable();
            
                $select = $this->getJoin($select);
                $select->where("$table . user_id = $id");
                return $select;
            }
        );
        
        $fachhochschule = $resultSet->current();
        
        if(!$fachhochschule){
            throw new \Exception("User mit der Id $id nicht vorhanden");
        }

        
        return $fachhochschule;
    }


    private function getJoin(Select $select){
        
        $select->join('user', 'user.user_id = fachhochschule.user_id');
        
        return $select;
    }

    
    
    
    
    public function save(Entity $fachhochschule){

        //user_id speichern um später zu schauen, ob sie schon da war oder nicht
        //dies wird verwendet um zu unterscheiden, ob ein insert oder ein update
        //durchgeführt wird
        $user_id = $fachhochschule->getUserId();
        
        //1. User in Db (user) speichern und seine id speichern
        //2. Fachhochschule in Db (fachhochschule) speichern
        
        
        try {

            $this->getConnection()->beginTransaction();
            
            $this->saveUser($fachhochschule);
            $this->saveFachhochschule($fachhochschule, $user_id);


            $this->getConnection()->commit();
            return $fachhochschule;

        }
        catch (\Exception $e){

            $this->getConnection()->rollback();
            throw $e;
        }

    }
    
    private function saveUser($fachhochschule){
        
        $userId = $this->getTableUser()->save($fachhochschule);
        $fachhochschule->setUserId($userId);
        
        return $fachhochschule;
    }
    
    private function saveFachhochschule($fachhochschule, $update = false){
        
        if (!$update) {
            return $this->getTableFachhochschule()->insert($fachhochschule);
        }

        return $this->getTableFachhochschule()->update($fachhochschule);
        
    }
    

    public function delete(Entity $fachhochschule){


        try{
            
            $this->getConnection()->beginTransaction();
            
            //funktioniert nur mit entsprechenden cascade- constraints
            //ansonsten müssen die abhängigkeiten manuell entfernt werden
            $this->getTableFachhochschule()->delete($fachhochschule->getUserId());
            $this->getTableUser()->delete($fachhochschule->getUserId());
            

            $this->getConnection()->commit();
        }
        catch (\Exception $e){

            $this->getConnection()->rollback();
            throw $e;
        }
    }

    
    
    
    public function getTableUser() {
        return $this->tableUser;
    }

    public function setTableUser($tableUser) {
        $this->tableUser = $tableUser;
        return $this;
    }

    
    public function getTableFachhochschule() {
        return $this->tableFachhochschule;
    }

    public function setTableFachhochschule($tableFachhochschule) {
        $this->tableFachhochschule = $tableFachhochschule;
        return $this;
    }

}