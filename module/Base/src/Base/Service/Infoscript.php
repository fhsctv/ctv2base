<?php

namespace Base\Service;

use Zend\Http\PhpEnvironment\Request;

use Base\Form\Infoscript as Form;

use Base\Model\Entity\Infoscript as Entity;

class Infoscript {

    const FLASHMESSENGER_DELETE_SUCCESS  = 'Das Infoscript wurde erfolgreich gelöscht!';
    const FLASHMESSENGER_DELETE_CANCELED = 'Das Löschen wurde abgebrochen!';

    protected $mapper;

    /**
     *
     * @param \Base\Form\Infoscript $form
     * @param \Zend\Http\PhpEnvironment\Request $request
     * @return Base\Model\Entity\Infoscript | false
     */
    public function createInfoscriptFromForm(Form $form, Request $request) {

        if(!$request->isPost() || !$request->getPost('user_id')){
            return false;
        }

        $form->setData($request->getPost());

        if(!$form->isValid()){
            assert($form->isValid(), "Eingetragene Daten ungültig");
            return false;
        }

        $infoscript = $form->getData();

        return $infoscript;
    }


    /**
     *
     * @return \Zend\Db\ResultSet\ResultSetInterface
     */
    public function findAll(){

        return $this->getMapper()->findAll();
    }

    /**
     *
     * @param int $id
     * @return \Base\Model\Entity\Infoscript
     */
    public function findById($id){

        return $this->getMapper()->getById($id);
    }

    /**
     *
     * @param int $userId
     * @return \Zend\Db\ResultSet\ResultSetInterface
     */
    public function findByUserId($userId){

        return $this->getMapper()->getByUserId($userId);
    }

    /**
     *
     * @param id $displayId
     * @return \Zend\Db\ResultSet\ResultSetInterface
     */
    public function findByDisplayId($displayId){

        return $this->getMapper()->getByBildschirmId($displayId);
    }


    public function save(Entity $infoscript) {

        return $this->getMapper()->save($infoscript);
    }

    public function delete(Entity $infoscript, Request $request, $flashMessenger){

        $safetyQuestion = $request->getPost('delete', 'Nein');

        if($safetyQuestion == 'Ja'){

            $this->getMapper()->delete($infoscript);
            $flashMessenger->addSuccessMessage(self::FLASHMESSENGER_DELETE_SUCCESS);
            return;
        }

        $flashMessenger->addInfoMessage(self::FLASHMESSENGER_DELETE_CANCELED);
    }


    public function getMapper() {
        return $this->mapper;
    }

    public function setMapper($mapper) {
        $this->mapper = $mapper;
        return $this;
    }

    // <editor-fold defaultstate="collapsed" desc="deprecated">

    /**
     * @deprecated
     */
    public function get($id){

        return $this->getMapper()->findById($id);
    }

    /**
     * @deprecated
     */
    public function getById($id) {

        return $this->getMapper()->getById($id);
    }

    /**
     * @deprecated
     */
    public function getByUserId($userId) {

        return $this->getMapper()->getByUserId($userId);
    }

    /**
     * @deprecated
     */
    public function getByBildschirmId($bildschirmId) {

        return $this->getMapper()->getByBildschirmId($bildschirmId);
    }

    /**
     * @deprecated
     */
    public function fetchAll(){

        return $this->getMapper()->fetchAll();
    }
    // </editor-fold>

}

