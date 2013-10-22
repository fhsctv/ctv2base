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
            C::URL_ID      => $object->getDependency()->getUrlId(),
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
      
        throw new \Exception('Not implemented yet!');
    }

}