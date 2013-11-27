<?php

namespace Base\Service\Iterator\Filter\Inserat;

class Outdated extends \FilterIterator {

    public function accept() {

        $value = $this->current();

        assert($value instanceof \Base\Model\Entity\Inserat);

        $today = date('Y-m-d');

        return ($value->getEnde() < $today && $value->getAktiv());

    }

}