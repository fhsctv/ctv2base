<?php

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Base\Service\Iterator\Filter\Inserat as Filter;

use Base\Constants as C;

class InfoscriptController extends AbstractActionController {

    const ROUTE                          = 'administration/default';
    const CONTROLLER                     = 'infoscript';
    const ACTION_INDEX                   = 'index';
    const ACTION_SHOW                    = 'show';
    const ACTION_DETAILS                 = 'details';
    const ACTION_CREATE                  = 'create';
    const ACTION_EDIT                    = 'edit';
    const ACTION_DELETE                  = 'delete';
    const ACTION_DELETE_DISPLAY          = 'delete-from-display';
    const ACTION_ADD_DISPLAY             = 'add-to-display';

    const MESSAGE_CREATE_SUCCESS         = 'Das Infoscript wurde erfolgreich erstellt!';
    const FLASHMESSENGER_EDIT_SUCCESS    = 'Das Infoscript wurde erfolgreich bearbeitet!';


    public function showAction() {

        $id = $this->params()->fromRoute('id', null);


        $service = $this->getServiceLocator()->get(C::SERVICE_INFOSCRIPT);

        $infoscript = null;

        if($id){
            $infoscript =  $service->getByUserId($id);
        } else {
            $infoscript = $service->fetchAll();
        }

        $actionUrls = [
            'details' => $this->url()->fromRoute(self::ROUTE, ['controller' => self::CONTROLLER, 'action' => self::ACTION_DETAILS]),
            'create'  => $this->url()->fromRoute(self::ROUTE, ['controller' => self::CONTROLLER, 'action' => self::ACTION_CREATE]),
            'edit'    => $this->url()->fromRoute(self::ROUTE, ['controller' => self::CONTROLLER, 'action' => self::ACTION_EDIT]),
            'delete'  => $this->url()->fromRoute(self::ROUTE, ['controller' => self::CONTROLLER, 'action' => self::ACTION_DELETE]),
        ];

        $viewModel = new ViewModel(
        [
            'actionUrls' => $actionUrls,

            'messages'   => $this->flashMessenger(),

            'current'    => new Filter\Current($infoscript),
            'outdated'   => new Filter\Outdated($infoscript),
            'future'     => new Filter\Future($infoscript),
            'inactive'   => new Filter\Inactive($infoscript),
        ]);

        return $viewModel;
    }

    public function createAction() {

        $service = $this->getServiceLocator()->get(C::SERVICE_INFOSCRIPT);
        $form    = $this->getServiceLocator()->get(C::SERVICE_FORM_INFOSCRIPT);

        $infoscript = $service->createInfoscriptFromForm($form, $this->getRequest());

        if (!$infoscript) {
            return new ViewModel(['form' => $form]);
        }

        $service->save($infoscript);

        $this->flashMessenger()->addSuccessMessage(self::MESSAGE_CREATE_SUCCESS);
        return $this->redirect()->toRoute(self::ROUTE,
        [
            'controller' => self::CONTROLLER,
            'action'     => self::ACTION_SHOW
        ]);
    }

