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
        $this->testSearchBox = new HabitatSearchBox("testsearch", "Search...");
        
    }
    
    public function testConfigureEngine()
    {
        $engineName = "contactSearch";
        $dataURL = 'http://kelcstu06/~cst230/habitat/public/search/searchContacts';
        $dataFormat = 'value: contact.id, name: contact.first_name + " " + contact.last_name}';
        $success = $this->testSearchBox->configureEngine($engineName, $dataURL);
        $this->assertTrue($success);
    }
    
    public function testConfigureSettings()
    {
        $hint = "true";
        $highlight = "true";
        $minLength = "3";
        
        $success = $this->testSearchBox->configureSettings($hint, $highlight, $minLength);
        $this->assertTrue($success);
    }
    
    public function testShow()
    {
        $success = $this->testSearchBox->show();
        $this->assertTrue($success);
    }
    
    public function testBuild()
    {
        $success = $this->testSearchBox->build();
        $this->assertTrue($success);
    }
}
