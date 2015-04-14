<?php namespace App\Libraries\Validators;

/**
 * Description of Contact
 *
 * @author cst224
 */
class ProjectHourValidator extends Validator {

    public static $rules = array();
    
    //a constructor, to use for validating arrays.
    public function __construct($input = NULL, $rowcount = 0) {
        //base array that will have all the fields in it ex. hours.0 hours.1
        $arrayInput = array();
        
        //if input isn't empty, we add it to the array
        if(!empty($input) && $input != NULL)
        {   
            $rowcount = count($input);
//            var_dump($input);
//            die;
            //for each input array, add the fields appended with their number.
            $i = 0;
            
            foreach($input as $rowInput)
            {
                $arrayInput['volunteer_id.' . $i] = $rowInput['volunteer_id'];
                $arrayInput['hours.' . $i] = $rowInput['hours'];
                $arrayInput['date_of_contribution.' . $i] = $rowInput['date_of_contribution'];
                $arrayInput['project_id.' . $i] = $rowInput['project_id'];
                $arrayInput['paid_hours.' . $i] = $rowInput['paid_hours'];
                $arrayInput['family_id.' . $i++] = $rowInput['family_id'];
            }
            
//            for($i = 0; $i < $rowcount; $i++)
//            {
//                $arrayInput['volunteer_id.' . $i] = $input[$i]['volunteer_id'];
//                $arrayInput['hours.' . $i] = $input[$i]['hours'];
//                $arrayInput['date_of_contribution.' . $i] = $input[$i]['date_of_contribution'];
//                $arrayInput['project_id.' . $i] = $input[$i]['project_id'];
//                $arrayInput['paid_hours.' . $i] = $input[$i]['paid_hours'];
//                $arrayInput['family_id.' . $i] = $input[$i]['family_id'];
//            }

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
            static::$rules['volunteer_id.' . $i] = '';
            static::$rules['hours.' . $i] = 'required|integer|between:1,24';
            static::$rules['date_of_contribution.' . $i] = 'required|safetymeetingdate';
            static::$rules['project_id.' . $i] = 'required';
            static::$rules['paid_hours.' . $i] = '';
            static::$rules['family_id.' . $i] = '';
        }
    }
}