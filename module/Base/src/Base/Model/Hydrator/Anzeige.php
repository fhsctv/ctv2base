<?php

namespace Base\Model\Hydrator;

use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class Anzeige implements HydratorInterface {
    
    public function extract($object) {
        
        $filter = function($value) {
            return !(($value === null) || ($value === ''));
        };
        
        $result = array(
            C::ANZEIGE_ID      => $object->getId(),
            C::ANZEIGE_URL_ID  => $object->getUrlId(),
            C::ANZEIGE_USER_ID => $object->getUserId(),
//            C::URL_TABLE    => $object->getUrl(),
        );
        
        $result = array_filter($result, $filter);
        
//        var_dump(__METHOD__, 'EXT_OBJ', $object, 'EXT_RES', $result);
        return $result;
    }

    public function hydrate(array $data, $object) {
      
        
        
        $this->isEmpty($data[C::ANZEIGE_ID])      ? : $object->setId($data[C::ANZEIGE_ID]);
        $this->isEmpty($data[C::ANZEIGE_URL_ID])  ? : $object->setUrlId($data[C::ANZEIGE_URL_ID]);
        $this->isEmpty($data[C::ANZEIGE_USER_ID]) ? : $object->setUserId($data[C::ANZEIGE_USER_ID]);
        
//        var_dump(__METHOD__, 'HYD_SRCDATA', $data, 'HYD_RES', $object);
        return $object;
    }
    
    
    private function isEmpty($value) {
        
        return (($value === null) || ($value === ''));
        
        
    }

}