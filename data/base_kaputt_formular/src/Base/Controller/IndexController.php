<?php

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Base\Constants as C;

class IndexController extends AbstractActionController {
    
    public function indexAction(){

        $infoscript = $this->getServiceLocator()->get('Base\Entity\Infoscript');
        
        $infoscript->setId(1)->setUrlId(2)->setUserId(3);
        
        $infoscript->getUrl()
                ->setAdress('http://')->setStart('2013-01-01')
                ->setEnde('2013-02-03')->setAktiv(0);


        
        $form = $this->getServiceLocator()->get('Base\Form\Infoscript');
//        $form->bind($infoscript);

//        $form->setData($this->getRequest()->getPost());



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
    
    public function dbhydratorAction(){
        
        
        $tgw = new \Zend\Db\TableGateway\TableGateway('infoscript', 
                $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));
        
        $condition = new \Zend\Db\Sql\Select('infoscript');
        $condition->join('url', 'infoscript.fk_url_id = url.id', array(
                C::URL_START  => C::URL_START,
                C::URL_ENDE   => C::URL_ENDE,
                C::URL_ADRESS => C::URL_ADRESS,
                C::URL_AKTIV  => C::URL_AKTIV,
            
            )
        );
        
        $result = $tgw->selectWith($condition);
        
        var_dump($result->current());
        
        
        return array();
    }
}
