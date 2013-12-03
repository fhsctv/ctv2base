<?php

namespace Base\Form\Hydrator;

use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class Inserat implements HydratorInterface {

    public function extract($object) {

        $filter = function($value){
            return !$this->isEmpty($value);
        };

        $result = array(
            'inserat_id'  => $object->getInseratId(),
            'start'       => $object->getStart(),
            'ende'        => $object->getEnde(),
            'url'         => $object->getUrl(),
            'aktiv'       => $object->getAktiv(),
//            'bildschirme' => $object->getBildschirme(),
            'user_id'     => $object->getUserId(),
        );

        $result = array_filter($result, $filter);

//        var_dump(__METHOD__, 'EXT_OBJ', $object, 'EXT_RES', $result);
        return $result;
    }

    public function hydrate(array $data, $object) {

        $this->isEmpty($data['inserat_id'])   ? : $object->setInseratId($data['inserat_id']);
        $this->isEmpty($data['start'])        ? : $object->setStart($data['start']);
        $this->isEmpty($data['ende'])         ? : $object->setEnde($data['ende']);
        $this->isEmpty($data['url'])          ? : $object->setUrl($data['url']);
        $this->isEmpty($data['aktiv'])        ? : $object->setAktiv($data['aktiv']);
//        $this->isEmpty($data['bildschirme'])  ? : $object->setBildschirme($data['bildschirme']);
        $this->isEmpty($data['user_id'])      ? : $object->setUserId($data['user_id']);



//        var_dump(__METHOD__, 'HYD_SRCDATA', $data, 'HYD_RES', $object);
        return $object;
    }

    private function isEmpty($value){

        return (($value === null) || ($value === ''));

    }

}