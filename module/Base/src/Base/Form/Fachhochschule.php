<?php

namespace Base\Form;

use Zend\Form;

class Fachhochschule extends User {

    /**
     * Name der Fachhochschul- Organisation (Stura, Club, ...)
     * @var \Zend\Form\Element\Text
     */
    protected $name;
    
    public function __construct() {
        
        parent::__construct('fachhochschule');
        
        $this->add($this->getUserId());
        $this->add($this->getUserName());
        $this->add($this->getFachhochschuleName());
        $this->add($this->getDisplayName());
        $this->add($this->getEmail());
        $this->add($this->getPassword());
        $this->add($this->getPasswordRepeat());
        $this->add($this->getState());
        $this->add($this->getSubmit());
        
        $this->setHydrator(new \Base\Form\Hydrator\Fachhochschule());
        $this->setObject(new \Base\Model\Entity\Fachhochschule());
    }
    
    public function getFachhochschuleName() {
        
        if(!$this->name){
            
            $name = new Form\Element\Text('name');
            $name->setLabel('Name der Organisation (z.B. Stura): ');
            
            $this->setFachhochschuleName($name);
        }
        
        return $this->name;
    }

    public function setFachhochschuleName($name) {
        
        $this->name = $name;
        return $this;
    }
    
    
    
}
