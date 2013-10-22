<?php

namespace Base\Model\Entity;

/**
 * Abstrakte Klasse, von der alle Entitäten erben, die eine Url besitzen.
 */
abstract class AUrl {
    
    protected $url;
    
    public function __construct(Url $url = null) {
        if(!is_null($url)){
            $this->setUrl($url);
        }
    }
    
    public function getUrl() {
        
        if(empty($this->url)){
            $this->setUrl(new Url());
        }
        
        return $this->url;
    }

    public function setUrl(Url $url) {
        
        $this->url = $url;
//        $this->getUrl()->setDependency($this);
        
        return $this;
    }
    
}