<?php

namespace Base\Model\Hydrator;

use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class Infoscript extends Inserat {

    public function extract($object) {

        $result = array (
            'inserat_id'  => $object->getInseratId(),
            'headline'    => $object->getHeadLine(),
            'description' => $object->getDescription(),
            'fk_fh_id'    => $object->getUserId(),
        );

//        var_dump(__METHOD__, 'EXT_OBJ', $object, 'EXT_RES', $result);
        return $result;
    }

    public function hydrate(array $data, $object) {

        parent::hydrate($data, $object);
        (!isset($data['headline'])    || $this->isEmpty($data['headline']))    ? : $object->setHeadLine($data['headline']);
        (!isset($data['description']) || $this->isEmpty($data['description'])) ? : $object->setDescription($data['description']);
        (!isset($data['fk_fh_id'])    || $this->isEmpty($data['fk_fh_id']))    ? : $object->setUserId($data['fk_fh_id']);

//        var_dump(__METHOD__, 'HYD_SRCDATA', $data, 'HYD_RES', $object);
        return $object;
    }

    private function isEmpty($value) {

        return (($value === null) || ($value === ''));


    }


}