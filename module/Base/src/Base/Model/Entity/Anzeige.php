<?php

namespace Base\Model\Entity;

class Anzeige extends AUrl {

    protected $id;
    protected $urlId;
    protected $userId;






    public function __construct(Url $url = null) {

        parent::__construct($url);

    }


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        
        if(!is_numeric($id)){
            
            throw new \InvalidArgumentException("Die Id muss Integer oder ein numerischer String sein");
        }
        
        
        $this->id = (int) $id;
        return $this;
    }


    public function getUrlId() {
        return $this->urlId;
    }

    public function setUrlId($urlId) {
        
        if(!is_numeric($urlId)){
            
            throw new \InvalidArgumentException("Die urlId muss Integer oder ein numerischer String sein");
        }
        
        $this->urlId = (int) $urlId;
        
        $this->getUrl()->setId($urlId); //teile neue Id der Url- Abhängigkeit mit
        
        return $this;
    }

    
    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        
        if(!is_numeric($userId)){
            
            throw new \InvalidArgumentException("Die userId muss Integer oder ein numerischer String sein");
        }
        
        $this->userId = (int) $userId;
        return $this;
    }

}