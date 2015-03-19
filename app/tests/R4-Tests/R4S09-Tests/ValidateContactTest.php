<?php
 
use Mockery as m;
use App\Libraries\Validators;
 
class ValidateContactTest extends TestCase {
 
  /**
   *  @expectedException Exception
   */
  public function testValidatorThrowsExceptionOnWrongDependency()
  {
    $validator = new CoreValidator( new StdClass() );
  }
 
  /**
   *  @expectedException Exception
   */
  public function testWithMethodThrowsExceptionIfNotArray()
  {
    $validator = new CoreValidator( m::mock('Illuminate\Validation\Factory') );
 
    $validator->with( 'first name' );
  }
 
  /**
   *  @expectedException Exception
   */
  public function testPassesMethodThrowsExceptionIfNotArray()
  {
    $validator = new CoreValidator( m::mock('Illuminate\Validation\Factory') );
 
    $validator->passes( 'first name' );
  }
  public function tearDown()
  {
    m::close();
  }
}