<?php

namespace Base\Form\Infoscript;

use Zend\Form;
//use Zend\Stdlib\Hydrator;

use Base\Constants as C;
use Base\Form\Hydrator;
use Base\Model\Entity;


class ColumnFieldset extends Form\Fieldset {

    /**
     *
     * @var \Zend\Form\Element\Text
     */
    protected $title;

    /**
     *
     * @var \Zend\Form\Element\Textarea
     */
    protected $text;

    /**
     *
     * @var \Zend\Form\Element\Textarea
     */
    protected $list;


    use \Base\Form\ClassAttributesTrait;


    public function __construct($name = null) {

        parent::__construct($name);

        $this->setObject(new \Base\Model\Entity\Infoscript\Column());
        $this->setHydrator(new \Base\Model\Hydrator\Infoscript\Column());

        $this->add($this->getTitle());
        $this->add($this->getText());
        $this->add($this->getList());

        $this->setClassAttributes();

    }


    /**
     *
     * @return \Zend\Form\Element\Text
     */
    public function getTitle() {

        if(!$this->title) {

            $title = new Form\Element\Text('title');
            $title->setLabel('Titel:');

            $this->setTitle($title);
        }

        return $this->title;
    }

    /**
     *
     * @param \Zend\Form\Element\Text $title
     * @return \Base\Form\ColumnFieldset
     */
    public function setTitle(\Zend\Form\Element\Text $title) {
        $this->title = $title;
        return $this;
    }



    /**
     *
     * @return \Zend\Form\Element\Textarea
     */
    public function getText() {

        if(!$this->text) {

            $text = new Form\Element\Textarea('text');
            $text->setLabel('Text:');

            $this->setText($text);
        }

        return $this->text;
    }

    /**
     *
     * @param \Zend\Form\Element\Textarea $text
     * @return \Base\Form\ColumnFieldset
     */
    public function setText(\Zend\Form\Element\Textarea $text) {
        $this->text = $text;
        return $this;
    }



    /**
     *
     * @return \Zend\Form\Element\Textarea
     */
    public function getList() {

        if(!$this->list) {

            $list = new Form\Element\Textarea('list');
            $list->setLabel('Liste:');

            $this->setList($list);
        }

        return $this->list;
    }

    /**
     *
     * @param \Zend\Form\Element\Textarea $list
     * @return \Base\Form\ColumnFieldset
     */
    public function setList(\Zend\Form\Element\Textarea $list) {
        $this->list = $list;
        return $this;
    }


}
