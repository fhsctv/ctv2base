<?php

namespace BaseTest\Model\Hydrator;

use BaseTest\Bootstrap;
use Base\Constants as C;

class InfoscriptTest extends \PHPUnit_Framework_TestCase {
    
    protected $sm;
    
    
    
    protected $hydrator;



    /**
     * wird bei jedem Test aufgerufen
     */
    public function setUp(){
        
        $this->sm = Bootstrap::getServiceManager();
        $this->hydrator = $this->sm->get(C::SERVICE_HYDRATOR_MODEL_INFOSCRIPT);
        
    }
    
    /**
     * 
     */
    public function testHydrate(){
        
        $data = array(
            C::INFO_ID      => 1,
            C::INFO_USER_ID => 22,
            C::INFO_URL_ID  => 333,
            C::URL_ADRESSE  => 'http://adresse.loc',
            C::URL_AKTIV    => 1,
            C::URL_START    => '2013-01-01',
            C::URL_ENDE     => '2013-01-22',
        );
        
        $urlDep = $this->sm->get(C::SERVICE_ENTITY_URL);
        
        $urlDep->setAdresse('http://adresse.loc')->setAktiv(1)
                ->setStart('2013-01-01')->setEnde('2013-01-22');
        
        $expected = $this->sm->get(C::SERVICE_ENTITY_INFOSCRIPT);
        $expected->setId(1)->setUserId(22)->setUrlId(333)->setUrl($urlDep);
        
        $result = $this->hydrator->hydrate($data, $this->sm->get(C::SERVICE_ENTITY_INFOSCRIPT));
        
        $this->assertEquals($expected, $result);
        $this->assertNotSame($expected, $result);
        
        $this->assertEquals($expected->getUrl(), $result->getUrl());
        $this->assertNotSame($result->getUrl(), $urlDep);
    }

    public function testExtract(){
        
        $urlDep = $this->sm->get(C::SERVICE_ENTITY_URL);
        $urlDep->setAdresse('http://adresse2.loc')->setAktiv(0)
                ->setStart('2013-02-01')->setEnde('2013-03-22');
        
        
        $obj = $this->sm->get(C::SERVICE_ENTITY_INFOSCRIPT);
        $obj->setId(666)->setUserId(55)->setUrlId(4)->setUrl($urlDep);
        
        $expected = array(
            C::INFO_ID      => 666,
            C::INFO_USER_ID => 55,
            C::INFO_URL_ID  => 4,
            C::URL_TABLE => $urlDep,
        );
        
        $result = $this->hydrator->extract($obj);
        
        $this->assertEquals($expected, $result);
        $this->assertSame($obj->getUrl(), $expected[C::URL_TABLE]);
        
    }
    
    public function testResultSet(){
        
        
        $data1 = array(
            C::INFO_ID      => 1,
            C::INFO_USER_ID => 22,
            C::INFO_URL_ID  => 333,
            C::URL_ADRESSE  => 'http://adresse.loc',
            C::URL_AKTIV    => 1,
            C::URL_START    => '2013-01-01',
            C::URL_ENDE     => '2013-01-22',
        );
        
        $urlDep1 = $this->sm->get(C::SERVICE_ENTITY_URL);
        $urlDep1->setAdresse('http://adresse.loc')->setAktiv(1)->setStart('2013-01-01')->setEnde('2013-01-22');
        
        $expected1 = $this->sm->get(C::SERVICE_ENTITY_INFOSCRIPT);
        $expected1->setId(1)->setUserId(22)->setUrlId(333)->setUrl($urlDep1);
        
        
        
        $data2 = array(
            C::INFO_ID      => 999,
            C::INFO_USER_ID => 88,
            C::INFO_URL_ID  => 7,
            C::URL_ADRESSE  => 'http://debug.loc',
            C::URL_AKTIV    => 0,
            C::URL_START    => '2010-12-30',
            C::URL_ENDE     => '2010-10-01',
        );
        
        $urlDep2 = $this->sm->get(C::SERVICE_ENTITY_URL);
        $urlDep2->setAdresse('http://debug.loc')->setAktiv(0)->setStart('2010-12-30')->setEnde('2010-10-01');
        
        $expected2 = $this->sm->get(C::SERVICE_ENTITY_INFOSCRIPT);
        $expected2->setId(999)->setUserId(88)->setUrlId(7)->setUrl($urlDep2);
        
        
        $dataArray = array($data1, $data2);
        
        
        $result1 = $this->hydrator->hydrate($data1, $this->sm->get(C::SERVICE_ENTITY_INFOSCRIPT));
        $result2 = $this->hydrator->hydrate($data2, $this->sm->get(C::SERVICE_ENTITY_INFOSCRIPT));
        
        
        $resultSet = new \Zend\Db\ResultSet\HydratingResultSet($this->hydrator, $this->sm->get(C::SERVICE_ENTITY_INFOSCRIPT));
        $resultSet->initialize($dataArray);
        $resultSet->buffer();
        
        $this->assertEquals($result1,   $resultSet->current());
        $this->assertNotSame($result1,  $resultSet->current());
        $this->assertEquals($expected1, $resultSet->current());
        $this->assertEquals($expected1, $resultSet->current());
        
        $resultSet->next();
        
        $this->assertEquals($result2,   $resultSet->current());
        $this->assertNotSame($result2,  $resultSet->current());
        $this->assertEquals($expected2, $resultSet->current());
        $this->assertNotSame($expected2, $resultSet->current());
        
        
        
    }



    
}