<?php

namespace Base\Model\Entity\User;

class Phone {

    const PHONE  = 'phone';
    const MOBILE = 'mobile';
    const FAX    = 'fax';


    /**
     *
     * @var int
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $code;

    /**
     *
     * @var string
     */
    protected $number;

    /**
     *
     * @var string
     */
    protected $type;

    /**
     *
     * @var Base\Model\Entity\User
     */
    protected $user;


    public function __construct($type = null, $code = null, $number = null ) {

        $this->setType($type);
        $this->setCode($code);
        $this->setNumber($number);
    }


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }



    public function getCode() {
        return $this->code;
    }

    public function setCode($code) {
        $this->code = $code;
        return $this;
    }



    public function getNumber() {
        return $this->number;
    }

    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }



    public function getType() {
        return $this->type;
    }

    public function setType($type) {

        assert(in_array($type, [self::FAX, self::MOBILE, self::PHONE]));

        $this->type = $type;
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
