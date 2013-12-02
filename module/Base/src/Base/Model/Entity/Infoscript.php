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
     * @var array
     */
    protected $columns = [];

    /**
     *
     * @var string
     */
    protected $list;

    /**
     *
     * @var array
     */
    protected $pictures = [];


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
     * @return bool
     */
    public function hasColumns() {
        return (count($this->getColumns()) !== 0);
    }

    /**
     *
     * @return array
     */
    public function getColumns() {
        return $this->columns;
    }

    /**
     *
     * @param int $idx
     * @return \Base\Model\Entity\Infoscript\Column
     */
    public function getColumn($idx) {

        return $this->getColumns()[$idx];

    }

    /**
     *
     * @return \Base\Model\Entity\Infoscript\Column
     */
    public function getFirstColumn() {

        return $this->getColumns()[0];
    }

    /**
     * @return \Base\Model\Entity\Infoscript\Column
     */
    public function getSecondColumn() {

        return $this->getColumns()[1];
    }

    /**
     *
     * @param array $columns
     * @return \Base\Model\Entity\Infoscript
     */
    public function setColumns(array $columns) {

        foreach ($columns as $column) {
            $this->addColumn($column);
        }

        $this->columns = $columns;
        return $this;
    }

    /**
     *
     * @param \Base\Model\Entity\Infoscript\Column $column
     * @return \Base\Model\Entity\Infoscript
     */
    public function addColumn(Infoscript\Column $column) {

        $column->setInfoscript($this);
        array_push($this->columns, $column);
        return $this;
    }




    /**
     *
     * @return string
     */
    public function getList() {
        return $this->list;
    }

    /**
     *
     * @param string $list
     * @return \Base\Model\Entity\Infoscript
     */
    public function setList($list) {
        $this->list = $list;
        return $this;
    }



    /**
     *
     * @return array
     */
    public function getPictures() {
        return $this->pictures;
    }

    /**
     *
     * @param array $pictures
     * @return \Base\Model\Entity\Infoscript
     */
    public function setPictures(array $pictures) {

        foreach ($pictures as $picture) {
            $this->addPicture($picture);
        }

        $this->pictures = $pictures;
        return $this;
    }

    /**
     *
     * @return \Base\Model\Entity\Infoscript
     */
    public function addPicture($picture) {

        array_push($this->pictures, $picture);
        return $this;
    }


}