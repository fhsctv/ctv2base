<?php

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Base\Model\Mapper\Infoscript as InfMapper;

use Base\Constants as C;

class IndexController extends AbstractActionController {
    
    public function indexAction(){

        $infoscript = $this->getServiceLocator()->get(C::SERVICE_ENTITY_INFOSCRIPT);
        
        $infoscript->setId(1)->setUrlId(2)->setUserId(3);
        $infoscript->getUrl()->setAdresse('http://')->setStart('2013-01-01')
                ->setEnde('2013-02-03')->setAktiv(0);


        
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
    
    public function tablegwAction(){
        
        
        $resultSet = $this->getServiceLocator()->get(C::SERVICE_TABLE_INFOSCRIPT)->fetchAll();
        
        var_dump($resultSet->toArray());
        
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
        
        
        $table = $this->getServiceLocator()->get('Base\Table\Infoscript');

        
        $resSet = $table->fetchAll();
        
        
        var_dump($resSet->toArray());
        
        
        
        
    }
    
}
