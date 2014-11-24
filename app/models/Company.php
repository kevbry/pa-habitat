<?php
use Contact;
/**
 * Description of Company
 *
 * @author cst217
 */
class Company extends \Eloquent implements Contact
{
    //put your code here
    protected $table = 'company';
    
    
    
    protected $fillable = array('first_name', 
                                'last_name', 
                                'email_address',
                                'home_phone', 
                                'cell_phone', 
                                'work_phone', 
                                'street_address', 
                                'city', 
                                'province', 
                                'postal_code', 
                                'country', 
                                'comments');
}