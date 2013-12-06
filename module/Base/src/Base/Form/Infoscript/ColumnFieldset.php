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


    use \Base\Form\ClassAttributesTrait;


    public function __construct($name = null) {

        parent::__construct($name);

        $this->setObject(new \Base\Model\Entity\Infoscript\Column());
        $this->setHydrator(new \Base\Model\Hydrator\Infoscript\Column());

        $this->add($this->getTitle());
        $this->add($this->getText());

        $this->setClassAttributes();

    }


    /**
     *
     * @return \Zend\Form\ElementInterface
     */
    public function getTitle() {

        if(!$this->title) {

            $title = new \Zend\Form\Element\Hidden('title');
//            $title->setLabel('Titel:');

            $this->setTitle($title);
        }

        return $this->title;
    }

    /**
     *
     * @param \Zend\Form\Element\Text $title
     * @return \Base\Form\ColumnFieldset
     */
    public function setTitle(\Zend\Form\ElementInterface $title) {
        $this->title = $title;
        return $this;
    }



    /**
     *
     * @return \Zend\Form\Element\ElementInterface
     */
    public function getText() {

        if(!$this->text) {

            $text = new Form\Element\Hidden('text');
//            $text->setLabel('Text:');

            $this->setText($text);
        }

        return $this->text;
    }

    /**
     *
     * @param \Zend\Form\Element\Textarea $text
     * @return \Base\Form\ColumnFieldset
     */
    public function setText(\Zend\Form\ElementInterface $text) {
        $this->text = $text;
        return $this;
    }


}
