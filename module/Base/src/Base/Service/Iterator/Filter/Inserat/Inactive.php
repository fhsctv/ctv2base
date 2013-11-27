<?php

namespace Base\Service\Iterator\Filter\Inserat;

class Inactive extends \FilterIterator {

    public function accept() {

        $value = $this->current();
        
        assert($value instanceof \Base\Model\Entity\Inserat);

        return (!$value->getAktiv());

    }
    
    

}