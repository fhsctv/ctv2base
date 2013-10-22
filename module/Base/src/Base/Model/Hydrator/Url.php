<?php

namespace Base\Model\Hydrator;

use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class Url implements HydratorInterface {
    
    public function extract($object) {
        
        $filter = function($value) {
            return !(($value === null) || ($value === ''));
        };
        
        $result = array(
            C::URL_ID      => $object->getId(),
            C::URL_START   => $object->getStart(),
            C::URL_ENDE    => $object->getEnde(),
            C::URL_ADRESSE  => $object->getAdresse(),
            C::URL_AKTIV   => $object->getAktiv(),
            
        );
        
        $result = array_filter($result, $filter);
        
//        var_dump(__METHOD__, 'EXT_OBJ', $object, 'EXT_RES', $result);
        return $result;
    }

    public function hydrate(array $data, $object) {
        
        $this->isEmpty($data[C::URL_ID])       ? : $object->setId($data[C::URL_ID]);
        $this->isEmpty($data[C::URL_START])    ? : $object->setStart($data[C::URL_START]);
        $this->isEmpty($data[C::URL_ENDE])     ? : $object->setEnde($data[C::URL_ENDE]);
        $this->isEmpty($data[C::URL_ADRESSE])  ? : $object->setAdresse($data[C::URL_ADRESSE]);
        $this->isEmpty($data[C::URL_AKTIV])    ? : $object->setAktiv($data[C::URL_AKTIV]);
        

        
//        var_dump(__METHOD__, 'HYD_SRCDATA', $data, 'HYD_RES', $object);
        return $object;
    }
    
    private function isEmpty($value) {
        
        return (($value === null) || ($value === ''));
        
        
    }

}