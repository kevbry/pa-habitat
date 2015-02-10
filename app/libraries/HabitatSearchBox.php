<?php
// TODO - Dynamic URLs                                                  -- Done
// TODO - Stack multiple engines on one search
// TODO - Remove calls from Build, put on page                          -- Done
// TODO - Make having an id not break things                            -- Done?


/**
 * PHP wrapper class for coding a twitter/typeahead search box.  This class
 * takes the necessary parameters from the programmer and builds the javascript
 * file 
 *
 * @author cst222
 */
class HabitatSearchBox 
{
    const VIEW_DETAILS_ON_CLICK = 'function(obj, data) {window.location = "%s" + data.value;}';
    
    private static $searchBoxes = array();
    private $searchName;
    private $placeholderText;
    private $bloodHoundEngines = array();
    private $typeAheadConfig;
    private $datumFormatTemplate = '{value: result.id, name: result.id}';
    private $pageURL = '';
    
    /**
     * 
     * @param String $searchName        unique identifier for the searchbox
     * @param String $placeholderText   text to display in the search field
     */
    function __construct($pageURL, $searchName, $placeholderText="Search...") 
    {
        $this->searchName = $searchName;
        $this->placeholderText = $placeholderText;
        $this->pageURL = $pageURL;
        
        // Store the searchbox in an array of all created searchboxes
        HabitatSearchBox::$searchBoxes[$this->searchName] = $this;
    }
    

    /**
     * Purpose: Create a new engine to grab results from the database
     * @param type $engineName
     * @param type $apiURL
     * @param type $resultsLimit
     */
    public function configureEngine($engineName, $apiURL, $displayName='Results',
            $resultsLimit = '10')
    {
        
        $dataURL = $this->pageURL . $apiURL;
        
        $this->bloodHoundEngines[$engineName]['engine'] = <<<EOT
            var %s = new Bloodhound({
                datumTokenizer: function(data) { return Bloodhound.tokenizers.whitespace(data.value) },
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
        
    }
    
    public function configureOnClickEvent($function)
    {
        $this->onClick = $function;
    }
    
    /**
     * 
     * @param string $hint
     * @param string $highlight determines whether or not matched items are
     *      highlighted in bold
     * @param string $minLength The minimum number of characters before the 
     *      search functionality triggers
     */
    public function configureSettings($hint = "true", $highlight = "true", $minLength = "1")
    {
        //TODO: Abstract out all of the hardcoded values to allow configuration
        //TODO: Create object for each search engine being inserted (loop through)
        $this->typeAheadConfig = <<<EOT
            $( "%s" + " .typeahead").typeahead({
                hint: %s,
                highlight: %s,
                minLength: %s
            },
                %s
            ).on('typeahead:selected', %s);        
EOT;

        $this->typeAheadConfig = sprintf($this->typeAheadConfig, 
                '', 
                $hint, 
                $highlight, 
                $minLength, 
                $this->bindEnginesToSearch(), 
                $this->onClick);

    }
    

    private function bindEnginesToSearch()
    {
        $engineCode = "";
        
        $engineConfigTemplate = <<<EOT
        {
            name: '%s',
            displayKey: 'name',
            source: %s.ttAdapter(),
            templates: {header: '<h4>' + '%s' +'</h4>'}
        }
EOT;

        foreach ($this->bloodHoundEngines as $engineName => $engine) 
        {
            $engineCode .= sprintf($engineConfigTemplate, $engine['display_name'], $engineName, $engine['display_name']);
            
            //$enghineCode .= ',';
        }

        return $engineCode;
    }
    
    
    /**
     * Purpose: Display the search control on the page
     */
    public function show()
    {
        echo "<input id='$this->searchName' class='form-control typeahead' type='text' placeholder='$this->placeholderText'>";
    }
    
    /**
     * Purpose: 
     */
    public function build()
    {
        $engines = "";
        // TODO: Build array of search engines to be placed in the script
        foreach($this->bloodHoundEngines as $currEngine)
        {
            $engines .= $currEngine['engine'];
        }
        $scriptBlock = <<<EOT
        <script type='text/javascript'>
            $(function()
            {
                %s
                
                %s
            });</script>
EOT;
        
        
        printf($scriptBlock, $engines, $this->typeAheadConfig);
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
        $this->datumFormatTemplate = sprintf('{value: result.%s, name: result.%s}', $value, $name);
    }
}
