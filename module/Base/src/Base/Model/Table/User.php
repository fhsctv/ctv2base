<?php

namespace Base\Model\Table;

use Zend\Db\Sql\Select;

use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class User implements HydratorAwareInterface {

    /**
     *
     * @var \Zend\Db\TableGateway\TableGatewayInterface
     */
    protected $tableGateway;

    /**
     *
     * @var \Zend\Stdlib\Hydrator\HydratorInterface
     */
    protected $hydrator;


    /**
     * @deprecated use findAll instead
     * @return \Zend\Db\ResultSet\ResultSetInterface
     */
    public function fetchAll() {

        return $this->findAll();
    }

    /**
     * @deprecated use findAll instead
     * @return \Zend\Db\ResultSet\ResultSetInterface
     */
    public function findAll() {

        return $this->getTableGateway()->select();
    }


    /**
     * @deprecated use findById instead
     * @param int $id
     * @return \Base\Model\Entity\User
     */
    public function getById($id) {

        return $this->findById($id);
    }

    /**
     *
     * @param int $id
     * @return \Base\Model\Entity\User
     */
    public function findById($id) {

        $id = (int) $id;

        $resultSet = $this->getTableGateway()->select(

                function (Select $select) use ($id) {

                    return $select->where("ctv.user.user_id = $id");
                }
        );

        $user = $resultSet->current();
        if(!$user) {
            throw new \Exception("User with id $id not found!");
        }

        return $user;
    }


    /**
     *
     * @param \Base\Model\Entity\User $user
     * @return int user_id of the saved Entity
     */
    public function save(\Base\Model\Entity\User $user){

        return ($user->getUserId() === null) ?
            $this->insert($user):
            $this->update($user);
    }

    /**
     *
     * @param \Base\Model\Entity\User $user
     * @return int
     */
    public function insert(\Base\Model\Entity\User $user){

        $data = $this->getHydrator()->extract($user);
        $this->getTableGateway()->insert($data);

        return $this->getTableGateway()->getLastInsertValue();
    }

    /**
     *
     * @param \Base\Model\Entity\User $user
     * @return int
     */
    public function update(\Base\Model\Entity\User $user){

        $data = $this->getHydrator()->extract($user);
        $this->getTableGateway()->update($data, ['user_id' => $user->getUserId()]);

        return $user->getUserId();
    }


    /**
     *
     * @param int $id
     * @return int affected Rows
     */
    public function delete($id){

        return $this->getTableGateway()->delete(['user_id' => (int) $id]);

    }


    // <editor-fold defaultstate="collapsed" desc="getters and setters">

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
     * @return \Base\Model\Table\User
     */
    public function setTableGateway(\Zend\Db\TableGateway\TableGatewayInterface $tableGateway) {
        $this->tableGateway = $tableGateway;
        return $this;
    }

    /**
     *
     * @return \Zend\Stdlib\Hydrator\HydratorInterface
     */
    public function getHydrator() {

        return $this->hydrator;
    }

    /**
     *
     * @param \Zend\Stdlib\Hydrator\HydratorInterface $hydrator
     * @return \Base\Model\Table\User
     */
    public function setHydrator(HydratorInterface $hydrator) {

        $this->hydrator = $hydrator;
        return $this;
    }

    // </editor-fold>
}