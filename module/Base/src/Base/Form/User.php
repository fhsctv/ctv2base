<?php


namespace Base\Form;

use Zend\Form;

class User extends Form\Form {

    /**
     * Versteckte Id des Benutzers.
     * @var \Zend\Form\Element\Hidden
     */
    protected $userId;

    /**
     * Eindeutiger Benutzername
     * @var Zend\Form\Element\Text
     */
    protected $userName;

    /**
     * Eindeutige Emailadresse des Benutzers
     * @var Zend\Form\Element\Email
     */
    protected $email;

    /**
     * Name, der auf der Webseite angezeigt wird.
     * @var Zend\Form\Element\Text
     */
    protected $displayName;

    /**
     * Passwort des Benutzers
     * @var \Zend\Form\Element\Password
     */
    protected $password;

    /**
     * Passwortwiederholung zur Absicherung gegen Tippfehler
     * @var \Zend\Form\Element\Password
     */
    protected $passwordRepeat;

    /**
     * Status des Benutzerkontos:
     * 1 : aktiv
     * alles andere: inaktiv
     * standard: 0
     * @var \Zend\Form\Element\Hidden
     */
    protected $state;

    /**
     * Button zum Absenden des Formulars
     * @var \Zend\Form\Element\Submit
     */
    protected $submit;


    public function __construct($name = 'user') {

        parent::__construct($name);

        $this->setAttribute('class', 'form-horizontal');
        $this->setInputFilter((new Filter\User)->getInputfilter());

    }

    //:TODO eine abstrakte form klasse erstellen und methode eine ebene höher versetzen oder Trait
    protected function setClassAttributes() {

        foreach ($this->getElements() as $element) {

            if($element instanceof Form\Element\Hidden || $element instanceof Form\Element\Submit){
                continue;
            }

            $element->setAttribute('class', 'form-control');
            $element->setLabelAttributes(['class' => 'control-label']);
        }

        return $this;
    }

    public function getUserId() {

        if(!$this->userId){

            $userId = new \Zend\Form\Element\Hidden('user_id');
//            $userId->setLabel('Benutzer- Id: ');

            $this->setUserId($userId);
        }

        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }


    public function getUserName() {

        if(!$this->userName){

            $userName = new \Zend\Form\Element\Text('username');
            $userName->setLabel('Benutzername: ');

            $this->setUserName($userName);
        }

        return $this->userName;
    }

    public function setUserName($userName) {
        $this->userName = $userName;
        return $this;
    }


    public function getEmail() {

        if(!$this->email){

            $email = new \Zend\Form\Element\Email('email');
            $email->setLabel('Email: ');

            $this->setEmail($email);
        }

        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }


    public function getDisplayName() {

        if(!$this->displayName){

            $displayName = new \Zend\Form\Element\Text('display_name');
            $displayName->setLabel('Anzeigename: ');

            $this->setDisplayName($displayName);
        }

        return $this->displayName;
    }

    public function setDisplayName($displayName) {
        $this->displayName = $displayName;
        return $this;
    }


    public function getPassword() {

        if(!$this->password){

            $password = new \Zend\Form\Element\Password('password');
            $password->setLabel('Passwort: ');

            $this->setPassword($password);
        }

        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }


    public function getPasswordRepeat() {

        if(!$this->passwordRepeat){

            $passwordRepeat = new \Zend\Form\Element\Password('passwordRepeat');
            $passwordRepeat->setLabel('Passwortwiederholung: ');

            $this->setPasswordRepeat($passwordRepeat);
        }

        return $this->passwordRepeat;
    }

    public function setPasswordRepeat($passwordRepeat) {
        $this->passwordRepeat = $passwordRepeat;
        return $this;
    }


    public function getState() {

        if(!$this->state){

            $state = new \Zend\Form\Element\Hidden('state');
//            $state->setLabel('Status: ');
            $state->setValue(0);

            $this->setState($state);
        }

        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
        return $this;
    }


    public function getSubmit() {

        if(!$this->submit){

            $submit = new \Zend\Form\Element\Submit('submit');
            $submit->setValue('Registrieren');

            $this->setSubmit($submit);
        }

        return $this->submit;
    }

    public function setSubmit($submit) {
        $this->submit = $submit;
        return $this;
    }

}
