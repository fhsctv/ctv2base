<?php

namespace Base\Model\Entity;

class Inserat {

    const ACTIVE   = '1';
    const INACTIVE = '0';
    
    const STATUS_AKTIV                = 'aktiv';
    const STATUS_ABGELAUFEN           = 'abgelaufen';
    const STATUS_ZUKUNFT              = 'zukünftig';
    const STATUS_KEIN_BILDSCHIRM      = 'kein Bildschirm ausgewählt';
    const STATUS_NICHT_FREIGESCHALTET = 'nicht freigeschaltet';
    
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
        
        assert(is_numeric($inseratId), __METHOD__ . ": Id muss eine Zahl sein.");
        
        $this->inseratId = (int) $inseratId;
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

        assert(is_numeric($aktiv));
        assert(in_array($aktiv, [self::INACTIVE, self::ACTIVE]), "Nur die Werte '0' und '1' akzeptiert, ist aber $aktiv ");
        
        $this->aktiv = (int) $aktiv;
        return $this;
    }

    
    public function getBildschirme() {

        return $this->bildschirme;
    }

    public function setBildschirme(array $bildschirme) {

        foreach ($bildschirme as $bildschirm) {
            $this->addBildschirm($bildschirm);
        }
        
        return $this;
    }

    public function addBildschirm(Bildschirm $bildschirm) {

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
        
        return($this->getAktiv() && ($this->getStart() <= $today) && $this->getEnde() >= $today && $this->getBildschirme());
        
    }

    public function getStatus(){
        
        $today = date('Y-m-d');
        
        if(!$this->getAktiv()){
            return self::STATUS_NICHT_FREIGESCHALTET;
        }
        
        if($this->getEnde() < $today){
            return self::STATUS_ABGELAUFEN;
        }
        
        if($this->getStart() > $today){
            return self::STATUS_ZUKUNFT;
        }
        
        if(!$this->getBildschirme()) {
            return self::STATUS_KEIN_BILDSCHIRM;
        }
        
        if($this->getAktiv() && $this->getStart()<= $today && $this->getEnde() >= $today){
            return self::STATUS_AKTIV;
        }
        
    }
}
