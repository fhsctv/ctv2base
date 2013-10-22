<?php

namespace Base\Form;

use Zend\Form;
//use Zend\Stdlib\Hydrator;

use Base\Constants as C;
use Base\Form\Fieldset\Url as UrlFieldset;
use Base\Form\Hydrator;
use Base\Model\Entity;


class Infoscript extends Form\Form {

    const LABEL_ID      = 'Id: ';
    const LABEL_URL_ID  = 'UrlId: ';
    const LABEL_USER_ID = 'BenutzerId: ';

    protected $id;
    protected $urlId;
    protected $userId;

    protected $submit;

    protected $url;

    public function __construct() {

        parent::__construct('infoscript');

//        $this->setHydrator(new Hydrator\ClassMethods());
        $this->setHydrator(new Hydrator\Infoscript());
        
        $this->setObject(new Entity\Infoscript());

        $this->add($this->getId());
        $this->add($this->getUrlId());
        $this->add($this->getUserId());
        $this->add($this->getUrl());

        $this->add($this->getSubmit());
        
        $this->setAttribute('class', 'well form-inline');
        
        
    }

//    public function getData($flag = null) {
//        $obj = parent::getData($flag);
//        $obj->getUrl()->setDependency($obj);
//        
//        return $obj;
//    }
    
    
    public function getId() {

        if(empty($this->id)){

            $id = new Form\Element\Hidden(C::INFO_ID);
//            $id->setLabelAttributes(array('class' => 'control-label'));
//            $id->setAttribute('class', 'input-xlarge');
//            $id->setLabel(self::LABEL_ID);

            $this->setId($id);
        }

        return $this->id;
    }

    public function setId(Form\ElementInterface $id) {
        $this->id = $id;
        return $this;
    }


    public function getUrlId() {

        if(empty($this->urlId)){

            $urlId = new Form\Element\Hidden(C::INFO_URL_ID);
//            $urlId->setLabelAttributes(array('class' => 'control-label'));
//            $urlId->setLabel(self::LABEL_URL_ID);
//            $urlId->setAttribute('class', 'input-xlarge');

            $this->setUrlId($urlId);
        }

        return $this->urlId;
    }

    public function setUrlId($urlId) {
        $this->urlId = $urlId;
        return $this;
    }

    
    public function getUserId() {
        
        if(empty($this->userId)){

            $userId = new Form\Element\Text(C::INFO_USER_ID);
            
            //TODO aus Datenbank holen, Tabelle FH
//            $userId->setValueOptions(array(1 => 'Administrator'));
            
            $userId->setLabel(self::LABEL_USER_ID);
            $userId->setLabelAttributes(array('class' => 'control-label'));
            $userId->setAttribute('class', 'input-xlarge');

            $this->setUserId($userId);
        }
        
        return $this->userId;
        
    }

    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }

        

    public function getSubmit() {

        if(empty($this->submit)){

            $submit = new Form\Element\Submit('submit');
            $submit->setValue('senden');

            $this->setSubmit($submit);
        }

        return $this->submit;
    }

    public function setSubmit($submit) {
        $this->submit = $submit;
        return $this;
    }



    public function getUrl() {

        if(empty($this->url)){

            $url = new UrlFieldset();

            $this->setUrl($url);
        }

        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }
    
    
}