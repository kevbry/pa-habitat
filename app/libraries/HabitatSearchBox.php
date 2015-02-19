<?php

/**
 * PHP wrapper class for coding a twitter/typeahead search box.  This class
 * takes the necessary parameters from the programmer and builds the javascript
 * file 
 *
 * @author cst222
 */
class HabitatSearchBox 
{
    
    // Links to the search contoller methods that fetch information from the db
    const SEARCH_CONTACT_URL = "search/searchContacts?contacts=%QUERY%";
    const SEARCH_VOLUNTEER_URL = "search/searchVolunteers?volunteers=%QUERY%";
    const SEARCH_PROJECT_URL = "search/searchProjects?projects=%QUERY%";
    const SEARCH_FAMILY_URL = "search/searchFamilies?families=%QUERY%";
    const SEARCH_COMPANY_URL = "search/searchCompanies?companies=%QUERY%";
    
    // Javascript function templates for different onClick behaviour of a search box
    
    /**
     * Description: redirects to a details page for the item selected
     * 
     * @param %s -> Base site url
     */
    const VIEW_DETAILS_ON_CLICK = 'function(obj, data) {window.location = "%s" + data.type + "/" + data.value;}';
    
    /**
     * Description: Selects an object's value and adds it as a form control to be passed to the server
     * 
     * @param %s -> the key name for the value to pass across
     */
    const SELECT_ID_ON_CLICK = <<<EOT
            
    function(obj, data)
        {
            postKey = "%s";
            
            inputID = postKey + "_val";
            
            if ($('#' + inputID).length == 0)
            {
                $('<input>')
                    .attr('id', inputID)
                    .attr('type','hidden')
                    .attr('name', postKey)
                    .attr('value', data.value)
                    .appendTo('form');
            }
            else
            {
                $('#' + inputID).attr('value', data.value);
            }
        }

EOT;
    
    // Container array for all search boxes
    public static $searchBoxes = array();
    
    // Class properties
    private $searchID;
    private $placeholderText;
    private $bloodHoundEngines = array();
    private $typeAheadConfig;
    private $datumFormatTemplate = '{value: result.id, name: result.id, type: result.type}';
    private $pageURL = '';
    private $onClick;
    
    /**
     * @param String $pageURL           root page url
     * @param String $searchName        unique identifier for the searchbox
     * @param String $placeholderText   text to display in the search field
     */
    function __construct($pageURL, $searchName, $placeholderText="Search...") 
    {
        $this->searchID = $searchName;
        $this->placeholderText = $placeholderText;
        $this->pageURL = $pageURL;

    }
    

    /**
     * Purpose: Create a new engine to grab results from the database
     * @param string $engineName        unique identifier for a single selection engine
     * @param string $apiURL            link to the remote information
     * @param string $resultsLimit      maximum number of results to return
     */
    public function configureEngine($engineName, $apiURL, $displayName='Results',
            $resultsLimit = '10')
    {
        // Build the link to the remote information
        $dataURL = $this->pageURL . $apiURL;
        
        $this->bloodHoundEngines[$engineName]['engine'] = <<<EOT
            var %s = new Bloodhound({
                datumTokenizer: function(data) { return Bloodhound.tokenizers.whitespace(data.value); },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                limit: %s,
                remote: {
                    url: "%s",
                    filter: function(list)
                    {
                        return $.map(list, function(result){return %s;});
                    }
                }
            });
                
            %s.initialize();

EOT;
        // Add code to array of data sources
        $this->bloodHoundEngines[$engineName]['display_name'] = $displayName;
        $this->bloodHoundEngines[$engineName]['engine'] = sprintf($this->bloodHoundEngines[$engineName]['engine'], 
                $engineName, $resultsLimit, $dataURL, $this->datumFormatTemplate, $engineName);
        
        // Return this object for function chaining
        return $this;
    }
    
    public function configureOnClickEvent($function)
    {
        $this->onClick = $function;
        
        // Return this object for function chaining
        return $this;
    }
    
    /**
     * 
     * @param string $hint
     * @param string $highlight determines whether or not matched items are
     *      highlighted in bold
     * @param string $minLength The minimum number of characters before the 
     *      search functionality triggers
     */
    public function configureSettings($hint = "true", $highlight = "true", $minLength = "3")
    {
        //TODO: Abstract out all of the hardcoded values to allow configuration
        //TODO: Create object for each search engine being inserted (loop through)
        $this->typeAheadConfig = <<<EOT
$( "#%s" + " .typeahead").typeahead({
                hint: %s,
                highlight: %s,
                minLength: %s
            },
                %s
            ).on('typeahead:selected', %s);


EOT;

        $this->typeAheadConfig = sprintf($this->typeAheadConfig, 
                $this->searchID, 
                $hint, 
                $highlight, 
                $minLength, 
                $this->bindEnginesToSearch(), 
                $this->onClick);
        
        // Return this object for function chaining
        return $this;

    }
    

    private function bindEnginesToSearch()
    {
        $engineCode = "";
        
        $engineConfigTemplate = <<<EOT
        {
            name: '%s',
            displayKey: 'name',
            source: %s.ttAdapter(),
            templates: {
                empty: "<p class='error'>No matches found</p>",
                header: '<h4>' + '%s' +'</h4>'
                }
        }
EOT;

        $count = 0;
        
        foreach ($this->bloodHoundEngines as $engineName => $engine) 
        {
            $engineCode .= sprintf($engineConfigTemplate, $engine['display_name'], $engineName, $engine['display_name']);
            
            if (++$count < count($this->bloodHoundEngines))
            {
                $engineCode .= ',';
            }
        }

        return $engineCode;
    }
    
    
    /**
     * Purpose: Display the search control on the page
     */
    public function show()
    {
        echo "<div id='$this->searchID'><input class='form-control typeahead' type='text' placeholder='$this->placeholderText'></div>";
        
        return true;
    }
    
    /**
     * Purpose: 
     */
    public function build()
    {
        $engines = "";

        foreach($this->bloodHoundEngines as $currEngine)
        {
            $engines .= $currEngine['engine'];
        }
        $scriptBlock = <<<EOT
                %s
                
                %s
EOT;
        
        $code = sprintf($scriptBlock, $engines, $this->typeAheadConfig);

        array_push(HabitatSearchBox::$searchBoxes, $code);

        return true;
    }
    
    /**
     * 
     * @param string $value The singular value which is referenced when the search item is clicked.
     * @param string $name The display value that is shown when search items are
     *      displayed. If multiple fields are to be displayed, they must be retrieved
     *      as a single column of the query that retreives them.
     */
    public function configureDatumFormat($value, $name)
    {
        $this->datumFormatTemplate = sprintf('{value: result.%s, name: result.%s, type: result.type}', $value, $name);
        
        // Return this object for function chaining
        return $this;
    }
    
    
    
    public static function buildAll()
    {
        $script =  "<script type='text/javascript'>$(function(){";
       
       foreach (HabitatSearchBox::$searchBoxes as $searchBox) 
       {
           $script .= $searchBox;
       }

       $script .= " });</script>";
       
       // This would build the script to a javascript file. (unable to do so in this dev environment)
       //file_put_contents($fileName, $script);
       
       print($script);
    }
}
