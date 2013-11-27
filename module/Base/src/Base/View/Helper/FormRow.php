<?php

namespace Base\View\Helper;


use Zend\Form\View\Helper\FormRow as ZendFormRow;

/**
 * Der FormRow ViewHelper überschreibt das Standardverhalten des Zend
 * FormRow ViewHelpers. Es umschließt die Ausgaben von FormRow mit
 * einem formatierten div- Container.
 * 
 * @author Juri Zirnsak <juri.zirnsak@gmail.com>
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
class FormRow extends ZendFormRow {
    
    public function render(\Zend\Form\ElementInterface $element) {
        
        $result = '<div class="form-group">';
        $result .= parent::render($element);
        $result .='</div>';
        
        return $result;
    }
}
