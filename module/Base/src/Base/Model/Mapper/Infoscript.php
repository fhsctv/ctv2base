<?php

namespace Base\Model\Mapper;

use Zend\Db\Sql\Select;

use Base\Constants as C;
use Base\Model\Entity\Infoscript as Entity;

class Infoscript implements IMapper {

    /**
     *
     * @var \Base\Model\Table\Inserat
     */
    protected $tableInserat;

    /**
     *
     * @var \Base\Model\Table\Infoscript
     */
    protected $tableInfoscript;

    /**
     *
     * @var \Base\Model\Table\InseratBildschirmLinker
     */
    protected $tableInseratBildschirmLinker;

    /**
     *
     * @var \Base\Model\Table\Bildschirm
     */
    protected $tableBildschirm;

    /**
     *
     * @var \Zend\Db\TableGateway\TableGatewayInterface
     */
    protected $tgwColumns;


    use ConnectionTrait;


    /**
     *
     * @return \Zend\Db\ResultSet\ResultSetInterface
     */
    public function findAll(){

        $resultSet = $this->getTableInfoscript()->getTableGateway()->select(

            function (Select $select){

                return $this->joinWithInseratTable($select);
            }
        );

        //:TODO schreibe eigenes hydratingResultSet, welches erst beim iterieren durch den cursor die abhängigkeiten aus der datenbank holt
        $resultSet->buffer();

        foreach ($resultSet as $infoscript) {

            $this->getBildschirme($infoscript);
            $this->getColumns($infoscript);
        }

        return $resultSet;
    }


    /**
     *
     * @param int $id
     * @return \Base\Model\Entity\Infoscript
     * @throws \Exception
     */
    public function findById($id) {

        $id = (int) $id;

        $resultSet = $this->findBy(C::DB_PK_INFOSCRIPT, $id);

        $infoscript = $resultSet->current();
        if(!$infoscript){
            throw new \Exception("Infoscript mit der Id $id nicht vorhanden");
        }

        $this->getBildschirme($infoscript);
        $this->getColumns($infoscript);

        return $infoscript;
    }

    /**
     *
     * @param int $userId
     * @return \Zend\Db\ResultSet\ResultSetInterface
     */
    public function findByUserId($userId) {

        $userId = (int) $userId;

        $resultSet = $this->findBy(C::DB_FK_INFOSCRIPT_FACHHOCHSCHULE, $userId);
        $resultSet->buffer();

        foreach ($resultSet as $infoscript) {

            $this->getBildschirme($infoscript);
            $this->getColumns($infoscript);
        }

        return $resultSet;
    }

    /**
     *
     * @param int $displayId
     * @return \Zend\Db\ResultSet\ResultSetInterface
     */
    public function findByDisplayId($displayId) {

        $displayId = (int) $displayId;

        $resultSet = $this->getTableInfoscript()->getTableGateway()->select(
            function (Select $select) use ($displayId) {

                $this->joinWithInseratTable($select);
                $this->joinWithInseratDisplayLinkerTable($select);
                $select->where("bildschirm_inserat_linker . bildschirm_id = $displayId");

            }
        );

        foreach ($resultSet as $infoscript) {

            $this->getBildschirme($infoscript);
            $this->getColumns($infoscript);

        }

        return $infoscript;

    }


    /**
     * Find rows by a column and its value
     * @param string $column
     * @param string $value
     * @return \Zend\Db\ResultSet\ResultSetInterface
     */
    public function findBy($column, $value) {

        return $this->getTableInfoscript()->getTableGateway()->select(

            function (Select $select) use ($column, $value) {

                $infoTable = $this->getTableInfoscript()->getTableGateway()->getTable();

                $select = $this->joinWithInseratTable($select);
                $select->where(sprintf('%s.%s=%s', $infoTable, $column, $value));

                return $select;
            }
        );
    }


    /**
     *
     * @param \Base\Model\Entity\Infoscript $infoscript
     * @return \Base\Model\Entity\Infoscript
     * @throws \Exception
     */
    public function save(\Base\Model\Entity\IEntity $infoscript){

        $inserat_id = $infoscript->getInseratId();

        //1. Inserat in Db (inserat) speichern und seine id speichern
        //2. Infoscript in Db (infoscript) speichern
        //3. Bildschirm in Db (bildschirm_inserat_linker) speichern

        try {

            $this->getConnection()->beginTransaction();

            $this->saveInserat($infoscript);
            $this->saveInfoscript($infoscript, $inserat_id);

            if (!$inserat_id) {
                $this->saveBildschirme($infoscript);
            }

            $this->saveColums($infoscript);

            $this->getConnection()->commit();
            return $infoscript;

        }
        catch (\Exception $e){

            $this->getConnection()->rollback();
            throw $e;
        }
    }


    /**
     *
     * @param \Base\Model\Entity\Infoscript $infoscript
     * @param bool $useTransactions Wird diese Methode innerhalb einer
     * Transaktion aufgerufen, muss hier bei Datenbanken, die keine
     * verschachtelten Transaktionen unterstützen, die Transaktion deaktiviert
     * werden.
     * @throws \Base\Model\Mapper\Exception
     */
    public function delete(\Base\Model\Entity\IEntity $infoscript, $useTransactions = true){

        try{

            !$useTransactions ? : $this->getConnection()->beginTransaction();

            //funktioniert nur mit entsprechenden cascade- constraints
            //ansonsten müssen die abhängigkeiten manuell entfernt werden
            $this->getTableInserat()->delete($infoscript->getInseratId());


            !$useTransactions ? : $this->getConnection()->commit();
        }
        catch (\Exception $e){

            !$useTransactions ? : $this->getConnection()->rollback();
            throw $e;
        }
    }


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
     * @return \Base\Model\Entity\Infoscript
     */
    public function getById($id) {

        return $this->findById($id);
    }

