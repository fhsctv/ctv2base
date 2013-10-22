<?php

namespace Base\Model\Table;

use Zend\Db\Sql\Select;

use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class Infoscript implements HydratorAwareInterface {
    

    protected $tableGateway;
    
    protected $hydrator;


    public function fetchAll(){
        
        return $this->getTableGateway()->select(
                
//            function(Select $select){
//               
//                return $this->getJoin($select);
//            }
        );
        
    }

    public function get($id) {
        
        $id = (int) $id;
        
        $resultSet = $this->tableGateway->select(
                
                function (Select $select) use ($id) {
                    $table = $this->getTableGateway()->getTable();
            
//                    $select = $this->getJoin($select);
                    $select->where($table . '.' . C::INFO_ID . '=' . $id );
                }
        );
        
        $result = $resultSet->current();
        
        if(!$result){
            throw new Exception\NotFound("Konnte Infoscript mit der Id $id nicht finden!");
        }
        
        return $result;
    }

    public function save(\Base\Model\Entity\Infoscript $infoscript){
        
        
        
        return ($infoscript->getId() === null) ?
            $this->insert($infoscript):
            $this->update($infoscript);
    }

    
    public function insert(\Base\Model\Entity\Infoscript $infoscript){
        
        $data = $this->getHydrator()->extract($infoscript);
        
        $this->getTableGateway()->insert($data);
        
        return $this->getTableGateway()->getLastInsertValue();
    }
    
    public function update(\Base\Model\Entity\Infoscript $infoscript){
        
        $data = $this->getHydrator()->extract($infoscript);
        
        $this->getTableGateway()->update($data, array(C::INFO_ID => $infoscript->getId()));
        
        return $infoscript->getId();
        
    }

    public function delete($id){
        
        return $this->getTableGateway()->delete(array(C::INFO_ID => (int) $id));
        
    }

//    private function getJoin(Select $select){
//        
//        $columns   = array(
//            C::URL_ADRESSE,
//            C::URL_START,
//            C::URL_ENDE,
//            C::URL_AKTIV
//        );
//        
//        $condition = C::INFO_URL_ID . '=' . C::URL_TABLE . '.' .C::URL_ID;
//        
//        $select->join(C::URL_TABLE, $condition, $columns);
//        
//        return $select;
//        
//    }







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