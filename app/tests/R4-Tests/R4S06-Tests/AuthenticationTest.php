<?php
 
class AuthenticationTest extends TestCase 
{
    /**
     * Test Index
     */
    public function testCreate()
    {
      $this->call('GET', 'login');

      $this->assertResponseOk();
    }
    
    /**
     * Test Store failure
     */
    public function testStoreFailure()
    {
      Auth::shouldReceive('attempt')->andReturn(false);

      $this->call('POST', 'login');

      $this->assertRedirectedToRoute('session.create');
      $this->assertSessionHas('flash');
    } 

    /**
     * Test Store success
     */
    public function testStoreSuccess()
    {
        //user has to exist in database for this test to pass
        $userinput = [
            'username' => 'asdf',
            'password' => 'e456b34v6wse4t6we4vt'
        ];
        
      Auth::shouldReceive('attempt')->andReturn(true);

      $this->call('POST', 'login', $userinput);

      $this->assertRedirectedTo('/');
    }
    
    public function tearDown() 
    {
        parent::tearDown();
        Mockery::close();
    }
    
}


