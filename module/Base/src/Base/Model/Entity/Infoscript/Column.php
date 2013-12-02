<?php

namespace Base\Model\Entity\Infoscript;

class Column {

    /**
     *
     * @var int
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $title;

    /**
     *
     * @var string
     */
    protected $text;

    /**
     *
     * @var \Base\Model\Entity\Infoscript
     */
    protected $infoscript;

    /**
     *
     * @param string $title
     * @param string $text
     */
    public function __construct($title = null, $text = null, \Base\Model\Entity\Infoscript $infoscript = null) {

        $this->setInfoscript($infoscript);
        $this->setTitle($title);
        $this->setText($text);
    }

    /**
     *
     * @return bool
     */
    public function hasId() {
        return (bool) $this->getId();
    }

    /**
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     *
     * @param int $id
     * @return \Base\Model\Entity\Infoscript\Column
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }


    /**
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     *
     * @param string $title
     * @return \Base\Model\Entity\Infoscript\Column
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }



    /**
     *
     * @return string
     */
    public function getText() {
        return $this->text;
    }

    /**
     *
     * @param string $text
     * @return \Base\Model\Entity\Infoscript\Column
     */
    public function setText($text) {
        $this->text = $text;
        return $this;
    }


    /**
     *
     * @return \Base\Model\Entity\Infoscript
     */
    public function getInfoscript() {
        return $this->infoscript;
    }

    /**
     *
     * @param \Base\Model\Entity\Infoscript $infoscript
     * @return \Base\Model\Entity\Infoscript\Column
     */
    public function setInfoscript($infoscript) {

        assert($infoscript instanceof \Base\Model\Entity\Infoscript || $infoscript === null, 'Falsches Argument in Methode' . __METHOD__);

        $this->infoscript = $infoscript;
        return $this;
    }



}