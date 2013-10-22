<?php

namespace Base\Service;

use Zend\Http\PhpEnvironment\Request;

use Base\Form\Anzeige as Form;

use Base\Model\Entity\Anzeige as Entity;

class Anzeige {
    
    const FLASHMESSENGER_DELETE_SUCCESS  = 'Das Anzeige wurde erfolgreich gelöscht!';
    const FLASHMESSENGER_DELETE_CANCELED = 'Das Löschen wurde abgebrochen!';
    
    protected $mapper;
    
    public function createAnzeigeFromForm(Form $form, Request $request) {
        
        if(!$request->isPost()){
            return false;
        }
        
        $form->setData($request->getPost());
        
        if(!$form->isValid()){
            assert($form->isValid(), "Eingetragene Daten ungültig");
            return false;
        }
        
        $anzeige = $form->getData();
        
        if(!empty($anzeige->getUrlId())){
            $anzeige->getUrl()->setId($anzeige->getUrlId()); //sollte die URL- Id geändert worden sein, muss dies dem URL- Objekt mitgeteilt werden
        }
        return $anzeige;
    }
    
    
    public function fetchAll(){
        
        return $this->getMapper()->fetchAll();
    }
    
    public function get($id){
        
        return $this->getMapper()->get($id);
    }
    
    public function save(Entity $anzeige) {
        
        var_dump($anzeige);
        
        $this->getMapper()->save($anzeige);
        
        return true;
    }
    
    public function delete(Entity $anzeige, Request $request, $flashMessenger){
        
        $safetyQuestion = $request->getPost('delete', 'Nein');
        
        if($safetyQuestion == 'Ja'){
            
            $this->getMapper()->delete($anzeige);
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

