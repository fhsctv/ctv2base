<?php

namespace Base\Model\Mapper;

use Base\Model\Entity\Infoscript as Entity;

class Infoscript {
    
    protected $tableInfoscript;
    protected $tableUrl;
    
    
    public function fetchAll(){
        
        return $this->getTableInfoscript()->fetchAll();
    }
    
    public function get($id) {
        
        return $this->getTableInfoscript()->get( (int) $id);
    }

    public function save(Entity $infoscript){
        
        $connection = $this->getTableInfoscript()->getTableGateway()->getAdapter()->getDriver()->getConnection();

        $connection->beginTransaction();
        try{
        
            $urlId = $this->getTableUrl()->save($infoscript->getUrl());

            $infoscript->setUrlId($urlId);

            $id = $this->getTableInfoscript()->save($infoscript);
            
            $connection->commit();
            
            return $id;
            
        }
         catch (\Exception $e){
             
             $connection->rollback();
             
             throw $e;
             
         }
        
    }





    public function getTableInfoscript() {
        return $this->tableInfoscript;
    }

    public function setTableInfoscript($tableInfoscript) {
        $this->tableInfoscript = $tableInfoscript;
        return $this;
    }

    public function getTableUrl() {
        return $this->tableUrl;
    }

    public function setTableUrl($tableUrl) {
        $this->tableUrl = $tableUrl;
        return $this;
    }


    
}