    public function editAction() {

        $id = $this->params()->fromRoute('id', null);

        if(!$id) {
            return $this->redirect()->toRoute(self::ROUTE,
            [
                'controller' => self::CONTROLLER,
                'action'     => self::ACTION_INDEX
            ]);
        }

        $service  = $this->getServiceLocator()->get(C::SERVICE_INFOSCRIPT);
        $original = $service->getById($id);

        $form = $this->getServiceLocator()->get(C::SERVICE_FORM_INFOSCRIPT);
        $form->bind($original);

        $changed = $service->createInfoscriptFromForm($form, $this->getRequest());

        if (!$changed) {
            $viewModel = new ViewModel(['form' => $form]);

            return $viewModel->setTemplate('/base/infoscript/edit');
        }

        $service->save($changed);

        $this->flashMessenger()->addSuccessMessage(self::FLASHMESSENGER_EDIT_SUCCESS);
        return $this->redirect()->toRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DETAILS, 'id'=>$changed->getInseratId()));
    }

    public function deleteAction() {

        $id = $this->params()->fromRoute('id', null);

        if (!$id) {
            return $this->redirect()->toRoute(self::ROUTE, ['controller' => self::CONTROLLER, 'action' => self::ACTION_INDEX]);
        }

        $infoscript = $this->getServiceLocator()->get(C::SERVICE_MAPPER_INFOSCRIPT)->getById($id);

        if(!$this->getRequest()->isPost()) {

            $viewModel = new ViewModel (
            [
                'form'       => $this->getServiceLocator()->get(C::SERVICE_FORM_DELETE),
                'id'         => $id,
                'formAction' => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DELETE, 'id' => $id)),
                'infoscript' => $infoscript,
            ]);

            return $viewModel;
        }

        $this->getServiceLocator()->get(C::SERVICE_INFOSCRIPT)->delete($infoscript, $this->getRequest(), $this->flashMessenger());

        return $this->redirect()->toRoute(self::ROUTE, ['controller' => self::CONTROLLER, 'action' => self::ACTION_INDEX]);
}

    public function detailsAction() {

        $id = (int) $this->params('id', null);

        if(!$id){
            return $this->redirect()->toRoute(self::ROUTE, ['controller' => self::CONTROLLER, 'action' => self::ACTION_INDEX]);
        }

        $infoscript  = $this->getServiceLocator()->get(C::SERVICE_INFOSCRIPT)->getById($id);

        $bildschirmResultSet = $this->getServiceLocator()->get(C::SERVICE_TABLE_BILDSCHIRM)->fetchAll();

        //ResultSet to Array
        $bildschirme = [];
        foreach ($bildschirmResultSet as $bildschirm) {
            array_push($bildschirme, $bildschirm);
        }
        //End ResultSet to Array

        /**
         * array
         */
        $addBildschirme = array_diff($bildschirme, $infoscript->getBildschirme());

        $actionUrls =
        [
            'delete' => $this->url()->fromRoute(self::ROUTE, ['controller' => self::CONTROLLER, 'action' => self::ACTION_DELETE_DISPLAY]),
            'add'    => $this->url()->fromRoute(self::ROUTE, ['controller' => self::CONTROLLER, 'action' => self::ACTION_ADD_DISPLAY]),
        ];

        $viewModel = new ViewModel(
        [
            'infoscript'  => $infoscript,
            'bildschirme' => $addBildschirme,

            'actionUrls'  => $actionUrls,

            'messages'   => $this->flashMessenger(),
        ]);

        return $viewModel->setTemplate('/base/infoscript/details.phtml');
    }

    //:TODO Auslagern in eigenen Display- Controller
    public function deleteFromDisplayAction(){

        $inseratId    = (int) $this->params('id', null);
        $bildschirmId = (int) $this->params('display', null);

        if (!($inseratId && $bildschirmId)) {

            return $this->redirect()->toRoute(self::ROUTE,
            [
                'controller' => self::CONTROLLER,
                'action' => self::ACTION_INDEX,
            ]);
        }

        $this->getServiceLocator()->get(C::SERVICE_DISPLAYLINK)->delete($inseratId, $bildschirmId);

        $this->flashMessenger()->addSuccessMessage('Bildschirm erfolgreich entfernt!');

        return $this->redirect()->toRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DETAILS, 'id' => $inseratId));
    }

    public function addToDisplayAction(){

        $inseratId    = (int) $this->params('id', null);
        $bildschirmId = (int) $this->params('display', null);

        if (!($inseratId && $bildschirmId)) {
            return $this->redirect()->toRoute(self::ROUTE,
            [
                'controller' => self::CONTROLLER,
                'action' => self::ACTION_INDEX,
            ]);
        }

        $this->getServiceLocator()->get(C::SERVICE_DISPLAYLINK)->add($inseratId, $bildschirmId);

        $this->flashMessenger()->addSuccessMessage('Bildschirm erfolgreich hinzugefügt');

        return $this->redirect()->toRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DETAILS, 'id' => $inseratId));
    }
    //ENDTODO
}
