<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HabitatSearchBoxUnitTest
 *
 * @author cst230
 */
class HabitatSearchBoxUnitTest extends TestCase
{
    private $testSearchBox;
    
    public function setUp() 
    {
        parent::setUp();
        $this->testSearchBox = new HabitatSearchBox("http://kelcstu06/~cst222/public/", "testsearch", "Test Search...");
        
    }
    
    
    public function testConfigureEngine()
    {
        $testEngineName = 'TestSearch';
        $testapiURL = 'http://kelcstu06/~cst230/habitat/public/search/searchTestSearch?searchFor=';
        $testDisplayName = 'TestResults';
        $testResultLimit = '5';
        
        $numEngines = $this->testSearchBox->configureEngine($testEngineName, $testapiURL, $testDisplayName, $testResultLimit);
        
        // Assert
        $this->assertNotNull($numEngines);
    }
    
    
    public function testConfigureOnClickEvent()
    {
        $testFunction = 'function(obj, data) {window.location = "%s" + data.type + "/" + data.value;}';
        
        
        $setFunction = $this->testSearchBox->configureOnClickEvent($testFunction);
        
        
        $this->assertNotNull($setFunction);
        
        
    }
    
    public function testConfigureSettings()
    {
        $hint = "true";
        $highlight = "true";
        $minLength = "3";
        
        $success = $this->testSearchBox->configureSettings($hint, $highlight, $minLength);
        
        
        $this->assertNotNull($success);
    }

    public function testConfigureDatumFormat()
    {
        
        $testValue = 'id';
        $testName = 'name';
        
        $format = $this->testSearchBox->configureDatumFormat($testName, $testValue);
        
        $this->assertNotNull($format);
        
    }
    
    
    public function testShow()
    {
        $success = $this->testSearchBox->show();
        $this->assertTrue($success);
    }
    
    public function testBuild()
    {
        $this->testConfigureEngine();
        $this->testConfigureOnClickEvent();
        $this->testConfigureDatumFormat();
        $this->testConfigureSettings();
        
        $success = $this->testSearchBox->build();
        $this->assertTrue($success);
    }
}
