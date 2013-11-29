<?php

namespace Base\Model\Entity;

class Bildschirm {
    
    /**
     * $id eindeutige Id des Bildschirms
     * @var int
     */
    private $id;
    
    /**
     * $beschreibung Beschreibung des Bildschirms
     * @var string
     */
    private $beschreibung;
    
    /**
     * $inserate enthält Referenzen zu Inseraten, die auf diesem Bildschirm
     * angezeigt werden.
     * @var array
     */
//    private $inserate = array();
    
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getBeschreibung() {
        return $this->beschreibung;
    }

    public function setBeschreibung($beschreibung) {
        $this->beschreibung = $beschreibung;
        return $this;
    }

//    public function getInserate() {
//        return $this->inserate;
//    }
//
//    public function setInserate(array $inserate) {
//        $this->inserate = $inserate;
//        return $this;
//    }

    public function __toString() {
        return $this->getBeschreibung();
    }
    
    
}
