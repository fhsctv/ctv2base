<?php

namespace Base\Service;

use Zend\Http\PhpEnvironment\Request;

use Base\Form\Infoscript as Form;

use Base\Model\Entity\Infoscript as Entity;

class Infoscript {
    
    const FLASHMESSENGER_DELETE_SUCCESS  = 'Das Infoscript wurde erfolgreich gelöscht!';
    const FLASHMESSENGER_DELETE_CANCELED = 'Das Löschen wurde abgebrochen!';
    
    protected $mapper;
    
    public function createInfoscriptFromForm(Form $form, Request $request) {
        
        if(!$request->isPost()){
            return false;
        }
        
        $form->setData($request->getPost());
        
        if(!$form->isValid()){
            assert($form->isValid(), "Eingetragene Daten ungültig");
            return false;
        }
        
        $infoscript = $form->getData();
        
        if($infoscript->getUrlId()){
            $infoscript->getUrl()->setId($infoscript->getUrlId()); //sollte die URL- Id geändert worden sein, muss dies dem URL- Objekt mitgeteilt werden (darf im Regelfall nicht passieren, da die url id im formular versteckt sein sollte)
        }
        return $infoscript;
    }
    
    
    public function fetchAll(){
        
        return $this->getMapper()->fetchAll();
    }
    
    public function get($id){
        
        return $this->getMapper()->get($id);
    }
    
    public function save(Entity $infoscript) {
        
        var_dump($infoscript);
        
        $this->getMapper()->save($infoscript);
        
        return true;
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




    
}

