<?php
 
use Mockery as m;
use App\Libraries\Validators\ContactValidator;
 
class ValidateContactTest extends TestCase {
 
  /**
   *  @expectedException Exception
   */
  public function testValidatorThrowsExceptionOnWrongDependency()
  {
    $validator = new ContactValidator( new StdClass() );
  }
 
  /**
   *  @expectedException Exception
   */
  public function testWithMethodThrowsExceptionIfNotArray()
  {
    $validator = new ContactValidator( m::mock('Illuminate\Validation\Factory') );
 
    $validator->with( 'first name' );
  }
 
  /**
   *  @expectedException Exception
   */
  public function testPassesMethodThrowsExceptionIfNotArray()
  {
    $validator = new ContactValidator( m::mock('Illuminate\Validation\Factory') );
 
    $validator->passes( 'first name' );
  }
  public function tearDown()
  {
    m::close();
  }
}