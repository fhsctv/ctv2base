<?php

namespace Base\Model\Hydrator;

use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class Bildschirm implements HydratorInterface {
    
    public function extract($object) {
        
        assert($object instanceof \Base\Model\Entity\Bildschirm);
        
        $filter = function($value) {
            return !(($value === null) || ($value === ''));
        };
        
        $data = array(
            'bildschirm_id'  => $object->getId(),
            'beschreibung'   => $object->getBeschreibung(),
        );
        
        $result = array_filter($data, $filter);
        
//        var_dump(__METHOD__, 'EXT_OBJ', $object, 'EXT_RES', $result);
        return $result;
    }

    public function hydrate(array $data, $object) {
        
        assert($object instanceof \Base\Model\Entity\Bildschirm);
        
        (!isset($data['bildschirm_id']) || $this->isEmpty($data['bildschirm_id'])) ? : $object->setId($data['bildschirm_id']);
        (!isset($data['beschreibung'])  || $this->isEmpty($data['beschreibung']))  ? : $object->setBeschreibung($data['beschreibung']);

        
//        var_dump(__METHOD__, 'HYD_SRCDATA', $data, 'HYD_RES', $object);
        return $object;
    }
    
    
    private function isEmpty($value) {
        
        return (($value === null) || ($value === ''));
        
        
    }

}