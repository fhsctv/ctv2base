<?php

namespace Base;

class Constants {
    
    
    //--------------------------------------------------------------------------
    const INFO_TABLE     = 'infoscript';
    const INFO_ID        = 'id';
    const INFO_URL_ID    = 'fk_url_id';
    const INFO_USER_ID   = 'fk_user_id';
    
    const URL_TABLE      = 'url';
    const URL_ID         = 'id';
    const URL_ADRESSE    = 'adresse';
    const URL_START      = 'start';
    const URL_ENDE       = 'ende';
    const URL_AKTIV      = 'aktiv';
    const URL_DEPENDENCY = 'dependency';
    
    
    
    
    //--------------------------------------------------------------------------
    const INFO_FORM_ID   = 'infoscript';
    const URL_FORM_ID    = 'url';
    
    //--------------------------------------------------------------------------
    const SERVICE_ENTITY_INFOSCRIPT         = 'Base\Model\Entity\Infoscript';
    const SERVICE_ENTITY_URL                = 'Base\Model\Entity\Url';
    
    const SERVICE_HYDRATOR_MODEL_INFOSCRIPT = 'Base\Model\Hydrator\Infoscript';
    const SERVICE_HYDRATOR_MODEL_URL        = 'Base\Model\Hydrator\Url';
    
    const SERVICE_TABLEGATEWAY_INFOSCRIPT   = 'Base\TableGateway\Infoscript';
    const SERVICE_TABLEGATEWAY_URL          = 'Base\TableGateway\Url';
    
    const SERVICE_TABLE_INFOSCRIPT          = 'Base\Table\Infoscript';
    const SERVICE_TABLE_URL                 = 'Base\Table\Url';
    
    const SERVICE_MAPPER_INFOSCRIPT        = 'Base\Mapper\Infoscript';
    
    const SERVICE_FORM_INFOSCRIPT           = 'Base\Form\Infoscript';
    const SERVICE_FORM_DELETE               = 'Base\Form\Delete';
    
    const SERVICE_INFOSCRIPT               = 'Base\Service\Infoscript';
    
    
}

