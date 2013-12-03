<?php

namespace Base\Model\Table;

use Zend\Db\Sql\Select;

use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class Fachhochschule implements HydratorAwareInterface {


    protected $tableGateway;

    protected $hydrator;

    /**
     *
     * @return \Zend\Db\ResultSet\ResultSetInterface
     */
    public function fetchAll(){

        return $this->getTableGateway()->select();

    }

    /**
     * @deprecated use findById instead
     * @param int $id
     * @return \Base\Model\Entity\Fachhochschule
     */
    public function getById($id) {

        return $this->findById($id);
    }

    /**
     *
     * @param int $id
     * @return \Base\Model\Entity\Fachhochschule
     * @throws Exception\NotFound
     */
    public function findById($id) {

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

    /**
     *
     * @param \Base\Model\Entity\Fachhochschule $fachhochschule
     * @return int inserat_id of the new Entity
     */
    public function insert(\Base\Model\Entity\Fachhochschule $fachhochschule){

        $data = $this->getHydrator()->extract($fachhochschule);

        $this->getTableGateway()->insert($data);

        return $this->getTableGateway()->getLastInsertValue();
    }

    /**
     *
     * @param \Base\Model\Entity\Fachhochschule $fachhochschule
     * @return int inserat_id of the updated entity
     */
    public function update(\Base\Model\Entity\Fachhochschule $fachhochschule){

        $data = $this->getHydrator()->extract($fachhochschule);

        $this->getTableGateway()->update($data, ['inserat_id' => $fachhochschule->getInseratId()]);

        return $fachhochschule->getInseratId();

    }

    public function delete($id){

        return $this->getTableGateway()->delete(['user_id' => (int) $id]);
    }








    /**
     *
     * @return \Zend\Db\TableGateway\TableGatewayInterface
     */
    public function getTableGateway() {
        return $this->tableGateway;
    }

    /**
     *
     * @param \Zend\Db\TableGateway\TableGatewayInterface $tableGateway
     * @return \Base\Model\Table\Fachhochschule
     */
    public function setTableGateway(\Zend\Db\TableGateway\TableGatewayInterface $tableGateway) {
        $this->tableGateway = $tableGateway;
        return $this;
    }

    /**
     *
     * @return Zend\Stdlib\Hydrator\HydratorInterface
     */
    public function getHydrator() {

        return $this->hydrator;
    }

    /**
     *
     * @param \Zend\Stdlib\Hydrator\HydratorInterface $hydrator
     * @return \Base\Model\Table\Fachhochschule
     */
    public function setHydrator(HydratorInterface $hydrator) {

        $this->hydrator = $hydrator;
        return $this;
    }

}