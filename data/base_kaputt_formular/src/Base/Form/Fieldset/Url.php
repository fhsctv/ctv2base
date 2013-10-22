<?php

namespace Base\Form\Fieldset;

use Zend\Form;

use Base\Constants as C;
use Base\Form\Hydrator\Url as UrlHydrator;

class Url extends Form\Fieldset {
    
    const LABEL_ADRESS = 'Url: ';
    const LABEL_START  = 'Startdatum: ';
    const LABEL_ENDE   = 'Enddatum: ';
    const LABEL_AKTIV  = 'Aktiv: ';
    
    protected $adress;
    protected $start;
    protected $ende;
    protected $aktiv;


    public function __construct() {
        parent::__construct(C::URL_FORM_ID);
        
        $this->setHydrator($hydrator);
        
        $this->add($this->getAdress());
        $this->add($this->getStart());
        $this->add($this->getEnde());
        $this->add($this->getAktiv());
    }
    
    
    
    public function getAdress() {
        
        if(empty($this->adress)){
            
            $adress = new Form\Element\Text(C::URL_ADRESS);
            $adress->setLabel(self::LABEL_ADRESS);
            $adress->setLabelAttributes(array('class' => 'control-label'));
            $adress->setAttribute('class', 'input-xlarge');
            
            $this->setAdress($adress);
        }
        
        return $this->adress;
    }

    public function setAdress($adress) {
        $this->adress = $adress;
        return $this;
    }

    
    public function getStart() {
        
        if(empty($this->start)){
            
            $start = new Form\Element\Date(C::URL_START);
            $start->setLabel(self::LABEL_START);
            $start->setLabelAttributes(array('class' => 'control-label'));
            $start->setAttribute('class', 'input-xlarge');
            
            $this->setStart($start);
        }
        
        return $this->start;
    }

    public function setStart($start) {
        $this->start = $start;
        return $this;
    }

    
    public function getEnde() {
        
        if(empty($this->ende)){
            
            $ende = new Form\Element\Date(C::URL_ENDE);
            $ende->setLabel(self::LABEL_ENDE);
            $ende->setLabelAttributes(array('class' => 'control-label'));
            $ende->setAttribute('class', 'input-xlarge');
            
            $this->setEnde($ende);
        }
        
        return $this->ende;
    }

    public function setEnde($ende) {
        $this->ende = $ende;
        return $this;
    }
    
    
    public function getAktiv() {
        
        if(empty($this->aktiv)){
            
            $aktiv = new Form\Element\Text(C::URL_AKTIV);
            $aktiv->setLabel(self::LABEL_AKTIV);
            $aktiv->setLabelAttributes(array('class' => 'control-label'));
            $aktiv->setAttribute('class', 'input-xlarge');
            
            $this->setAktiv($aktiv);
        }
        
        return $this->aktiv;
        
    }

    public function setAktiv($aktiv) {
        $this->aktiv = $aktiv;
        return $this;
    }


    
}