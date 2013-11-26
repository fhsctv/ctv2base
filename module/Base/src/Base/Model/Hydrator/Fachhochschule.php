<?php

namespace Base\Model\Hydrator;

use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class Fachhochschule extends User {
    
    public function extract($object) {
        
        $filter = function($value) {
            return !(($value === null) || ($value === ''));
        };
        
        $data['user_id'] = $object->getUserId();
        $data['name']    = $object->getName();
        
        $result = array_filter($data, $filter);
        
//        var_dump(__METHOD__, 'EXT_OBJ', $object, 'EXT_RES', $result);
        return $result;
    }

    public function hydrate(array $data, $object) {
        
        $object = parent::hydrate($data, $object);
        
        (!isset($data['name'])       || $this->isEmpty($data['name']))      ? : $object->setName($data['name']);
        
//        var_dump(__METHOD__, 'HYD_SRCDATA', $data, 'HYD_RES', $object);
        return $object;
    }
    
    
    private function isEmpty($value) {
        
        return (($value === null) || ($value === ''));
        
        
    }

}