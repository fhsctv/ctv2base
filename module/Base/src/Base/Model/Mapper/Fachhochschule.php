<?php

namespace Base\Model\Mapper;

use Zend\Db\Sql\Select;

use Base\Constants as C;
use Base\Model\Entity\Fachhochschule as Entity;

class Fachhochschule implements IMapper {

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
    public function findAll() {

        $resultSet = $this->getTableFachhochschule()->getTableGateway()->select(

            function (Select $select){

                $this->_joinWithUserTable($select);
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
    public function findById($id) {

        $id = (int) $id;

        $resultSet = $this->getTableFachhochschule()->getTableGateway()->select(

            function (Select $select) use ($id) {

                $select = $this->_joinWithUserTable($select);
                $select->where(sprintf('%s.%s=%s', C::DB_TBL_FACHHOCHSCHULE, C::DB_PK_FACHHOCHSCHULE, $id));

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
     * @param string $username
     * @return \Base\Model\Entity\Fachhochschule
     * @throws \Exception
     */
    public function findByUserName($username){

        $resultSet = $this->findBy('username', $username);

        $fachhochschule = $resultSet->current();

        if(!$fachhochschule){
            throw new \Exception("Benutzername $username nicht gefunden!");
        }

        return $fachhochschule;
    }

    /**
     *
     * @param string $email
     * @return \Base\Model\Entity\Fachhochschule
     * @throws \Exception
     */
    public function findByEmail($email){

        $resultSet = $this->findBy('email', $email);

        $fachhochschule = $resultSet->current();

        if(!$fachhochschule){
            throw new \Exception("Benutzer mit der Emailadresse $email nicht gefunden!");
        }

        return $fachhochschule;
    }

    /**
     * Find rows by a column and its value
     * @param string $column
     * @param string $value
     * @return \Zend\Db\ResultSet\ResultSetInterface
     */
    public function findBy($column, $value) {

        return $this->getTableFachhochschule()->getTableGateway()->select(

            function (Select $select) use ($column, $value) {

                $fhTable = $this->getTableFachhochschule()->getTableGateway()->getTable();

                $select = $this->_joinWithUserTable($select);
                $select->where(sprintf('%s.%s=%s', $fhTable, $column, $value));

                return $select;
            }
        );
    }


    /**
     *
     * @param \Base\Model\Entity\Fachhochschule $fachhochschule
     * @return \Base\Model\Entity\Fachhochschule
     * @throws \Exception
     */
    public function save(\Base\Model\Entity\IEntity $fachhochschule){

        //user_id speichern um später zu schauen, ob sie schon da war oder nicht
        //dies wird verwendet um zu unterscheiden, ob ein insert oder ein update
        //durchgeführt wird
        $user_id = $fachhochschule->getUserId();

        //1. User in Db (user) speichern und seine id speichern
        //2. Fachhochschule in Db (fachhochschule) speichern

        try {

            $this->getConnection()->beginTransaction();

            $this->_saveUser($fachhochschule);
            $this->_saveFachhochschule($fachhochschule, $user_id);


            $this->getConnection()->commit();
            return $fachhochschule;

        }
        catch (\Exception $e){

            $this->getConnection()->rollback();
            throw $e;
        }
    }


    /**
     *
     * @param \Base\Model\Entity\Fachhochschule $fachhochschule
     * @param bool $useTransactions Wird diese Methode innerhalb einer
     * Transaktion aufgerufen, muss hier bei Datenbanken, die keine
     * verschachtelten Transaktionen unterstützen, die Transaktion deaktiviert
     * werden.
     * @return void
     * @throws \Base\Model\Mapper\Exception
     */
    public function delete(\Base\Model\Entity\IEntity $fachhochschule, $useTransactions = true){

        try{

            !$useTransactions ? : $this->getConnection()->beginTransaction();

//            $this->deleteDependentInfoscripts($fachhochschule);
//
//            $this->getTableFachhochschule()->delete($fachhochschule->getUserId());

            //cascading delete
            $this->getTableUser()->delete($fachhochschule->getUserId());

            !$useTransactions ? : $this->getConnection()->commit();
        }
        catch (\Exception $e){

            !$useTransactions ? : $this->getConnection()->rollback();
            throw $e;
        }
    }


    // <editor-fold defaultstate="collapsed" desc="helper methods">

    /**
     *
     * @param \Zend\Db\Sql\Select $select
     * @return \Zend\Db\Sql\Select
     */
    private function _joinWithUserTable(Select $select) {

        $select->join(C::DB_TBL_USER, sprintf('%s.%s=%s.%s', C::DB_TBL_USER, C::DB_PK_USER, C::DB_TBL_FACHHOCHSCHULE, C::DB_FK_FACHHOCHSCHULE_USER));

        return $select;
    }

    /**
     *
     * @param \Base\Model\Entity\Fachhochschule $fachhochschule
     * @return int user_id the saved Entity
     */
    private function _saveUser(Entity $fachhochschule) {

        $userId = $this->getTableUser()->save($fachhochschule);
        $fachhochschule->setUserId($userId);

        return $userId;
    }

    private function _saveFachhochschule($fachhochschule, $user_id = false) {

        if (!$user_id) {
            return $this->getTableFachhochschule()->insert($fachhochschule);
        }

        return $this->getTableFachhochschule()->update($fachhochschule);
        }

    private function _deleteDependentInfoscripts(Entity $fachhochschule) {

        $infoscriptResultSet = $this->getMapperInfoscript()->getByUserId($fachhochschule->getUserId());

        foreach ($infoscriptResultSet as $infoscript) {
            $this->getMapperInfoscript()->delete($infoscript, false);
        }
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="getters and setters">

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

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="deprecated">
    /**
     * @deprecated use findAll instead
     * @return \Zend\Db\ResultSet\ResultSetInterface
     */
    public function fetchAll() {

        return $this->findAll();
    }

    /**
     * @deprecated use findById instead
     * @param int $id
     * @return \Base\Model\Entity\Fachhochschule
     * @throws \Exception
     */
    public function getById($id) {

        return $this->findById($id);
    }
    // </editor-fold>

}