<?php

namespace Base\Model\Hydrator;

use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class Infoscript implements HydratorInterface {
    
    public function extract($object) {
        
        $filter = function($value) {
            return !(($value === null) || ($value === ''));
        };
        
        $result = array(
            C::INFO_ID      => $object->getId(),
            C::INFO_URL_ID  => $object->getUrlId(),
            C::INFO_USER_ID => $object->getUserId(),
//            C::URL_TABLE    => $object->getUrl(),
        );
        
        $result = array_filter($result, $filter);
        
//        var_dump(__METHOD__, 'EXT_OBJ', $object, 'EXT_RES', $result);
        return $result;
    }

    public function hydrate(array $data, $object) {
      
        
        
        $this->isEmpty($data[C::INFO_ID])      ? : $object->setId($data[C::INFO_ID]);
        $this->isEmpty($data[C::INFO_URL_ID])  ? : $object->setUrlId($data[C::INFO_URL_ID]);
        $this->isEmpty($data[C::INFO_USER_ID]) ? : $object->setUserId($data[C::INFO_USER_ID]);
        
        
        //delegieren an Url Hydrator
        
//        $this->isEmpty($data[C::URL_START])    ? : $object->getUrl()->setStart($data[C::URL_START]);
//        $this->isEmpty($data[C::URL_ENDE])     ? : $object->getUrl()->setEnde($data[C::URL_ENDE]);
//        $this->isEmpty($data[C::URL_ADRESSE])  ? : $object->getUrl()->setAdresse($data[C::URL_ADRESSE]);
//        $this->isEmpty($data[C::URL_AKTIV])    ? : $object->getUrl()->setAktiv($data[C::URL_AKTIV]);
        
        //TODO warum passiert das nicht schon woanders?
//        $object->getUrl()->setDependency($object); 
        
//        var_dump(__METHOD__, 'HYD_SRCDATA', $data, 'HYD_RES', $object);
        return $object;
    }
    
    
    private function isEmpty($value) {
        
        return (($value === null) || ($value === ''));
        
        
    }

}