<?php

namespace Base\Model\Entity;

class User {

    const INACTIVE = '0';
    const ACTIVE   = '1';
    
    /**
     * Eindeutige Benutzer- Id
     * @var int
     */
    protected $userId;

    /**
     * Eindeutiger Benutzername
     * @var string
     */
    protected $userName;

    /**
     * Eindeutige Emailadresse des Benutzers
     * @var string
     */
    protected $email;

    /**
     * Name, der auf der Webseite angezeigt wird.
     * @var string
     */
    protected $displayName;

    /**
     * Passwort des Benutzers
     * @var string
     */
    protected $password;
    
    /**
     * Status des Benutzerkontos:
     * 1 : aktiv
     * alles andere: inaktiv
     * @var int
     */
    protected $state;

    
    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        
        if(!is_numeric($userId)){
            throw new \RuntimeException('BenutzerId ist keine Zahl');
        }
        
        $this->userId = (int) $userId;
        return $this;
    }
    
    
    public function getUserName() {
        return $this->userName;
    }

    public function setUserName($userName) {
        
        assert(is_string($userName));
        
        $this->userName = $userName;
        return $this;
    }

    
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        
        assert(is_string($email));
        
        $this->email = $email;
        return $this;
    }


    public function getDisplayName() {
        return $this->displayName;
    }

    public function setDisplayName($displayName) {
        
        assert(is_string($displayName));
        
        $this->displayName = $displayName;
        return $this;
    }

    
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        
        assert(is_string($password));
        
        $this->password = $password;
        return $this;
    }


    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        
        assert(is_numeric($state));
        assert(in_array($state, [self::INACTIVE, self::ACTIVE]));
        
        
        $this->state = (int) $state;
        return $this;
    }

    
}
