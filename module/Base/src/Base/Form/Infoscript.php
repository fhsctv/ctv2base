<?php

namespace Base\Form;

use Zend\Form;
//use Zend\Stdlib\Hydrator;

use Base\Constants as C;
use Base\Form\Hydrator;
use Base\Model\Entity;


class Infoscript extends Inserat {

    /**
     *
     * @var \Zend\Form\Element\Text
     */
    protected $headline;

    /**
     *
     * @var \Zend\Form\Element\Textarea
     */
    protected $description;

    /**
     *
     * @var array
     */
    protected $columns = [];

    public function __construct() {

        parent::__construct('infoscript');

        $this->setHydrator(new Hydrator\Infoscript());
        $this->setObject(new Entity\Infoscript());

        $this->add($this->getHeadline(),        ['priority' => 50]);
        $this->add($this->getDescription(),     ['priority' => 50]);

        $this->setAttribute('class', 'well form-horizontal');

        $this->setClassAttributes();
    }



    /**
     *
     * @return \Zend\Form\Element\Hidden
     */
    public function getHeadline() {

        if(!$this->headline) {

            $headline = new Form\Element\Hidden('headline');
//            $headline->setLabel('Kopfzeile: ');

            $this->setHeadline($headline);
        }

        return $this->headline;
    }

    /**
     *
     * @param \Zend\Form\Element\Hidden $headline
     * @return \Base\Form\Infoscript
     */
    public function setHeadline(\Zend\Form\ElementInterface $headline) {
        $this->headline = $headline;
        return $this;
    }


    /**
     *
     * @return \Zend\Form\Element\Hidden
     */
    public function getDescription() {

        if(!$this->description) {

            $description = new Form\Element\Hidden('description');
//            $description->setLabel('Beschreibung: ');

            $this->setDescription($description);
        }

        return $this->description;
    }

    /**
     *
     * @param \Zend\Form\Element\Hidden $description
     * @return \Base\Form\Infoscript
     */
    public function setDescription(\Zend\Form\ElementInterface $description) {
        $this->description = $description;
        return $this;
    }


    public function addColumn() {

        $column = new Infoscript\ColumnFieldset('column'.  count($this->columns));

        array_push($this->columns, $column);

        $this->add($column, ['priority' => 49]);

        return $this;
    }


    public function setObject($object) {

        $this->createAsMuchFielsAsColumns($object);

        parent::setObject($object);
    }

    public function bind($object, $flags = 17){

        $this->createAsMuchFielsAsColumns($object);

        return parent::bind($object, $flags);
    }

    /**
     * Erzeugt so viele Formularfelder für Spalten, wie es Spalten im
     * Infoscript- Objekt gibt, jedoch mindestens eins.
     * @param \Base\Model\Entity\Infoscript $object
     */
    private function createAsMuchFielsAsColumns($object) {

        if(!$this->columns) {
            $this->addColumn();
        }

        //erzeuge so viele ColumnFieldset Elemente, wie es Spalten im Infoscript gibt
        while(count($this->columns) < count($object->getColumns())) {
            $this->addColumn();
        }

    }


}