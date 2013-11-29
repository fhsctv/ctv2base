<?php

namespace Base\Model\Mapper;

use Zend\Db\Sql\Select;

use Base\Model\Entity\Infoscript as Entity;

class Infoscript {

    protected $tableInserat;
    protected $tableInfoscript;
    protected $tableInseratBildschirmLinker;
    /**
     *
     * @var \Base\Model\Table\Bildschirm
     */
    protected $tableBildschirm;

    use ConnectionTrait;




    public function fetchAll(){

        $resultSet = $this->getTableInfoscript()->getTableGateway()->select(
                
            function (Select $select){
                
                $select->join('inserat', 'infoscript.inserat_id = inserat.inserat_id');
                return $select;
            }
        );
        
        //TODO schreibe eigenes hydratingResultSet, welches erst beim iterieren durch den cursor die abhängigkeiten aus der datenbank holt
        $resultSet->buffer();
        
        foreach ($resultSet as $infoscript) {
            
            $this->getBildschirme($infoscript);
            
        }
        
        return $resultSet;
    }
    

    
    public function getById($id) {

        $id = (int) $id;
        
        $resultSet = $this->getTableInfoscript()->getTableGateway()->select(
            function (Select $select) use ($id) {
                
                $table = $this->getTableInfoscript()->getTableGateway()->getTable();
            
                $select->join('inserat', 'infoscript.inserat_id = inserat.inserat_id');
                $select->where("$table . inserat_id = $id");
                return $select;
            }
        );
        
        $infoscript = $resultSet->current();
        
        if(!$infoscript){
            throw new \Exception("Infoscript mit der Id $id nicht vorhanden");
        }

        $this->getBildschirme($infoscript);
        
        return $infoscript;
    }
    
    public function getByUserId($userId){
        
        $userId = (int) $userId;
        
        $resultSet = $this->getTableInfoscript()->getTableGateway()->select(
            function (Select $select) use ($userId) {
                
                $table = $this->getTableInfoscript()->getTableGateway()->getTable();
            
                $select->join('inserat', 'infoscript.inserat_id = inserat.inserat_id');
                $select->where("$table . fk_fh_id = $userId");
            
            }
        );
        
        $resultSet->buffer();
        
        foreach ($resultSet as $infoscript) {
            
            $this->getBildschirme($infoscript);
            
        }

        return $resultSet;
    }
    
    public function getByBildschirmId($bildschirmId){
        
        $bildschirmId = (int) $bildschirmId;
        
        $infoscript = $this->getTableInfoscript()->getTableGateway()->select(
            function (Select $select) use ($bildschirmId) {
            
                $select = $this->getJoin($select);
                $select->join('bildschirm_inserat_linker', 'inserat.inserat_id = bildschirm_inserat_linker.inserat_id');
                $select->where("bildschirm_inserat_linker . bildschirm_id = $bildschirmId");
            
            }
        );

        $this->getBildschirme($infoscript);
        
        return $infoscript;
    }


    //TODO schreibe eigenes hydratingResultSet, welches erst beim iterieren durch den cursor die abhängigkeiten aus der datenbank holt
    private function getBildschirme(\Base\Model\Entity\Inserat $infoscript){
        
        $inseratId = $infoscript->getInseratId();
        
        $bildschirme = $this->getTableBildschirm()->getTableGateway()->select(
          
                function (Select $select) use ($inseratId) {
                    
                    $select->join('inserat_bildschirm_linker', 'bildschirm.bildschirm_id = inserat_bildschirm_linker.bildschirm_id');
                    $select->where("inserat_bildschirm_linker.inserat_id = $inseratId");
            
                    return $select;
                }
                
        );
        
        foreach($bildschirme as $bildschirm){
            $infoscript->addBildschirm($bildschirm);
        }
        
        return $infoscript;
    }

    
    
    
    
    public function save(Entity $infoscript){

        
        $inserat_id = $infoscript->getInseratId();
        
        //1. Inserat in Db (inserat) speichern und seine id speichern
        //2. Infoscript in Db (infoscript) speichern
        //3. Bildschirm in Db (bildschirm_inserat_linker) speichern
        
        
        try {

            $this->getConnection()->beginTransaction();
            
            $this->saveInserat($infoscript);
            $this->saveInfoscript($infoscript, $inserat_id);
            
            if ($inserat_id === NULL) {
                $this->saveBildschirme($infoscript);
            }


            $this->getConnection()->commit();
            return $infoscript;

        }
        catch (\Exception $e){

            $this->getConnection()->rollback();
            throw $e;
        }

    }
    
    private function saveInserat($infoscript){
        
        $inseratId = $this->getTableInserat()->save($infoscript);
        $infoscript->setInseratId($inseratId);
        
        return $infoscript;
    }
    
    private function saveInfoscript($infoscript, $update = false){
        
        if (!$update) {
            return $this->getTableInfoscript()->insert($infoscript);
        }

        return $this->getTableInfoscript()->update($infoscript);
        
    }
    
    private function saveBildschirme($infoscript){
        
        foreach ($infoscript->getBildschirme() as $bildschirm) {
            
            $data = array(
                'inserat_id'    => $infoscript->getInseratId(),
                'bildschirm_id' => $bildschirm,
            );
            
            $this->getTableInseratBildschirmLinker()->save($data);
        }
    }

    public function delete(Entity $infoscript){


        try{
            
            $this->getConnection()->beginTransaction();
            
            //funktioniert nur mit entsprechenden cascade- constraints
            //ansonsten müssen die abhängigkeiten manuell entfernt werden
            $this->getTableInserat()->delete($infoscript->getInseratId());
            

            $this->getConnection()->commit();
        }
        catch (\Exception $e){

            $this->getConnection()->rollback();
            throw $e;
        }
    }

    
    // <editor-fold defaultstate="collapsed" desc="Table Getters & Setters">

    public function getTableInserat() {
        return $this->tableInserat;
    }

    public function setTableInserat($tableInserat) {
        $this->tableInserat = $tableInserat;
        return $this;
    }

    public function getTableInseratBildschirmLinker() {
        return $this->tableInseratBildschirmLinker;
    }

    public function setTableInseratBildschirmLinker($tableInseratBildschirmLinker) {
        $this->tableInseratBildschirmLinker = $tableInseratBildschirmLinker;
        return $this;
    }

    /**
     * 
     * @return \Base\Model\Table\Bildschirm
     */
    public function getTableBildschirm() {
        return $this->tableBildschirm;
    }

    /**
     * 
     * @param \Base\Model\Table\Bildschirm $tableBildschirm
     * @return \Base\Model\Mapper\Bildschirm
     */
    public function setTableBildschirm(\Base\Model\Table\Bildschirm $tableBildschirm) {
        $this->tableBildschirm = $tableBildschirm;
        return $this;
    }


    public function getTableInfoscript() {
        return $this->tableInfoscript;
    }

    public function setTableInfoscript($tableInfoscript) {
        $this->tableInfoscript = $tableInfoscript;
        return $this;
    }

    // </editor-fold>

}