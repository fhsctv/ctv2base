<?php

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Base\Model\Mapper\Infoscript as InfMapper;
use Base\Model\Entity\Infoscript\Column;

use Base\Constants as C;

class IndexController extends AbstractActionController {

    public function indexAction(){

//        $bildschirmTable = $this->getServiceLocator()->get(C::SM_TBL_BILDSCHIRM);
//
//        $result = $bildschirmTable->fetchAll();
//
//        foreach ($result as $r) {
//            var_dump($r);
//        }

        $infoMapper = $this->getServiceLocator()->get(C::SM_MAP_INFOSCRIPT);
        $infoResult = $infoMapper->fetchAll();

        foreach ($infoResult as $i) {
            var_dump($i);
        }

//        $result = $this->getServiceLocator()->get(C::SM_MAP_BILDSCHIRM)->getByInseratId(4);
//
//        foreach ($result as $r) {
//            var_dump($r);
//        }

    }

}