    /**
     * @deprecated use findByUserId instead
     * @param int $userId
     * @return \Zend\Db\ResultSet\ResultSetInterface
     */
    public function getByUserId($userId) {

        return $this->findByUserId($userId);
    }

    /**
     * @deprecated use findByDisplayId instead
     * @param int $displayId
     * @return \Zend\Db\ResultSet\ResultSetInterface
     */
    public function getByBildschirmId($displayId){

        return $this->findByDisplayId($displayId);
    }



    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Helper Methods">

    //:TODO schreibe eigenes hydratingResultSet, welches erst beim iterieren durch den cursor die abhängigkeiten aus der datenbank holt
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

    private function getColumns(\Base\Model\Entity\Infoscript $infoscript) {

        $cols = $this->getTgwColumns()->select(
                "infospalte.inserat_id = ". $infoscript->getInseratId()
        );

        foreach ($cols as $col) {
            $infoscript->addColumn($col);
        }

    }

    private function joinWithInseratTable(Select $select) {

        return $select->join(C::DB_TBL_INSERAT, sprintf('%s.%s=%s.%s', C::DB_TBL_INFOSCRIPT, C::DB_FK_INFOSCRIPT_INSERAT, C::DB_TBL_INSERAT ,C::DB_PK_INSERAT));
    }

    private function joinWithInseratDisplayLinkerTable(Select $select) {

        return $select->join(
                C::DB_TBL_INSERAT_BILDSCHIRM_LINKER,
                sprintf('%s.%s=%s.%s',
                        C::DB_TBL_INSERAT_BILDSCHIRM_LINKER,
                        C::DB_FK_INSERAT_BILDSCHIRM_LINKER_INSERAT,
                        C::DB_TBL_INSERAT, C::DB_PK_INSERAT));

        //'bildschirm_inserat_linker', 'inserat.inserat_id = bildschirm_inserat_linker.inserat_id'
    }

    private function saveInserat($infoscript) {

        $inseratId = $this->getTableInserat()->save($infoscript);
        $infoscript->setInseratId($inseratId);

        return $infoscript;
    }

    private function saveInfoscript($infoscript, $update = false) {

        if (!$update) {
            return $this->getTableInfoscript()->insert($infoscript);
        }

        return $this->getTableInfoscript()->update($infoscript);
        }

    private function saveBildschirme($infoscript) {

        foreach ($infoscript->getBildschirme() as $bildschirm) {

            $data = array(
                'inserat_id' => $infoscript->getInseratId(),
                'bildschirm_id' => $bildschirm->getId(),
            );

            $this->getTableInseratBildschirmLinker()->save($data);
        }
    }

    private function saveColums(\Base\Model\Entity\Infoscript $infoscript) {

        foreach ($infoscript->getColumns() as $column) {
            $this->saveColumn($column);
        }
        }

    private function saveColumn(\Base\Model\Entity\Infoscript\Column $column) {

        $hydrator = new \Base\Model\Hydrator\Infoscript\Column();

        if ($column->hasId()) {
            var_dump($column->hasId());
            $this->getTgwColumns()->update($hydrator->extract($column), ['infospalte.id' => $column->getId()]);
            return $column->getId();
        }

        $this->getTgwColumns()->insert($hydrator->extract($column));
        return $this->getTgwColumns()->getLastInsertValue();
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Table Getters & Setters">

    /**
     *
     * @return \Base\Model\Table\Inserat
     */
    public function getTableInserat() {
        return $this->tableInserat;
    }

    /**
     *
     * @param \Base\Model\Table\Inserat $tableInserat
     * @return \Base\Model\Mapper\Infoscript
     */
    public function setTableInserat(\Base\Model\Table\Inserat $tableInserat) {
        $this->tableInserat = $tableInserat;
        return $this;
    }



    /**
     *
     * @return \Base\Model\Table\InseratBildschirmLinker
     */
    public function getTableInseratBildschirmLinker() {
        return $this->tableInseratBildschirmLinker;
    }

    /**
     *
     * @param \Base\Model\Table\InseratBildschirmLinker $tableInseratBildschirmLinker
     * @return \Base\Model\Mapper\Infoscript
     */
    public function setTableInseratBildschirmLinker(\Base\Model\Table\InseratBildschirmLinker $tableInseratBildschirmLinker) {
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



    /**
     *
     * @return \Base\Model\Table\Infoscript
     */
    public function getTableInfoscript() {
        return $this->tableInfoscript;
    }

    /**
     *
     * @param \Base\Model\Table\Infoscript $tableInfoscript
     * @return \Base\Model\Mapper\Infoscript
     */
    public function setTableInfoscript(\Base\Model\Table\Infoscript $tableInfoscript) {
        $this->tableInfoscript = $tableInfoscript;
        return $this;
    }


    /**
     *
     * @return \Zend\Db\TableGateway\TableGatewayInterface
     */
    public function getTgwColumns() {
        return $this->tgwColumns;
    }

    /**
     *
     * @param \Zend\Db\TableGateway\TableGatewayInterface $tgwColumns
     * @return \Base\Model\Mapper\Infoscript
     */
    public function setTgwColumns(\Zend\Db\TableGateway\TableGatewayInterface $tgwColumns) {
        $this->tgwColumns = $tgwColumns;
        return $this;
    }


    // </editor-fold>

}