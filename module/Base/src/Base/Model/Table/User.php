<?php

namespace Base\Model\Table;

use Zend\Db\Sql\Select;

use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class User implements HydratorAwareInterface {


    protected $tableGateway;

    protected $hydrator;


    public function fetchAll() {
        
        return $this->getTableGateway()->select();
        
    }
    
    public function getById($id) {
        
        $id = (int) $id;
        
        $resultSet = $this->getTableGateway()->select(
        
                function (Select $select) use ($id) {
                    
                    return $select->where("ctv.user.user_id = $id");
                }
        );

        $result = $resultSet->current();
        
        if(!$result) {
            throw new \Exception("User with id $id not found!");
        }
        
        return $result;
    }

    public function save(\Base\Model\Entity\User $user){

        return ($user->getUserId() === null) ?
            $this->insert($user):
            $this->update($user);
    }


    public function insert(\Base\Model\Entity\User $user){


        $data = $this->getHydrator()->extract($user);


        $this->getTableGateway()->insert($data);


        return $this->getTableGateway()->getLastInsertValue();
    }

    public function update(\Base\Model\Entity\User $user){

        $data = $this->getHydrator()->extract($user);

        $this->getTableGateway()->update($data, array('user_id' => $user->getUserId()));

        return $user->getUserId();

    }

    public function delete($id){

        return $this->getTableGateway()->delete(array('user_id' => (int) $id));

    }






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