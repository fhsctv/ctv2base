<?php

namespace Base\Model\Entity;

class User implements IEntity {

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

    /**
     *
     * @var \Base\Model\Entity\User\Address
     */
    protected $address;

    /**
     *
     * @var Base\Model\Entity\User\Phone
     */
    protected $landline;

    /**
     *
     * @var  Base\Model\Entity\User\Phone
     */
    protected $mobile;

    /**
     *
     * @var Base\Model\Entity\User\Phone
     */
    protected $fax;


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


    /**
     *
     * @return \Base\Model\Entity\User\Address
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     *
     * @param \Base\Model\Entity\User\Address $address
     * @return \Base\Model\Entity\User
     */
    public function setAddress(\Base\Model\Entity\User\Address $address) {
        $this->address = $address;
        return $this;
    }



    /**
     *
     * @return Base\Model\Entity\User\Phone
     */
    public function getLandline() {
        return $this->landline;
    }

    /**
     *
     * @param \Base\Model\Entity\Base\Model\Entity\User\Phone $landline
     * @return \Base\Model\Entity\User
     */
    public function setLandline(Base\Model\Entity\User\Phone $landline) {
        $this->landline = $landline;
        return $this;
    }



    /**
     *
     * @return Base\Model\Entity\User\Phone
     */
    public function getMobile() {
        return $this->mobile;
    }

    /**
     *
     * @param \Base\Model\Entity\Base\Model\Entity\User\Phone $mobile
     * @return \Base\Model\Entity\User
     */
    public function setMobile(Base\Model\Entity\User\Phone $mobile) {
        $this->mobile = $mobile;
        return $this;
    }



    /**
     *
     * @return Base\Model\Entity\User\Phone
     */
    public function getFax() {
        return $this->fax;
    }

    /**
     *
     * @param \Base\Model\Entity\Base\Model\Entity\User\Phone $fax
     * @return \Base\Model\Entity\User
     */
    public function setFax(Base\Model\Entity\User\Phone $fax) {
        $this->fax = $fax;
        return $this;
    }


}
