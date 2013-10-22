<?php

namespace Base\Model\Mapper;

use Base\Model\Entity\Anzeige as Entity;

class Anzeige {

    protected $tableAnzeige;
    protected $tableUrl;

    protected $connection;




    public function fetchAll(){

        $anzeigeResultSet = $this->getTableAnzeige()->fetchAll();
        $anzeigeResultSet->buffer();

        foreach ($anzeigeResultSet as $anzeige){

            $anzeige->setUrl($this->getTableUrl()->get($anzeige->getUrlId()));
        }

        return $anzeigeResultSet;
    }

    public function get($id) {

        $anzeige = $this->getTableAnzeige()->get( (int) $id);
        $anzeige->setUrl($this->getTableUrl()->get($anzeige->getUrlId()));

        return $anzeige;
    }

    public function save(Entity $anzeige){

        $this->getConnection()->beginTransaction();
        try {

            $urlId = $this->getTableUrl()->save($anzeige->getUrl());

            $anzeige->setUrlId($urlId);
            $anzeige->getUrl()->setId($urlId);

            $id = $this->getTableAnzeige()->save($anzeige);
            $anzeige->setId($id);

            $this->getConnection()->commit();

            return $id;

        }
        catch (\Exception $e){

            $this->getConnection()->rollback();
            throw $e;
        }

    }

    public function delete(Entity $anzeige){

        $this->getConnection()->beginTransaction();

        try{

            $this->getTableAnzeige()->delete($anzeige->getId());
            $this->getTableUrl()->delete($anzeige->getUrl()->getId());

            $this->getConnection()->commit();
        }
        catch (\Exception $e){

            $this->getConnection()->rollback();
            throw $e;
        }
    }



    public function getTableAnzeige() {
        return $this->tableAnzeige;
    }

    public function setTableAnzeige($tableAnzeige) {
        $this->tableAnzeige = $tableAnzeige;
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