<?php

namespace Base\Form;

trait ClassAttributesTrait {

    protected function setClassAttributes() {

        foreach ($this->getElements() as $element) {

            if($element instanceof Form\Element\Hidden || $element instanceof Form\Element\Submit){
                continue;
            }

            $element->setAttribute('class', 'form-control');
            $element->setLabelAttributes(['class' => 'control-label']);
        }

        return $this;
    }

}