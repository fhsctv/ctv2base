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
        
        $this->entity->setId(11);
        $this->entity->setUrlId(222);
        $this->entity->setUserId(3333);
        
        $this->assertEquals(11,   $this->entity->getId());
        $this->assertEquals(222,  $this->entity->getUrlId());
        $this->assertEquals(3333, $this->entity->getUserId());
        
    }
    
    public function testSetterConvertNumbersToInt(){
        
        $this->entity->setId('11');
        $this->entity->setUrlId('222');
        $this->entity->setUserId('3333');
        
        $this->assertTrue(is_int($this->entity->getId()), 'getId() muss sein Argument in ein Integer konvertieren!');
        $this->assertTrue(is_int($this->entity->getUrlId()), 'getUrlId() muss sein Argument in ein Integer konvertieren!');
        $this->assertTrue(is_int($this->entity->getUserId()), 'getUserId() muss sein Argument in ein Integer konvertieren!');
        
    }
    
    /**
     * Testet, ob die Setter ihre eigene Instanz wieder zurückgeben.
     * Damit sind verkettete Aufrufe der Setter möglich;
     */
    public function testFluidInterfaceSetter() {
        
        $class = 'Base\Model\Entity\Infoscript';
        
        $this->assertInstanceOf($class, $this->entity->setId(11));
        $this->assertInstanceOf($class, $this->entity->setUrlId(222));
        $this->assertInstanceOf($class, $this->entity->setUserId(3333));
        
    }
    
    /**
     * testet, ob die Setter eine InvalidArgumentException werfen, wenn
     * das Argument keine Zahl ist.
     */
    public function testSetterArgumentsNumericId() {
        
        $message = 'expected InvalidArgumentException was not thrown';
        
        try{
            $this->entity->setId("adsa");
            $this->fail('setId: ' . $message);
        }
        catch(\InvalidArgumentException $e){}

        try{
            $this->entity->setId(null);
            $this->fail('setId: ' . $message);
        }
        catch(\InvalidArgumentException $e){}


        try{
            $this->entity->setUrlId("asd");
            $this->fail('setUrlId: ' . $message);
        }
        catch(\InvalidArgumentException $e){}

        try{
            $this->entity->setUrlId(null);
            $this->fail('setUrlId: ' . $message);
        }
        catch(\InvalidArgumentException $e){}


        try{
            $this->entity->setUserId("asd");
            $this->fail('setUserId: ' . $message);
        }
        catch(\InvalidArgumentException $e){}

        try{
            $this->entity->setUserId(null);
            $this->fail('setUserId: ' . $message);
        }
        catch(\InvalidArgumentException $e){}
            
    }
    
    /**
     * testet, ob getUrl eine UrlEntity liefert und nicht etwas null oder
     * einen string
     */
    public function testGetUrlReturnsUrlEntity(){
        
        $this->assertInstanceOf('Base\Model\Entity\Url', $this->entity->getUrl());
        $this->assertNotNull($this->entity->getUrl());
        
    }
    
    /**
     * Testet ob das Ergebnis von getUrl dieselbe Instanz referenziert wie,
     * das Objekt, das durch setUrl gesetzt wurde.
     */
    public function testGetUrlReturnsSameInstanceAsWasSet(){
        
        $originalUrl = $this->sm->get(C::SERVICE_ENTITY_URL);
        
        $this->entity->setUrl($originalUrl);
        
        $this->assertInstanceOf('Base\Model\Entity\Url', $this->entity->getUrl());
        $this->assertSame($originalUrl, $this->entity->getUrl());
    }
    
    /**
     * Testet ob die Url seine Abhängigkeit beim setzen gleich mitgeteilt wird.
     * Die Url soll wissen, zu welchem Infoscript sie gehört.
     */
    public function testSetUrlSetsInfoscriptAsDependency(){
        
        $url = $this->sm->get(C::SERVICE_ENTITY_URL);
        
        $this->entity->setUrl($url);
        
        $this->assertSame($this->entity, $this->entity->getUrl()->getDependency());
        $this->assertInstanceOf('Base\Model\Entity\Infoscript', $this->entity->getUrl()->getDependency());
        
    }
    
    /**
     * Testet, ob das Infoscript Schnittststellen zum Verwalten seiner Url
     * implementiert.
     */
    public function testExtendsAUrl() {
        
        $this->assertInstanceOf('Base\Model\Entity\AUrl', $this->entity);
        
    }
    
}