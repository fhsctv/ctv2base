<?php

namespace Base\Model\Entity;

class Url {

    protected $adresse;
    protected $start;
    protected $ende;
    protected $aktiv;

    protected $dependency;

    
    public function getAdresse() {
        return $this->adresse;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
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

    
    public function getAktiv() {
        return $this->aktiv;
    }

    public function setAktiv($aktiv) {
        $this->aktiv = $aktiv;
        return $this;
    }

    
    
    
    public function getDependency() {
        return $this->dependency;
    }

    public function setDependency(AUrl $dependency) {
        $this->dependency = $dependency;
        return $this;
    }


}