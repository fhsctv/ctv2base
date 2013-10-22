<?php

namespace BaseTest\Model\Entity;

use BaseTest\Bootstrap;
use Base\Constants as C;

class UrlTest extends \PHPUnit_Framework_TestCase {
    
    
    protected $sm;
    
    protected $entity;
    

    /**
     * wird bei jedem Test aufgerufen
     */
    public function setUp(){
        
        $this->sm = Bootstrap::getServiceManager();
        $this->entity = $this->sm->get(C::SERVICE_ENTITY_URL);
        
    }
    
    /**
     * Testet, ob eine Entität jedes Mal durch den ServiceManager neu angelegt
     * wird, also mehrere Instanzen möglich sind.
     */
    public function testNotShared(){
        
        $firstEntity  = $this->entity;
        $secondEntity = $this->sm->get(C::SERVICE_ENTITY_URL);
        
        $this->assertSame($this->entity, $firstEntity);
        $this->assertNotSame($firstEntity, $secondEntity);
    }
    
    public function testGetterSetter(){
        
        $infoscript = $this->sm->get('Base\Model\Entity\Infoscript');
        
        $this->entity->setStart('2013-10-21');
        $this->entity->setEnde('2013-10-21');
        $this->entity->setAdresse('http://debug.loc');
        $this->entity->setAktiv(1);
        
        $this->entity->setDependency($infoscript);
        
        $this->assertEquals('2013-10-21', $this->entity->getStart());
        $this->assertEquals('2013-10-21', $this->entity->getEnde());
        $this->assertEquals('http://debug.loc', $this->entity->getAdresse());
        $this->assertEquals(1, $this->entity->getAktiv());
        
        
        $this->assertEquals($infoscript, $this->entity->getDependency());
        $this->assertSame($infoscript, $this->entity->getDependency());
        
        $infoscript->setId(2413);
        $this->assertEquals(2413, $this->entity->getDependency()->getId());
    }
    
}