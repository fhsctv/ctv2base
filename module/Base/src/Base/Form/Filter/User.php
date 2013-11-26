<?php

namespace Base\Form\Filter;

use Zend\InputFilter\InputInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class User implements InputFilterAwareInterface {

    protected $inputfilter;
    protected $inputFactory;

    protected $dbAdapter;


    /**
     * Versteckte Id des Benutzers.
     * @var \Zend\InputFilter\InputInterface
     */
    protected $userId;

    /**
     * Eindeutiger Benutzername
     * @var \Zend\InputFilter\InputInterface
     */
    protected $userName;

    /**
     * Eindeutige Emailadresse des Benutzers
     * @var \Zend\InputFilter\InputInterface
     */
    protected $email;

    /**
     * Name, der auf der Webseite angezeigt wird.
     * @var \Zend\InputFilter\InputInterface
     */
    protected $displayName;

    /**
     * Passwort des Benutzers
     * @var \Zend\InputFilter\InputInterface
     */
    protected $password;

    /**
     * Passwortwiederholung zur Absicherung gegen Tippfehler
     * @var \Zend\InputFilter\InputInterface
     */
    protected $passwordRepeat;

    /**
     * Status des Benutzerkontos:
     * 1 : aktiv
     * alles andere: inaktiv
     * standard: 0
     * @var \Zend\InputFilter\InputInterface
     */
    protected $state;

    /**
     * 
     * @return \Zend\InputFilter\InputInterface
     */
    public function getUserId() {

        if(!$this->userId){

            $userId = $this->getInputFactory()->createInput([
                'name'     => 'user_id',
                'required' => false,
            ]);

            $this->setUserId($userId);
        }

        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }

    
    /**
     * 
     * @return \Zend\InputFilter\InputInterface
     */
    public function getUserName() {

        if(!$this->userName){

            $userName = $this->getInputFactory()->createInput([
                'name'     => 'username',
                'required' => true,
                'filters'  => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 4,
                            'max'      => 50,
                        ],
                    ],
//                    [
//                        'name'    => 'Db/NoRecordExists',
//                        'options' =>
//                        [
//                            'adapter' => 'Zend\Db\Adapter\Adapter',
//                            'table' => 'user',
//                            'field' => 'username',
//                            
//                            
//                        ],
//                    ],
                ]
            ]);

            $this->setUserName($userName);
        }

        return $this->userName;
    }

    public function setUserName(InputInterface $userName) {
        $this->userName = $userName;
        return $this;
    }

    
    /**
     * 
     * @return \Zend\InputFilter\InputInterface
     */
    public function getEmail() {

        if(!$this->email){

            $email = $this->getInputFactory()->createInput(
            [
                'name'     => 'email',
                'required' => true,
                'filters'  => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' =>
                [
                    [
                        'name'    => 'StringLength',
                        'options' =>
                        [
                            'encoding' => 'UTF-8',
                            'min'      => 4,
                            'max'      => 50,
                        ],
                    ],
                    [
                        'name'    => 'EmailAddress',
                        'options' =>
                        [
                            'encoding' => 'UTF-8',
                            'min'      => 6,
                            'max'      => 50,
                            'messages' => [\Zend\Validator\EmailAddress::INVALID => 'Die Email- Adresse ist ungültig!'],
                        ],
                    ],
//                    [
//                        'name'    => 'Db/NoRecordExists',
//                        'options' =>
//                        [
//                            'adapter' => 'Zend\Db\Adapter\Adapter',
//                            'table' => 'user',
//                            'field' => 'email',
//                            
//                            
//                        ],
//                    ],
                ]
            ]);

            $this->setEmail($email);
        }

        return $this->email;
    }

    /**
     * 
     * @param \Zend\InputFilter\InputInterface $email
     * @return \Base\Form\Filter\User
     */
    public function setEmail(InputInterface $email) {
        $this->email = $email;
        return $this;
    }

    
    /**
     * 
     * @return \Zend\InputFilter\InputInterface
     */
    public function getDisplayName() {
        
        if(!$this->displayName){

            $displayName = $this->getInputFactory()->createInput([
                'name'     => 'display_name',
                'required' => true,
                'filters'  => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 4,
                            'max'      => 50,
                        ],
                    ],
                ]
            ]);

            $this->setDisplayName($displayName);
        }
        
        return $this->displayName;
    }

    /**
     * 
     * @param \Zend\InputFilter\InputInterface $displayName
     * @return \Base\Form\Filter\User
     */
    public function setDisplayName(InputInterface $displayName) {
        $this->displayName = $displayName;
        return $this;
    }

        
    /**
     * 
     * @return \Zend\InputFilter\InputInterface
     */
    public function getPassword() {

        if(!$this->password){

            $password = $this->getInputFactory()->createInput(
            [
                'name'        => 'password',
                'required'    => true,
                'filters'     =>
                [
                    ['name' => 'StringTrim'],
                ],
                'validators'  =>
                [
                    [
                        'name'    => 'StringLength',
                        'options' =>
                        [
                            'encoding' => 'UTF-8',
                            'min'      => 6,
                            'max'      => 50,
                        ],
                    ],
                ],
            ]);

            $this->setPassword($password);

        }

        return $this->password;
    }

    /**
     * 
     * @param \Zend\InputFilter\InputInterface $password
     * @return \Base\Form\Filter\User
     */
    public function setPassword(InputInterface $password) {
        $this->password = $password;
        return $this;
    }

    
    /**
     * 
     * @return \Zend\InputFilter\InputInterface
     */
    public function getPasswordRepeat() {

        if(!$this->passwordRepeat){

            $password = $this->getInputFactory()->createInput(
            [
                'name'        => 'passwordRepeat',
                'required'    => true,
                'filters'     =>
                [
                    ['name' => 'StringTrim'],
                ],
                'validators'  =>
                [
                    [
                        'name'    => 'identical',
                        'options' =>
                        [
                            'token'    => 'password',
                            'messages' => [\Zend\Validator\Identical::NOT_SAME => 'Die Passwörter stimmen nicht überein!']
                        ],
                    ],
                ],
            ]);

            $this->setPasswordRepeat($password);

        }

        return $this->passwordRepeat;
    }

    /**
     * 
     * @param \Zend\InputFilter\InputInterface $passwordRepeat
     * @return \Base\Form\Filter\User
     */
    public function setPasswordRepeat(InputInterface $passwordRepeat) {
        $this->passwordRepeat = $passwordRepeat;
        return $this;
    }

    
    /**
     * 
     * @return \Zend\InputFilter\InputInterface
     */
    public function getState() {

        if(!$this->state){

            $state = $this->getInputFactory()->createInput(
            [
                'name'        => 'state',
                'required'    => true,
                'filters'     =>
                [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators'  =>
                [
                    [
                        'name'    => 'StringLength',
                        'options' =>
                        [
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 1,
                        ],
                    ],
                    [
                        'name'    => 'InArray',
                        'options' =>
                        [
                            'strict'   => true,
                            'haystack' => ['0', '1', 0, 1],
                        ],
                    ],
                ],
            ]);

            $this->setState($state);

        }

        return $this->state;
    }

    /**
     * 
     * @param \Zend\InputFilter\InputInterface $state
     * @return \Base\Form\Filter\User
     */
    public function setState(InputInterface $state) {
        $this->state = $state;
        return $this;
    }


    /**
     * 
     * @return InputFilterInterface
     */
    public function getInputfilter() {

        if(!$this->inputfilter) {

            $inputFilter = new InputFilter();
            $inputFilter->add($this->getUserId());
            $inputFilter->add($this->getUserName());
            $inputFilter->add($this->getEmail());
            $inputFilter->add($this->getPassword());
            $inputFilter->add($this->getPasswordRepeat());
            $inputFilter->add($this->getState());

            $this->setInputfilter($inputFilter);
        }

        return $this->inputfilter;
    }

    /**
     * 
     * @param \Zend\InputFilter\InputFilterInterface $inputfilter
     * @return \Base\Form\Filter\User
     */
    public function setInputfilter(InputFilterInterface $inputfilter) {
        $this->inputfilter = $inputfilter;
        return $this;
    }

    
    /**
     *
     * @return InputFactory
     */
    public function getInputFactory() {

        if(!$this->inputfilter) {
            $this->setInputFactory(new InputFactory());
        }

        return $this->inputFactory;
    }

    public function setInputFactory($inputFactory) {
        $this->inputFactory = $inputFactory;
        return $this;
    }
    
    
    public function getDbAdapter() {
        return $this->dbAdapter;
    }

    public function setDbAdapter($dbAdapter) {
        $this->dbAdapter = $dbAdapter;
        return $this;
    }



}
