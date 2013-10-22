<?php

namespace Base\Service\Iterator\Filter\Url;

class Outdated extends \FilterIterator {

    public function accept() {

        $value = $this->current();

        assert($value instanceof \Base\Model\Entity\AUrl);

        $today = date('Y-m-d');

        return ($value->getUrl()->getEnde() < $today);

    }

}