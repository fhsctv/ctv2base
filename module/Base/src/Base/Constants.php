<?php

namespace Base;

class Constants {


    //==========================================================================
    //=============================== DB TABLES  ===============================
    //==========================================================================

    const DB_TBL_USER                           = 'user';
    const DB_PK_USER                            = 'user_id';

    const DB_TBL_USER_ROLE                      = 'user_role';
    const DB_PK_USER_ROLE                       = 'role_id';

    const DB_TBL_USER_ROLE_LINKER               = 'user_role_linker';


    const DB_TBL_FACHHOCHSCHULE                 = 'fachhochschule';
    const DB_PK_FACHHOCHSCHULE                  = 'user_id';
    const DB_FK_FACHHOCHSCHULE_USER             = 'user_id';

    //---------------


    const DB_TBL_INSERAT                        = 'inserat';
    const DB_PK_INSERAT                         = 'inserat_id';

    const DB_TBL_INFOSCRIPT                     = 'infoscript';
    const DB_PK_INFOSCRIPT                      = 'inserat_id';
    const DB_FK_INFOSCRIPT_FACHHOCHSCHULE       = 'fk_fh_id';
    const DB_FK_INFOSCRIPT_INSERAT              = 'inserat_id';

    const DB_TBL_INFOSCRIPT_COLUMN              = 'infospalte';
    const DB_PK_INFOSCRIPT_COLUMN               = 'id';
    const DB_FK_INFOSCRIPT_COLUMN_INFOSCRIPT    = 'inserat_id';

    const DB_TBL_INFOSCRIPT_PICTURE             = 'infobild';
    const DB_PK_INFOSCRIPT_PICTURE              = 'id';
    const DB_PK_INFOSCRIPT_PICTURE_INFOSCRIPT_COLUMN = 'fk_spalte_id';

    const DB_TBL_BILDSCHIRM                     = 'bildschirm';
    const DB_PK_BILDSCHIRM                      = 'bildschirm_id';


    const DB_TBL_INSERAT_BILDSCHIRM_LINKER      = 'inserat_bildschirm_linker';
    const DB_FK_INSERAT_BILDSCHIRM_LINKER_INSERAT = 'inserat_id';



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
    const SM_ENTITY_INSERAT                     = 'Base\Model\Entity\Inserat';
    const SM_ENTITY_INFOSCRIPT                  = 'Base\Model\Entity\Infoscript';
    const SM_ENTITY_INFOSCRIPT_COLUMN           = 'Base\Model\Entity\Infoscript\Column';
    const SM_ENTITY_BILDSCHIRM                  = 'Base\Model\Entity\Bildschirm';

    const SM_ENTITY_USER                        = 'Base\Model\Entity\User';
    const SM_ENTITY_FACHHOCHSCHULE              = 'Base\Model\Entity\Fachhochschule';

    //-------------------------------------------------------------- DbHydrators
    const SM_HYD_MODEL_INSERAT                  = 'Base\Model\Hydrator\Inserat';
    const SM_HYD_MODEL_INFOSCRIPT               = 'Base\Model\Hydrator\Infoscript';
    const SM_HYD_MODEL_INFOSCRIPT_COLUMN        = 'Base\Model\Hydrator\Infoscript\Column';
    const SM_HYD_MODEL_BILDSCHIRM               = 'Base\Model\Hydrator\Bildschirm';

    const SM_HYD_MODEL_USER                     = 'Base\Model\Hydrator\User';
    const SM_HYD_MODEL_FACHHOCHSCHULE           = 'Base\Model\Hydrator\Fachhochschule';

    //------------------------------------------------------------ TableGateways
    const SM_TGW_INSERAT                        = 'Base\TableGateway\Inserat';
    const SM_TGW_INSERATBILDSCHIRMLINKER        = 'Base\TableGateWay\InseratBilschirmLinker';
    const SM_TGW_INFOSCRIPT                     = 'Base\TableGateway\Infoscript';
    const SM_TGW_INFOSCRIPT_COLUMN              = 'Base\TableGateway\Infoscript\Column';
    const SM_TGW_BILDSCHIRM                     = 'Base\TableGateway\Bildschirm';

    const SM_TGW_USER                           = 'Base\TableGateway\User';
    const SM_TGW_FACHHOCHSCHULE                 = 'Base\TableGateway\Fachhochschule';

    //------------------------------------------------------------------- Tables
    const SM_TBL_INSERAT                        = 'Base\Table\Inserat';
    const SM_TBL_INSERATBILDSCHIRMLINKER        = 'Base\Table\InseratBildschirmLinker';
    const SM_TBL_INFOSCRIPT                     = 'Base\Table\Infoscript';
    const SM_TBL_BILDSCHIRM                     = 'Base\Table\Bildschirm';

    const SM_TBL_USER                           = 'Base\Table\User';
    const SM_TBL_FACHHOCHSCHULE                 = 'Base\Table\Fachhochschule';

    //------------------------------------------------------------------ Mappers
    const SM_MAP_INFOSCRIPT                     = 'Base\Mapper\Infoscript';
    const SM_MAP_FACHHOCHSCHULE                 = 'Base\Mapper\Fachhochschule';

    //-------------------------------------------------------------------- Forms
    const SM_FORM_INFOSCRIPT                    = 'Base\Form\Infoscript';
    const SM_FORM_DELETE                        = 'Base\Form\Delete';

    //----------------------------------------------------------------- Services
    const SERVICE_INFOSCRIPT                    = 'Base\Service\Infoscript';
    const SERVICE_DISPLAYLINK                   = 'Base\Service\DisplayLink';


}

