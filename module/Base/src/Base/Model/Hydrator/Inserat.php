<?php

namespace Base\Model\Hydrator;

use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class Inserat implements HydratorInterface {
    
    public function extract($object) {
        
        $filter = function($value) {
            return !(($value === null) || ($value === ''));
        };
        
        $data = array(
            'inserat_id'  => $object->getInseratId(),
            'start'       => $object->getStart(),
            'ende'        => $object->getEnde(),
            'url'         => $object->getUrl(),
            'aktiv'       => $object->getAktiv(),
        );
        
        $result = array_filter($data, $filter);
        
//        var_dump(__METHOD__, 'EXT_OBJ', $object, 'EXT_RES', $result);
        return $result;
    }

    public function hydrate(array $data, $object) {
        
        (!isset($data['inserat_id']) || $this->isEmpty($data['inserat_id'])) ? : $object->setInseratId($data['inserat_id']);
        (!isset($data['start'])      || $this->isEmpty($data['start']))      ? : $object->setStart($data['start']);
        (!isset($data['ende'])       || $this->isEmpty($data['ende']))       ? : $object->setEnde($data['ende']);
        (!isset($data['url'])        || $this->isEmpty($data['url']))        ? : $object->setUrl($data['url']);
        (!isset($data['aktiv'])      || $this->isEmpty($data['aktiv']))      ? : $object->setAktiv($data['aktiv']);
        
//        var_dump(__METHOD__, 'HYD_SRCDATA', $data, 'HYD_RES', $object);
        return $object;
    }
    
    
    private function isEmpty($value) {
        
        return (($value === null) || ($value === ''));
        
        
    }

}