<?php

namespace Base\Form\Hydrator;

use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class Url implements HydratorInterface {
    
    public function extract($object) {
        
        $result = array(
            C::URL_ADRESS => $object->getAdress(),
            C::URL_START  => $object->getStart(),
            C::URL_ENDE   => $object->getEnde(),
            C::URL_AKTIV  => $object->getAktiv(),
            'dependency' => $object->getDependency(),
        );
        
        
//        var_dump(__METHOD__, 'EXT_OBJ', $object, 'EXT_RES', $result);
        return $result;
    }

    public function hydrate(array $data, $object) {
        
        $object->setAdress($data[C::URL_ADRESS]);
        $object->setStart($data[C::URL_START]);
        $object->setEnde($data[C::URL_ENDE]);
        $object->setAktiv($data[C::URL_AKTIV]);
        
        
//        var_dump(__METHOD__, 'HYD_SRCDATA', $data, 'HYD_RES', $object);
        return $object;
    }

}

