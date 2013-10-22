<?php

namespace Base\Model\Mapper;

use Base\Model\Entity\Infoscript as Entity;

class Infoscript {

    protected $tableInfoscript;
    protected $tableUrl;

    protected $connection;




    public function fetchAll(){

        $infoscriptResultSet = $this->getTableInfoscript()->fetchAll();
        $infoscriptResultSet->buffer();

        foreach ($infoscriptResultSet as $infoscript){

            $infoscript->setUrl($this->getTableUrl()->get($infoscript->getUrlId()));
        }

        return $infoscriptResultSet;
    }

    public function get($id) {

        $infoscript = $this->getTableInfoscript()->get( (int) $id);
        $infoscript->setUrl($this->getTableUrl()->get($infoscript->getUrlId()));

        return $infoscript;
    }

    public function save(Entity $infoscript){

        $this->getConnection()->beginTransaction();
        try {

            $urlId = $this->getTableUrl()->save($infoscript->getUrl());

            $infoscript->setUrlId($urlId);
            $infoscript->getUrl()->setId($urlId);

            $id = $this->getTableInfoscript()->save($infoscript);
            $infoscript->setId($id);

            $this->getConnection()->commit();

            return $id;

        }
        catch (\Exception $e){

            $this->getConnection()->rollback();
            throw $e;
        }

    }

    public function delete(Entity $infoscript){

        $this->getConnection()->beginTransaction();

        try{

            $this->getTableInfoscript()->delete($infoscript->getId());
            $this->getTableUrl()->delete($infoscript->getUrl()->getId());

            $this->getConnection()->commit();
        }
        catch (\Exception $e){

            $this->getConnection()->rollback();
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

    public function getConnection() {
        return $this->connection;
    }

    public function setConnection($connection) {
        $this->connection = $connection;
        return $this;
    }
}