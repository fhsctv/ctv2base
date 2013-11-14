<?php

namespace Base\Model\Entity;

class Inserat {

    const STATUS_AKTIV       = 'aktiv';
    const STATUS_ABGELAUFEN  = 'abgelaufen';
    const STATUS_ZUKUNFT     = 'zukünftig';
    
    
    /**
     * inseratId eindeutige Id des Inserats
     * @var int
     */
    private $inseratId;

    /**
     * $start Startdatum des Inserats. Gibt an, ab wann ein Inserat angezeigt 
     * wird.
     * @var string
     */
    private $start;

    /**
     * $ende Enddatum des Inserats. Gibt das Datum des letzten Tags an, an dem 
     * ein Inserat noch angezeigt wird.
     * @var string
     */
    private $ende;

    /**
     * $url Url- Adresse des Inhalts eines Inserats
     * @var string
     */
    private $url;

    /**
     * $aktiv Gibt an, ob ein Inserat von einem berechtigten Nutzer 
     * freigeschaltet wurde.
     * @var boolean
     */
    private $aktiv;

    /**
     * $bildschirme enthält Bildschirm- Ids, der Bildschirme auf denen
     * ein Inserat angezeigt wird.
     * @var array 
     */
    private $bildschirme = array();
    
    /**
     * $userId ist die Id des Benutzers, zu dem ein Inserat gehört
     * @var int
     */
    private $userId;

    public function getInseratId() {
        
        return $this->inseratId;
    }

    public function setInseratId($inseratId) {
        
        $this->inseratId = $inseratId;
        return $this;
    }

    
    public function getStart() {
        
        return $this->start;
    }

    public function setStart($start) {
        
        $this->start = $start;
        return $this;
    }

    
    public function getEnde() {
        
        return $this->ende;
    }

    public function setEnde($ende) {

        $this->ende = $ende;
        return $this;
    }

    
    public function getUrl() {

        return $this->url;
    }

    public function setUrl($url) {

        $this->url = $url;
        return $this;
    }

    
    public function getAktiv() {

        return $this->aktiv;
    }

    public function setAktiv($aktiv) {

        $this->aktiv = $aktiv;
        return $this;
    }

    
    public function getBildschirme() {

        return $this->bildschirme;
    }

    public function setBildschirme(array $bildschirme) {

        $this->bildschirme = $bildschirme;
        return $this;
    }

    public function addBildschirm($bildschirm) {

        array_push($this->bildschirme, $bildschirm);
        return $this;
    }
    
    
    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }

    
    public function isAngezeigt(){
        
        $today = date('Y-m-d');
        
        return($this->getAktiv() && ($this->getStart() <= $today) && $this->getEnde() >= $today );
        
    }

    public function getStatus(){
        
        $today = date('Y-m-d');
        
        if($this->getEnde() < $today){
            return self::STATUS_ABGELAUFEN;
        }
        
        if($this->getStart() > $today){
            return self::STATUS_ZUKUNFT;
        }
        
        if($this->getAktiv() && $this->getStart()<= $today && $this->getEnde() >= $today){
            return self::STATUS_AKTIV;
        }
        
    }
}
