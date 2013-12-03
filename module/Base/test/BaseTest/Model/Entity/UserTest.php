<?php

namespace BaseTest\Model\Entity;

use BaseTest\Bootstrap;
use Base\Constants as C;

class UserTest extends \PHPUnit_Framework_TestCase {
    
    protected $sm;
    
    protected $entity;
    
    /**
     * wird bei jedem Test aufgerufen
     */
    public function setUp() {
        
        $this->sm = Bootstrap::getServiceManager();
        $this->entity = $this->sm->get(C::SM_ENTITY_INSERAT);
    }
    
    /**
     * Testet, ob eine Entität jedes Mal durch den ServiceManager neu angelegt
     * wird, also mehrere Instanzen möglich sind.
     */
    public function testNotShared(){
        
        $firstEntity  = $this->entity;
        $secondEntity = $this->sm->get(C::SM_ENTITY_INSERAT);
        
        $this->assertSame($this->entity, $firstEntity);
        $this->assertNotSame($firstEntity, $secondEntity);
        
        $this->markTestIncomplete();
    }
    
    /**
     * Testet, ob Daten richtig gesetzt und zurückgegeben werden
     */
    public function testGetterSetter(){
        
        $this->entity
        ->setInseratId(11)
        ->setStart('2013-12-11')
        ->setEnde('2014-12-14')
        ->setUrl('http://www.url.loc')
        ->setAktiv(1);
        
        
        $this->assertEquals(11,                   $this->entity->getInseratId());
        $this->assertEquals('2013-12-11',         $this->entity->getStart());
        $this->assertEquals('2014-12-14',         $this->entity->getEnde());
        $this->assertEquals('http://www.url.loc', $this->entity->getUrl());
        $this->assertEquals(1,                    $this->entity->getAktiv());
        
        $this->assertTrue(is_array($this->entity->getBildschirme()));
        
        $this->markTestIncomplete('add Bildschirm not tested');
        
        $this->markTestIncomplete();
    }
    
    /**
     * Testet, ob Zahlen zu Integern konvertiert werden.
     */
    public function testSetterConvertNumbersToInt(){
        
        $this->entity->setInseratId('11');
        $this->entity->setAktiv('1');
        
        $this->assertTrue(is_int($this->entity->getInseratId()), 'getInseratId() muss sein Argument in ein Integer konvertieren!');
        $this->assertTrue(is_int($this->entity->getAktiv()), 'getAktiv() muss sein Argument in ein Integer konvertieren!');
        
        $this->markTestIncomplete();
    }
    
    /**
     * Testet, ob die Setter ihre eigene Instanz wieder zurückgeben.
     * Damit sind verkettete Aufrufe der Setter möglich;
     */
    public function testFluidInterfaceSetter() {
        
        $class = '\Base\Model\Entity\Inserat';
        
        $this->assertInstanceOf($class, $this->entity->setInseratId(11));
        $this->assertInstanceOf($class, $this->entity->setStart('2013-12-11'));
        $this->assertInstanceOf($class, $this->entity->setEnde('2014-12-14'));
        $this->assertInstanceOf($class, $this->entity->setUrl('http://www.url.loc'));
        $this->assertInstanceOf($class, $this->entity->setAktiv(1));
        $this->assertInstanceOf($class, $this->entity->addBildschirm(1));
        $this->assertInstanceOf($class, $this->entity->setBildschirme([]));
        
        $this->markTestIncomplete();
    }
    
}
