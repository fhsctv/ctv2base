<?php

namespace BaseTest\Model\Entity;

use BaseTest\Bootstrap;
use Base\Constants as C;

class InfoscriptTest extends \PHPUnit_Framework_TestCase {
    
    protected $sm;
    
    protected $entity;
    
    /**
     * wird bei jedem Test aufgerufen
     */
    public function setUp(){
        
        $this->sm = Bootstrap::getServiceManager();
        $this->entity = $this->sm->get(C::SERVICE_ENTITY_INFOSCRIPT);
    }
    
    /**
     * Testet, ob eine Entität jedes Mal durch den ServiceManager neu angelegt
     * wird, also mehrere Instanzen möglich sind.
     */
    public function testNotShared(){
        
        $firstEntity  = $this->entity;
        $secondEntity = $this->sm->get(C::SERVICE_ENTITY_INFOSCRIPT);
        
        $this->assertSame($this->entity, $firstEntity);
        $this->assertNotSame($firstEntity, $secondEntity);
    }
    
    /**
     * Testet, ob Daten richtig gesetzt und zurückgegeben werden
     */
    public function testGetterSetter(){
        
        $this->entity->setTitel('Mein Titel');
        
        $this->assertEquals('Mein Titel', $this->entity->getTitel());
    }
    
    /**
     * Testet, ob Zahlen zu Integern konvertiert werden.
     */
    public function testSetterConvertNumbersToInt(){
        
        $this->markTestSkipped();
    }
    
    /**
     * Testet, ob die Setter ihre eigene Instanz wieder zurückgeben.
     * Damit sind verkettete Aufrufe der Setter möglich;
     */
    public function testFluidInterfaceSetter(){
        
        $class = '\Base\Model\Entity\Infoscript';
        
        $this->assertInstanceOf($class, $this->entity->setTitel('Mein Titel'));
    }
    
    /**
     * Testet, ob die Infoscriptklasse von der Inseratklasse erbt.
     */
    public function testExtendsInseratEntity(){
        
        $class = '\Base\Model\Entity\Inserat';
        
        $this->assertInstanceOf($class, $this->entity);
    }
    
}
