<?php

namespace Base\Model\Mapper;

use Zend\Db\Sql\Select;

use Base\Model\Entity\Fachhochschule as Entity;

class Fachhochschule {

    /**
     *
     * @var \Base\Model\Table\User
     */
    protected $tableUser;

    /**
     *
     * @var \Base\Model\Table\Fachhochschule
     */
    protected $tableFachhochschule;

    /**
     *
     * @var \Base\Model\Mapper\Infoscript
     */
    protected $mapperInfoscript;

    use ConnectionTrait;

    /**
     *
     * @return \Zend\Db\ResultSet\ResultSetInterface
     */
    public function fetchAll(){

        $resultSet = $this->getTableFachhochschule()->getTableGateway()->select(

            function (Select $select){

                $this->getJoin($select);
                return $select;
            }
        );

        return $resultSet;
    }


    /**
     *
     * @param int $id
     * @return \Base\Model\Entity\Fachhochschule
     * @throws \Exception
     */
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

    /**
     *
     * @param \Zend\Db\Sql\Select $select
     * @return \Zend\Db\Sql\Select
     */
    private function getJoin(Select $select){

        $select->join('user', 'user.user_id = fachhochschule.user_id');

        return $select;
    }


    /**
     *
     * @param \Base\Model\Entity\Fachhochschule $fachhochschule
     * @return \Base\Model\Entity\Fachhochschule
     * @throws \Exception
     */
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

            $this->deleteDependentInfoscripts($fachhochschule);

            $this->getTableFachhochschule()->delete($fachhochschule->getUserId());
            $this->getTableUser()->delete($fachhochschule->getUserId());


            $this->getConnection()->commit();
        }
        catch (\Exception $e){

            $this->getConnection()->rollback();
            throw $e;
        }
    }

    private function deleteDependentInfoscripts(Entity $fachhochschule) {

        $infoscriptResultSet = $this->getMapperInfoscript()->getByUserId($fachhochschule->getUserId());

        foreach ($infoscriptResultSet as $infoscript) {
            $this->getMapperInfoscript()->delete($infoscript, false);
        }
    }



    /**
     *
     * @return \Base\Model\Table\User
     */
    public function getTableUser() {
        return $this->tableUser;
    }

    /**
     *
     * @param \Base\Model\Table\User $tableUser
     * @return \Base\Model\Mapper\Fachhochschule
     */
    public function setTableUser(\Base\Model\Table\User $tableUser) {
        $this->tableUser = $tableUser;
        return $this;
    }


    /**
     *
     * @return \Base\Model\Table\Fachhochschule
     */
    public function getTableFachhochschule() {
        return $this->tableFachhochschule;
    }

    /**
     *
     * @param \Base\Model\Table\Fachhochschule $tableFachhochschule
     * @return \Base\Model\Mapper\Fachhochschule
     */
    public function setTableFachhochschule(\Base\Model\Table\Fachhochschule $tableFachhochschule) {
        $this->tableFachhochschule = $tableFachhochschule;
        return $this;
    }


    /**
     *
     * @return \Base\Model\Mapper\Infoscript
     */
    public function getMapperInfoscript() {
        return $this->mapperInfoscript;
    }

    /**
     *
     * @param \Base\Model\Mapper\Infoscript $mapperInfoscript
     * @return \Base\Model\Mapper\Fachhochschule
     */
    public function setMapperInfoscript(\Base\Model\Mapper\Infoscript $mapperInfoscript) {
        $this->mapperInfoscript = $mapperInfoscript;
        return $this;
    }
}