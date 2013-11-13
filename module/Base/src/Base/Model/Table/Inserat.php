<?php

namespace Base\Model\Table;

use Zend\Db\Sql\Select;

use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class Inserat implements HydratorAwareInterface {


    protected $tableGateway;

    protected $hydrator;



    public function save(\Base\Model\Entity\Inserat $inserat){

        return ($inserat->getInseratId() === null) ?
            $this->insert($inserat):
            $this->update($inserat);
    }


    public function insert(\Base\Model\Entity\Inserat $inserat){


        $data = $this->getHydrator()->extract($inserat);


        $this->getTableGateway()->insert($data);


        return $this->getTableGateway()->getLastInsertValue();
    }

    public function update(\Base\Model\Entity\Inserat $inserat){

        $data = $this->getHydrator()->extract($inserat);

        $this->getTableGateway()->update($data, array('inserat_id' => $inserat->getInseratId()));

        return $inserat->getInseratId();

    }

    public function delete($id){

        return $this->getTableGateway()->delete(array('inserat_id' => (int) $id));

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