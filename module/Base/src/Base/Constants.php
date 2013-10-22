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
    const INFO_FORM_ID   = 'infoscript';
    const ANZEIGE_FORM_ID   = 'anzeige';
    const URL_FORM_ID    = 'url';
    
    //--------------------------------------------------------------------------
    const SERVICE_ENTITY_INFOSCRIPT         = 'Base\Model\Entity\Infoscript';
    const SERVICE_ENTITY_ANZEIGE            = 'Base\Model\Entity\Anzeige';
    const SERVICE_ENTITY_URL                = 'Base\Model\Entity\Url';
    
    const SERVICE_HYDRATOR_MODEL_INFOSCRIPT = 'Base\Model\Hydrator\Infoscript';
    const SERVICE_HYDRATOR_MODEL_ANZEIGE    = 'Base\Model\Hydrator\Anzeige';
    const SERVICE_HYDRATOR_MODEL_URL        = 'Base\Model\Hydrator\Url';
    
    const SERVICE_TABLEGATEWAY_INFOSCRIPT   = 'Base\TableGateway\Infoscript';
    const SERVICE_TABLEGATEWAY_ANZEIGE      = 'Base\TableGateway\Anzeige';
    const SERVICE_TABLEGATEWAY_URL          = 'Base\TableGateway\Url';
    
    const SERVICE_TABLE_INFOSCRIPT          = 'Base\Table\Infoscript';
    const SERVICE_TABLE_ANZEIGE             = 'Base\Table\Anzeige';
    const SERVICE_TABLE_URL                 = 'Base\Table\Url';
    
    const SERVICE_MAPPER_INFOSCRIPT        = 'Base\Mapper\Infoscript';
    const SERVICE_MAPPER_ANZEIGE           = 'Base\Mapper\Anzeige';
    
    const SERVICE_FORM_INFOSCRIPT           = 'Base\Form\Infoscript';
    const SERVICE_FORM_ANZEIGE              = 'Base\Form\Anzeige';
    const SERVICE_FORM_DELETE               = 'Base\Form\Delete';
    
    const SERVICE_INFOSCRIPT               = 'Base\Service\Infoscript';
    const SERVICE_ANZEIGE                  = 'Base\Service\Anzeige';
    
    
}

