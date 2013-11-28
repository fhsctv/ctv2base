<?php

namespace Base\Model\Entity;

class Infoscript extends Inserat {

    /**
     *
     * @var string
     */
    protected $headLine;

    /**
     *
     * @var string
     */
    protected $title;

    /**
     *
     * @var array
     */
    protected $text = array();

    /**
     *
     * @var array
     */
    protected $lists = array();


    /**
     *
     * @return string
     */
    public function getHeadLine() {
        return $this->headLine;
    }

    /**
     *
     * @param string $headLine
     * @return \Base\Model\Entity\Infoscript
     */
    public function setHeadLine($headLine) {
        $this->headLine = $headLine;
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
     * @return \Base\Model\Entity\Infoscript
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }



    /**
     *
     * @return array
     */
    public function getText() {
        return $this->text;
    }

    /**
     *
     * @param string $text
     * @return \Base\Model\Entity\Infoscript
     */
    public function setText($text) {

        $textLineArray = explode(PHP_EOL, $text);

        foreach ($textLineArray as $textLine) {
            $this->addTextLine($textLine);
        }

        return $this;
    }

    /**
     *
     * @param string $textLine
     * @return \Base\Model\Entity\Infoscript
     */
    public function addTextLine($textLine) {

        $txtLine = new TextLine($textLine);

        array_push($this->text, $txtLine);
        return $this;
    }



    /**
     *
     * @return array
     */
    public function getLists() {
        return $this->lists;
    }

    /**
     *
     * @param array $lists
     * @return \Base\Model\Entity\Infoscript
     */
    public function setLists(array $lists) {
        $this->lists = $lists;
        return $this;
    }

    /**
     *
     * @param string $list
     * @return \Base\Model\Entity\Infoscript
     */
    public function addList($list) {

        array_push($this->lists, $list);
        return $this;
    }

}