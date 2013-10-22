<?php

namespace Base\Model\Entity;

class Infoscript {

    protected $id;
    protected $urlId;
    protected $userId;


    protected $url;



    public function __construct( $url) {

        $this->setUrl($url);
        $this->getUrl()->setDependency($this);
    }


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }


    public function getUrlId() {
        return $this->urlId;
    }

    public function setUrlId($urlId) {
        $this->urlId = $urlId;
        return $this;
    }

    
    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }

    

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }



}