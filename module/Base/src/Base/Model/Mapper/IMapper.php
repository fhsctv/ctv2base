<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Base\Model\Mapper;

/**
 *
 * @author juri
 */
interface IMapper {

    public function findAll();

    public function findById($id);

    public function findBy($column, $value);

    public function save(\Base\Model\Entity\IEntity $entity);

    public function delete(\Base\Model\Entity\IEntity $infoscript, $useTransactions = true);

}
