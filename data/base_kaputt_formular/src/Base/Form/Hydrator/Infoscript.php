<?php

namespace Base\Form\Hydrator;

use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class Infoscript implements HydratorInterface {
    
    public function extract($object) {
        
        $result = array(
            C::INFO_ID      => $object->getId(),
            C::INFO_URL_ID  => $object->getUrlId(),
            C::INFO_USER_ID => $object->getUserId(),
            C::URL_FORM_ID  => $object->getUrl(),
        );
        
//        var_dump(__METHOD__, 'EXT_OBJ', $object, 'EXT_RES', $result);
        return $result;
    }
    
    public function hydrate(array $data, $object) {
        
        $object->setId($data[C::INFO_ID]);
        $object->setUrlId($data[C::INFO_URL_ID]);
        $object->setUserId($data[C::INFO_USER_ID]);
        $object->setUrl($data[C::URL_FORM_ID]);
        
        
//        var_dump(__METHOD__, 'HYD_SRCDATA', $data, 'HYD_RES', $object);
        return $object;
    }
    
}