<?php

namespace Base\Form;

trait SubmitTrait {

    /**
     *
     * @var \Zend\Form\Element\Submit
     */
    protected $submit;


    /**
     * @return \Zend\Form\Element\Submit Submitbutton
     */
    public function getSubmit() {

        if(empty($this->submit)){

            $submit = new \Zend\Form\Element\Submit('submit');
            $submit->setAttribute('class', 'btn btn-default');
            $submit->setValue('senden');

            $this->setSubmit($submit);
        }

        return $this->submit;
    }

    public function setSubmit(\Zend\Form\Element\Submit $submit) {
        $this->submit = $submit;
        return $this;
    }

}