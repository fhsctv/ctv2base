<?php

namespace Base\Model\Hydrator\Infoscript;

use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class Column implements HydratorInterface {

    public function extract($object) {

        $filter = function($value) {
            return !(($value === null) || ($value === ''));
        };

        $data = array(
            'id'  => $object->getId(),
            'titel'       => $object->getTitle(),
            'text'        => $object->getText(),
            'inserat_id'  => $object->getInfoscript()->getInseratId(),

        );

        $result = array_filter($data, $filter);

//        var_dump(__METHOD__, 'EXT_OBJ', $object, 'EXT_RES', $result);
        return $result;
    }

    public function hydrate(array $data, $object) {

        (!isset($data['id'])    || $this->isEmpty($data['id']))    ? : $object->setId($data['id']);
        (!isset($data['titel']) || $this->isEmpty($data['titel'])) ? : $object->setTitle($data['titel']);
        (!isset($data['text'])  || $this->isEmpty($data['text']))  ? : $object->setText($data['text']);


//        var_dump(__METHOD__, 'HYD_SRCDATA', $data, 'HYD_RES', $object);
        return $object;
    }


    private function isEmpty($value) {

        return (($value === null) || ($value === ''));


    }

}