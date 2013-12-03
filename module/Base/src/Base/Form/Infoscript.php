<?php

namespace Base\Form;

use Zend\Form;
//use Zend\Stdlib\Hydrator;

use Base\Constants as C;
use Base\Form\Hydrator;
use Base\Model\Entity;


class Infoscript extends Inserat {

    public function __construct() {

        parent::__construct('infoscript');

        $this->setHydrator(new Hydrator\Infoscript());
        $this->setObject(new Entity\Infoscript());

        $this->add($this->getInseratId());
        $this->add($this->getUserId());
        $this->add($this->getStart());
        $this->add($this->getEnde());
        $this->add($this->getUrl());
        $this->add($this->getAktiv());
//        $this->add($this->getBildschirme());

//        $this->add($this->getTitel());

        $this->add($this->getSubmit());

        $this->setAttribute('class', 'well form-horizontal');

        $this->setClassAttributes();
    }


}