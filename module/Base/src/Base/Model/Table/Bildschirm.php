<?php

namespace Base\Model\Table;

use Zend\Db\Sql\Select;

use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class Bildschirm implements HydratorAwareInterface {


    protected $tableGateway;

    protected $hydrator;


    public function fetchAll(){
        
        return $this->getTableGateway()->select();
        
    }

    public function save(\Base\Model\Entity\Bildschirm $bildschirm){

        return ($bildschirm->getId() === null) ?
            $this->insert($bildschirm):
            $this->update($bildschirm);
    }


    public function insert(\Base\Model\Entity\Bildschirm $bildschirm){


        $data = $this->getHydrator()->extract($bildschirm);


        $this->getTableGateway()->insert($data);


        return $this->getTableGateway()->getLastInsertValue();
    }

    public function update(\Base\Model\Entity\Bildschirm $bildschirm){

        $data = $this->getHydrator()->extract($bildschirm);

        $this->getTableGateway()->update($data, array('inserat_id' => $bildschirm->getInseratId()));

        return $bildschirm->getInseratId();

    }

    public function delete($id){

        return $this->getTableGateway()->delete(array('bildschirm_id' => (int) $id));

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