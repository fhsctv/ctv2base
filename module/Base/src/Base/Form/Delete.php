<?php

namespace Base\Form;


use Zend\Form;

class Delete extends Form\Form {

    protected $id;
    protected $yes;
    protected $no;




    public function __construct($name = null) {

        parent::__construct('delete');

        $this->setAttribute('method', 'post');

        $this->add($this->getId());
        $this->add($this->getYes());
        $this->add($this->getNo());

    }

    
    public function getId() {
        
        if(empty($this->id)){
            
            $id = new Form\Element\Hidden('id');
            $this->setId($id);
        }
        
        return $this->id;
    }

    public function setId($id) {
        
        $this->id = $id;
        return $this;
    }

        
    
    public function getYes() {
        
        if(empty($this->yes)){
            
            $yes = new Form\Element\Submit('delete');
            $yes->setAttribute('class', 'btn btn-default btn-lg');
            $yes->setValue('Ja');
            
            $this->setYes($yes);
            
        }
        
        return $this->yes;
    }

    public function setYes($yes) {
        $this->yes = $yes;
        return $this;
    }

    
    public function getNo() {
        
        if(empty($this->no)){
            
            $no = new Form\Element\Submit('delete');
            $no->setAttribute('class', 'btn btn-default btn-lg');
            $no->setValue('Nein');
            
            $this->setNo($no);
            
        }
        
        return $this->no;
    }

    public function setNo($no) {
        $this->no = $no;
        return $this;
    }
    
}

