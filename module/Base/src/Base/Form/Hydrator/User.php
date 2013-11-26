<?php

namespace Base\Form\Hydrator;

use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class User implements HydratorInterface {
    
    public function extract($object) {
        
        $filter = function($value) {
            return !(($value === null) || ($value === ''));
        };
        
        $data = array(
            'user_id'          => $object->getUserId(),
            'username'         => $object->getUserName(),
            'email'            => $object->getEmail(),
            'display_name'     => $object->getDisplayName(),
            'password'         => $object->getPassword(),
            'state'            => $object->getState(),
            
        );
        
        $result = array_filter($data, $filter);
        
//        var_dump(__METHOD__, 'EXT_OBJ', $object, 'EXT_RES', $result);
        return $result;
    }

    public function hydrate(array $data, $object) {
        
        (!isset($data['user_id'])       || $this->isEmpty($data['user_id']))      ? : $object->setUserId($data['user_id']);
        (!isset($data['username'])      || $this->isEmpty($data['username']))     ? : $object->setUserName($data['username']);
        (!isset($data['email'])         || $this->isEmpty($data['email']))        ? : $object->setEmail($data['email']);
        (!isset($data['display_name'])  || $this->isEmpty($data['display_name'])) ? : $object->setDisplayName($data['display_name']);
        (!isset($data['password'])      || $this->isEmpty($data['password']))     ? : $object->setPassword($data['password']);
        (!isset($data['state'])         || $this->isEmpty($data['state']))        ? : $object->setState($data['state']);
        
//        var_dump(__METHOD__, 'HYD_SRCDATA', $data, 'HYD_RES', $object);
        return $object;
    }
    
    
    private function isEmpty($value) {
        
        return (($value === null) || ($value === ''));
        
        
    }

}