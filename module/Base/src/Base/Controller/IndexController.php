<?php

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Base\Model\Mapper\Infoscript as InfMapper;

use Base\Constants as C;

class IndexController extends AbstractActionController {
    
    public function indexAction(){

        $infoscript = $this->getServiceLocator()->get(C::SERVICE_ENTITY_INFOSCRIPT);
        
        $infoscript->setInseratId(1)->setUserId(3)->setUrl('http://www.debug.form.loc')
                   ->setStart('2013-01-01')->setEnde('2013-02-03')->setAktiv(0)
                   ->addBildschirm(1);


           
        
        $form = $this->getServiceLocator()->get(C::SERVICE_FORM_INFOSCRIPT);
        $form->bind($infoscript);

        $form->setData($this->getRequest()->getPost());



        $form->isValid();

//        $form->getData();

        var_dump('---------------POST---------------' , $this->getRequest()->getPost());

        var_dump('-------------GET-DATA-------------' , $form->getData());
        return new ViewModel(
            array(
                'form' => $form,
            )
        );
    }
    
    public function saveInseratAction(){
        
        
        $infoscript = $this->getServiceLocator()->get(C::SERVICE_ENTITY_INFOSCRIPT);
        $infoscript->setStart('2099-12-12')->setEnde('3000-01-01')->setUrl('http://inserat.debug5.loc')->setAktiv(1);
        $infoscript->setUserId(1);
        $infoscript->addBildschirm(4);
        
        $mapper = $this->getServiceLocator()->get(C::SERVICE_MAPPER_INFOSCRIPT);
        $mapper->save($infoscript);
        
    }
    
    public function createAction(){
        
        
        $infoscript = $this->getServiceLocator()->get(C::SERVICE_ENTITY_INFOSCRIPT);
        
        $infoscript->setUserId(3);
        $infoscript->getUrl()->setAdresse('http://blablabl2a.to')->setStart('2013-01-01')->setEnde('2013-02-03')->setAktiv(0);


        $mapper = new InfMapper();
        $mapper->setTableInfoscript($this->getServiceLocator()->get(C::SERVICE_TABLE_INFOSCRIPT));
        $mapper->setTableUrl($this->getServiceLocator()->get(C::SERVICE_TABLE_URL));
       
        
        
        $id = $mapper->save($infoscript);
        
        var_dump($mapper->fetchAll()->current());
        
        
//        $table = $this->getServiceLocator()->get(C::SERVICE_TABLE_INFOSCRIPT);
//        var_dump($table->fetchAll()->current());
    }
    
    public function fetchAllAction(){
        

        $infoscriptMapper    = $this->getServiceLocator()->get(C::SERVICE_MAPPER_INFOSCRIPT);
        
        $resSet = $infoscriptMapper->fetchAll();
        

        foreach ($resSet as $r){
            var_dump($r);  
        }
        
        
    }
    
    public function bildschirmLinkerAction(){
        
        $table = $this->getServiceLocator()->get(C::SERVICE_TABLE_INSERATBILDSCHIRMLINKER);
        
        
        $resultSet = $table->getByInseratId(1);
        
        foreach ($resultSet as $r) {
            var_dump($r);
        }
        
        
        
    }
    
}
