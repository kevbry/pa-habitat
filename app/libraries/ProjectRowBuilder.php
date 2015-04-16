<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataRowBuiler
 *
 * @author cst224
 */
class ProjectRowBuilder extends DataRowBuilder
{   
    //Template for the volunteer select control.
    const VOLUNTEER_SELECT_CONTROL_TEMPLATE = <<<EOT
            <select name="volunteer_id[%s]" class="form-control">
                <option value="0">--</option>
                %s
            </select>
            <div class="inputError">
                %s
            </div>
EOT;
    //Template for the project ID control.
    const PROJECT_ID_CONTROL_TEMPLATE = <<<EOT
        <input id='project_id[]' name='project_id[%s]' type='hidden' value='%s'></input>
        <input readonly="readonly" name="project_name" class="form-control volunteer_id" value="%s" />
EOT;
    
    private $errorList;
    private $controlIndex;
    private $projectID;
    private $projectName;
    private $volunteers;
    private $families;
    private $selectedDataArray;
    /**
     * Constructor to build the RowBuilder, inherits from DataRowBuilder.
     * @param type $projectID
     * @param type $projectName
     * @param type $volunteers
     * @param type $families
     * @param type $errorList
     * @param type $controlIndex
     * @param type $selectedDataArray
     */
    public function __construct($projectID, $projectName, $volunteers, $families, $errorList, $controlIndex, $selectedDataArray) 
    {
        parent::__construct($projectID, $projectName, $volunteers, $families, $errorList, $controlIndex, $selectedDataArray);
        $this->projectID = $projectID;
        $this->projectName = $projectName;
        $this->volunteers = $volunteers;
        $this->families = $families;
        $this->controlIndex = $controlIndex;
        $this->errorList = $errorList;
        $this->selectedDataArray = $selectedDataArray;
    }
    /**
     * Compiles the row.
     * @return type
     */
    public function compileRow()
    {
        $rowTemplate = <<<EOT
            <tr class="formrow">
                <td>
                    %s
                </td>  
                <td>
                    %s
                </td>
                <td>
                    %s
                </td>
                <td>
                    %s
                </td>
                <td>
                    %s
                </td>
                <td>
                    %s
                </td>
                <td>
                    <a href="#" name="[%s]" class="remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                </td>
            </tr>    
EOT;
                //Building all of the templates. with specified values
        $projectIDControl = sprintf(self::PROJECT_ID_CONTROL_TEMPLATE, $this->controlIndex, $this->projectID,$this->projectName);

        $hoursControl = $this->buildControl(parent::HOURS_INPUT_CONTROL_TEMPLATE, 'hours');
        $dateControl = $this->buildControl(parent::CONTRIBUTION_DATE_CONTROL_TEMPLATE, 'date of contribution');
        $hoursTypeControl = $this->buildControl(parent::HOURS_TYPE_CONTROL_TEMPLATE, 'paid hours');
        $volunteerIDControl = $this->buildSelectControl(self::VOLUNTEER_SELECT_CONTROL_TEMPLATE, $this->buildOptionList($this->volunteers, 'volunteer_id'), 'volunteer id');
        $familiesControl = $this->buildSelectControl(parent::FAMILY_SELECT_CONTROL_TEMPLATE, $this->buildOptionList($this->families, 'family_id'), 'family id');
        
        // Update selected Values
        if (!empty($this->selectedDataArray))
        {
            // Hours control
            $hoursValue = $this->selectedDataArray['hours'];
            $hoursControl = $this->replaceDefaultValueWithSelected('value="0"',"value='$hoursValue'", $hoursControl);
            
            // Date control
            $dateValue = $this->selectedDataArray['date_of_contribution'];
            $dateControl = $this->replaceDefaultValueWithSelected('value=""', "value='$dateValue'", $dateControl);
            
            // Hours Type control
            $hoursTypeValue = $this->selectedDataArray['paid_hours'];
            $hoursTypeControl = $this->replaceDefaultValueWithSelected("value='$hoursTypeValue'", "value='$hoursTypeValue' selected", $hoursTypeControl);
        }
        
        return sprintf($rowTemplate, $volunteerIDControl, $hoursControl, $dateControl, $hoursTypeControl, $projectIDControl, $familiesControl, $this->controlIndex);

    }
    
    /**
     * Replaces the default values of the select boxes when passed back
     */
    public function replaceDefaultValueWithSelected($needle, $replacement, $haystack)
    {
        return str_replace($needle, $replacement, $haystack);
    }
    /**
     * Builds the volunteer select control, with specified values below
     * @param type $volunteerID
     * @param type $volunteerName
     * @return type
     */
    public function buildVolunteerSelectControl($volunteerID, $volunteerName)
    {   
        return sprintf(self::VOLUNTEER_ID_CONTROL_TEMPLATE, $volunteerID, $volunteerName);
    }
    /**
     * Builds the regular input controls with specified values below
     * @param type $stringTemplate
     * @param type $controlName
     * @return type
     */           
    public function buildControl($stringTemplate, $controlName)
    {
        return sprintf($stringTemplate, $this->controlIndex, $this->outputErrorMessageFor("$controlName." . $this->controlIndex));
    }
    /**
     * Builds the regular select controls with specified values
     * @param type $stringTemplate
     * @param type $optionsList
     * @param type $controlName
     * @return type
     */
    public function buildSelectControl($stringTemplate, $optionsList, $controlName)
    {
        return sprintf($stringTemplate, $this->controlIndex, $optionsList, $this->outputErrorMessageFor("$controlName." . $this->controlIndex));
        
    }
    /**
     * Builds the option lists for the select boxes, based on the specified values below.
     * @param type $arrayData
     * @param type $controlName
     * @return type
     */
    public function buildOptionList($arrayData, $controlName)
    {
        $optionsTemplate = "<option value='%s'%s>%s</option>";
        $returnString = "";
        
        if (!empty($arrayData))
        {
            foreach ($arrayData as $optionData) 
            {
                $selectedIndex = "";
                
                if (!empty($this->selectedDataArray))
                {
                    $selectedIndex = ($optionData->id == $this->selectedDataArray[$controlName]) ? " selected" : "";
                }
                if(strpos($controlName, "volunteer") === FALSE)
                {
                    $returnString .= sprintf($optionsTemplate, $optionData->id, $selectedIndex, $optionData->name);
                }
                else
                {
                    $returnString .= sprintf($optionsTemplate, $optionData->id, $selectedIndex, 
                            $optionData->first_name . ' ' . $optionData->last_name);
                }

            }
        }
        
        return $returnString;
    }
    
    /**
     * Builds the error messages for each of the controls, based on values below.
     * @param type $controlName
     * @return type
     */
    public function outputErrorMessageFor($controlName)
    {
        return (! empty($this->errorList[$controlName])) ? $this->errorList[$controlName] : "";
    }
}
