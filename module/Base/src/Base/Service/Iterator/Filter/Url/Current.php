<?php

namespace Base\Service\Iterator\Filter\Url;

class Current extends \FilterIterator {

    public function accept() {

        $value = $this->current();

        assert($value instanceof \Base\Model\Entity\AUrl);

        $today = date('Y-m-d');

        return (($value->getUrl()->getStart() <= $today) && ($value->getUrl()->getEnde() >= $today));

    }

}