<?php

namespace Base\Form;

use Zend\Form;
//use Zend\Stdlib\Hydrator;

use Base\Constants as C;
use Base\Form\Hydrator;
use Base\Model\Entity;


class Inserat extends Form\Form {

    const LABEL_ID      = 'Id: ';
    const LABEL_URL_ID  = 'UrlId: ';
    const LABEL_URL     = 'Url: ';
    const LABEL_START   = 'Startdatum: ';
    const LABEL_ENDE    = 'Enddatum: ';
    const LABEL_AKTIV   = 'Aktiv: ';
    const LABEL_USER_ID = 'BenutzerId: ';



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

    protected $submit;



    public function __construct($name = null) {

        parent::__construct($name);

        $this->add($this->getInseratId());
        $this->add($this->getUserId());
        $this->add($this->getStart());
        $this->add($this->getEnde());
        $this->add($this->getUrl());
        $this->add($this->getAktiv());
        $this->add($this->getBildschirme());

        $this->add($this->getSubmit());

        $this->setAttribute('class', 'well form-inline');

    }

//    public function getData($flag = null) {
//        $obj = parent::getData($flag);
//        $obj->getUrl()->setDependency($obj);
//
//        return $obj;
//    }

    public function getInseratId() {

        if(!$this->inseratId){

            $id = new Form\Element\Text('inserat_id');
            $id->setLabelAttributes(array('class' => 'control-label'));
            $id->setAttribute('class', 'input-xlarge');
            $id->setLabel(self::LABEL_ID);

            $this->setInseratId($id);
        }

        return $this->inseratId;
    }

    public function setInseratId(Form\ElementInterface $id) {
        $this->inseratId = $id;
        return $this;
    }

    public function getStart() {

        if(empty($this->start)){

            $start = new Form\Element\Date('start');
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

            $ende = new Form\Element\Date('ende');
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



    public function getUrl() {

        if(!$this->url){

            $url = new Form\Element\Url('url');
            $url->setLabel(self::LABEL_URL);
            $url->setLabelAttributes(array('class' => 'control-label'));
            $url->setAttribute('class', 'input-xlarge');

            $this->setUrl($url);
        }

        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }




    public function getAktiv() {

        if(!$this->aktiv){

            $aktiv = new Form\Element\Text('aktiv');
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





    public function getUserId() {

        if(!$this->userId){

            $userId = new Form\Element\Text('user_id');

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


    public function getBildschirme() {
        
        if(!$this->bildschirme){
            
            $bildschirme = new Form\Element\Select('bildschirme');
        
            $bildschirme->setLabel('Bildschirme: ');
            $bildschirme->setLabelAttributes(array('class' => 'control-label'));
            $bildschirme->setAttribute('class', 'input-xlarge');
            $bildschirme->setAttribute('multiple', true);
            $bildschirme->setValueOptions(array(1 => 'Hoersaal', 2 => 'Mensa', 3 => 'Büro', 4 => 'F-Gebäude'));
            
            $this->setBildschirme($bildschirme);
        }
        
        return $this->bildschirme;
        
    }

    public function setBildschirme($bildschirme) {
        $this->bildschirme = $bildschirme;
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




}