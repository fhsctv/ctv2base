<?php

namespace Base\Form\Hydrator;

use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class Infoscript extends Inserat {

    /**
     *
     * @param Base\Model\Entity\Infoscript $object
     * @return array
     */
    public function extract($object) {

        $filter = function($value){
            return !$this->isEmpty($value);
        };

        $inserat    = parent::extract($object);

        $infoscript =
        [
            'headline'     => $object->getHeadline(),
            'description'  => $object->getDescription(),
        ];

        foreach ($object->getColumns() as $key => $column) {
            $infoscript["column$key"] = $column;
        }

        $result = array_merge($inserat, $infoscript);

        $result = array_filter($result, $filter);

//        var_dump(__METHOD__, 'EXT_OBJ', $object, 'EXT_RES', $result);
        return $result;
    }

    public function hydrate(array $data, $object) {

        $object = parent::hydrate($data, $object);

        $this->isEmpty($data['headline'])      ? : $object->setHeadline($data['headline']);
        $this->isEmpty($data['description'])   ? : $object->setDescription($data['description']);

        foreach($data as $key => $value){

            if(substr($key, 0, 6) === 'column' && $value) {
                $object->addColumn($value);
            }
        }

        return $object;
    }

    private function isEmpty($value){

        return (($value === null) || ($value === ''));

    }

}