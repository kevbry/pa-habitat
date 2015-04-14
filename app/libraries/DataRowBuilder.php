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
class DataRowBuilder 
{
    
    const HOURS_INPUT_CONTROL_TEMPLATE = <<<EOT
            <input min="0" class="form-control" name="hours[%s]" type="number" value="0" />
            <div class="inputError">
                %s
            </div>    
EOT;
    
    const CONTRIBUTION_DATE_CONTROL_TEMPLATE = <<<EOT
            <input class="form-control" placeholder="Date" name="date_of_contribution[%s]" type="date" value="" />
                <div class="inputError">
                    %s
                </div>
EOT;
    
    const VOLUNTEER_ID_CONTROL_TEMPLATE = <<<EOT
            <input id='row_id[]' name='volunteer_id' type='hidden' value='%s'></input>
            <input readonly="readonly" name="volunteer_name" class="form-control volunteer_id" value="%s" />

EOT;
    
    const HOURS_TYPE_CONTROL_TEMPLATE = <<<EOT
            <select min="0" class="form-control" name="paid_hours[%s]">
                        <option value='0'>Volunteer</option>
                        <option value='1'>Paid</option>
            </select>
            <div class="inputError">
                %s
            </div>
EOT;
    
    const PROJECT_SELECT_CONTROL_TEMPLATE = <<<EOT
            <select name="project_id[%s]" class="form-control">
                <option value="0">--</option>
                    %s
            </select>
            <div class="inputError">
                %s
            </div>
            
EOT;
    
    const FAMILY_SELECT_CONTROL_TEMPLATE = <<<EOT
            <select name="family_id[%s]" class="form-control">
                <option value="0">--</option>
                %s
            </select>
            <div class="inputError">
                %s
            </div>
EOT;
    
    private $errorList;
    private $controlIndex;
    private $volunteerID;
    private $volunteerName;
    private $projects;
    private $families;
    private $selectedDataArray;
    
    public function __construct($volunteerID, $volunteerName, $projects, $families, $errorList, $controlIndex, $selectedDataArray) 
    {
        $this->errorList = $errorList;
        $this->controlIndex = $controlIndex;
        $this->volunteerID = $volunteerID;
        $this->volunteerName = $volunteerName;
        $this->projects = $projects;
        $this->families = $families;
        $this->selectedDataArray = $selectedDataArray;
    }
    
    
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
       
        $volunteerIDControl = sprintf(self::VOLUNTEER_ID_CONTROL_TEMPLATE, $this->volunteerID, $this->volunteerName);
        $hoursControl = $this->buildControl(self::HOURS_INPUT_CONTROL_TEMPLATE, 'hours');
        $dateControl = $this->buildControl(self::CONTRIBUTION_DATE_CONTROL_TEMPLATE, 'date of contribution');
        $hoursTypeControl = $this->buildControl(self::HOURS_TYPE_CONTROL_TEMPLATE, 'paid hours');
        $projectsControl = $this->buildSelectControl(self::PROJECT_SELECT_CONTROL_TEMPLATE, $this->buildOptionList($this->projects, 'project_id'), 'project id');
        $familiesControl = $this->buildSelectControl(self::FAMILY_SELECT_CONTROL_TEMPLATE, $this->buildOptionList($this->families, 'family_id'), 'family id');
        
        
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
        
        return sprintf($rowTemplate, $volunteerIDControl, $hoursControl, $dateControl, $hoursTypeControl, $projectsControl, $familiesControl, $this->controlIndex);

    }
    
    
    public function replaceDefaultValueWithSelected($needle, $replacement, $haystack)
    {
        return str_replace($needle, $replacement, $haystack);
    }
    
    public function buildVolunteerSelectControl($volunteerID, $volunteerName)
    {   
        return sprintf(self::VOLUNTEER_ID_CONTROL_TEMPLATE, $volunteerID, $volunteerName);
    }
                           
    public function buildControl($stringTemplate, $controlName)
    {
        return sprintf($stringTemplate, $this->controlIndex, $this->outputErrorMessageFor("$controlName." . $this->controlIndex));
    }
    
    public function buildSelectControl($stringTemplate, $optionsList, $controlName)
    {
        return sprintf($stringTemplate, $this->controlIndex, $optionsList, $this->outputErrorMessageFor("$controlName." . $this->controlIndex));
        
    }
    
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
                           
                $returnString .= sprintf($optionsTemplate, $optionData->id, $selectedIndex, $optionData->name);
            }
        }
        
        return $returnString;
    }
    
    
    public function outputErrorMessageFor($controlName)
    {
        return (! empty($this->errorList[$controlName])) ? $this->errorList[$controlName] : "";
    }
}
