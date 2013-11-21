<?php

namespace Base;

class Constants {
    
    
    //--------------------------------------------------------------------------
    const INFO_TABLE     = 'infoscript';
    const INFO_ID        = 'id';
    const INFO_URL_ID    = 'fk_url_id';
    const INFO_USER_ID   = 'fk_user_id';

    const ANZEIGE_TABLE     = 'anzeige';
    const ANZEIGE_ID        = 'id';
    const ANZEIGE_URL_ID    = 'fk_url_id';
    const ANZEIGE_USER_ID   = 'fk_user_id';
    
    const URL_TABLE      = 'url';
    const URL_ID         = 'id';
    const URL_ADRESSE    = 'adresse';
    const URL_START      = 'start';
    const URL_ENDE       = 'ende';
    const URL_AKTIV      = 'aktiv';
    const URL_DEPENDENCY = 'dependency';
    
    
    
    
    //--------------------------------------------------------------------------
    const INFO_FORM_ID      = 'infoscript';
    const ANZEIGE_FORM_ID   = 'anzeige';
    const URL_FORM_ID       = 'url';
    
    //==========================================================================
    //============================ Service Manager =============================
    //==========================================================================
    
    //----------------------------------------------------------------- Entities
    const SERVICE_ENTITY_INSERAT            = 'Base\Model\Entity\Inserat';
    const SERVICE_ENTITY_INFOSCRIPT         = 'Base\Model\Entity\Infoscript';
    const SERVICE_ENTITY_BILDSCHIRM         = 'Base\Model\Entity\Bildschirm';
    
    const SM_ENTITY_USER                    = 'Base\Model\Entity\User';
    
    //-------------------------------------------------------------- DbHydrators
    const SERVICE_HYDRATOR_MODEL_INSERAT    = 'Base\Model\Hydrator\Inserat';
    const SERVICE_HYDRATOR_MODEL_INFOSCRIPT = 'Base\Model\Hydrator\Infoscript';
    const SERVICE_HYDRATOR_MODEL_BILDSCHIRM = 'Base\Model\Hydrator\Bildschirm';
    
    const SM_HYDRATOR_MODEL_USER            = 'Base\Model\Hydrator\User';
    
    //------------------------------------------------------------ TableGateways
    const SERVICE_TABLEGATEWAY_INSERAT      = 'Base\TableGateway\Inserat';
    const SERVICE_TABLEGATEWAY_INSERATBILDSCHIRMLINKER = 'Base\TableGateWay\InseratBilschirmLinker';
    const SERVICE_TABLEGATEWAY_INFOSCRIPT   = 'Base\TableGateway\Infoscript';
    const SERVICE_TABLEGATEWAY_BILDSCHIRM   = 'Base\TableGateway\Bildschirm';
    
    const SM_TABLEGATEWAY_USER              = 'Base\TableGateway\User';
    
    //------------------------------------------------------------------- Tables
    const SERVICE_TABLE_INSERAT             = 'Base\Table\Inserat';
    const SERVICE_TABLE_INSERATBILDSCHIRMLINKER             = 'Base\Table\InseratBildschirmLinker';
    const SERVICE_TABLE_INFOSCRIPT          = 'Base\Table\Infoscript';
    const SERVICE_TABLE_BILDSCHIRM          = 'Base\Table\Bildschirm';
    
    const SM_TABLE_USER                     = 'Base\Table\User';
    
    //------------------------------------------------------------------ Mappers
    const SERVICE_MAPPER_INFOSCRIPT         = 'Base\Mapper\Infoscript';
    
    //-------------------------------------------------------------------- Forms
    const SERVICE_FORM_INFOSCRIPT           = 'Base\Form\Infoscript';
    const SERVICE_FORM_DELETE               = 'Base\Form\Delete';
    
    //----------------------------------------------------------------- Services
    const SERVICE_INFOSCRIPT                = 'Base\Service\Infoscript';
    
    
}

