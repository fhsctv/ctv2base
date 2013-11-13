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
        
    }
    
    
}