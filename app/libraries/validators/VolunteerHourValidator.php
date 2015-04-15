<?php namespace App\Libraries\Validators;

/**
 * Description of Contact
 *
 * @author cst224
 */
class VolunteerHourValidator extends Validator {

    public static $rules = array();
    
    //a constructor, to use for validating arrays.
    public function __construct($input = NULL, $rowcount = 0) {
        //base array that will have all the fields in it ex. hours.0 hours.1
        $arrayInput = array();
        $arrayIndexes = array();
        //if input isn't empty, we add it to the array
        if(!empty($input) && $input != NULL)
        {   
            $rowcount = count($input);
            
            //for each input array, add the fields appended with their number.
            $i = 0;
            foreach($input as $rowInput)
            {
                $i = $rowInput['id'];
                
                $arrayInput['volunteer_id.' . $i] = $rowInput['volunteer_id'];
                $arrayInput['hours.' . $i] = $rowInput['hours'];
                $arrayInput['date_of_contribution.' . $i] = $rowInput['date_of_contribution'];
                $arrayInput['project_id.' . $i] = $rowInput['project_id'];
                $arrayInput['paid_hours.' . $i] = $rowInput['paid_hours'];
                $arrayInput['family_id.' . $i] = $rowInput['family_id'];
                
                array_push($arrayIndexes, $i);
            }

            //unset the base names of the array, not needed.
            unset($arrayInput['volunteer_id']);
            unset($arrayInput['hours']);
            unset($arrayInput['date_of_contribution']);
            unset($arrayInput['project_id']);
            unset($arrayInput['paid_hours']);
            unset($arrayInput['family_id']);
        }
        
        //call the parent constructor
        parent::__construct($arrayInput);

        
        //for each row, add rules for that row, ex required and whatever we need.
        //This is exactly like the normal rules array for the thing.
        for($i = 0; $i < $rowcount; $i++)
        {
            static::$rules['volunteer_id.' . $arrayIndexes[$i]] = 'required';
            static::$rules['hours.' . $arrayIndexes[$i]] = 'required|integer|between:1,24';
            static::$rules['date_of_contribution.' . $arrayIndexes[$i]] = 'required|safetymeetingdate';
            static::$rules['project_id.' . $arrayIndexes[$i]] = 'required';
            static::$rules['paid_hours.' . $arrayIndexes[$i]] = '';
            static::$rules['family_id.' . $arrayIndexes[$i]] = '';
        }
    }
}