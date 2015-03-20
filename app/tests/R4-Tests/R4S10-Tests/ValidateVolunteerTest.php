<?php
 
use Mockery as m;
use App\Libraries\Validators\ContactValidator;
 
class ValidateVolunteerTest extends TestCase {
 
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
 
    $validator->with( 'Last Attended Safety Meeting' );
  }
 
  /**
   *  @expectedException Exception
   */
  public function testPassesMethodThrowsExceptionIfNotArray()
  {
    $validator = new ContactValidator( m::mock('Illuminate\Validation\Factory') );
 
    $validator->passes( 'Last Attended Safety Meeting' );
  }
  public function tearDown()
  {
    m::close();
  }
}