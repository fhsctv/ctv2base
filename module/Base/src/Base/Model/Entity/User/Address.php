<?php

namespace Base\Model\Entity\User;

class Address {

    /**
     *
     * @var int
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $street;

    /**
     *
     * @var int
     */
    protected $number;

    /**
     *
     * @var string
     */
    protected $addition;

    /**
     *
     * @var string
     */
    protected $postalCode;

    /**
     *
     * @var string
     */
    protected $town;

    /**
     *
     * @var Base\Model\Entity\User
     */
    protected $user;



    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getStreet() {
        return $this->street;
    }

    public function setStreet($street) {
        $this->street = $street;
        return $this;
    }

    public function getNumber() {
        return $this->number;
    }

    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }

    public function getAddition() {
        return $this->addition;
    }

    public function setAddition($addition) {
        $this->addition = $addition;
        return $this;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getTown() {
        return $this->town;
    }

    public function setTown($town) {
        $this->town = $town;
        return $this;
    }


    /**
     *
     * @return Base\Model\Entity\User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     *
     * @param \Base\Model\Entity\Adresse\Base\Model\Entity\User $user
     * @return \Base\Model\Entity\Adresse\User
     */
    public function setUser(Base\Model\Entity\User $user) {
        $this->user = $user;
        return $this;
    }


}
