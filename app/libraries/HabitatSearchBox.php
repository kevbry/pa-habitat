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
    private static $searchBoxes = array();
    private $searchName;
    private $placeholderText;
    private $bloodHoundEngines = array();
    private $typeAheadConfig;
    private $datumFormatTemplate;
    
    
    function __construct($searchName, $placeholderText="") 
    {
        $this->searchName = $searchName;
        $this->placeholderText = $placeholderText;
        array_push(HabitatSearchBox::$searchBoxes, $this);
    }
    

    /**
     * Purpose: Builds code for creating the Bloodhound Suggestion Engine
     * @param type $engineName
     * @param type $dataURL
     * @param type $dataFormat
     */
    public function configureEngine($engineName = 'contactSearch', 
            $dataURL = 'http://kelcstu06/~cst230/habitat/public/search/searchContacts')
    {
        //TODO: Separate out the hard-coded stuff for flexibility
        $this->bloodHoundEngines[$engineName] = <<<EOT
            var %s = new Bloodhound({
                datumTokenizer: function(data) { return Bloodhound.tokenizers.whitespace(data.value)},
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                limit: 10,
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
        $this->bloodHoundEngines[$engineName] = sprintf($this->bloodHoundEngines[$engineName], 
                $engineName, $dataURL, $this->datumFormatTemplate, $engineName);
        
    }
    
    /**
     * 
     * @param string $hint
     * @param string $highlight determines whether or not matched items are
     *      highlighted in bold
     * @param string $minLength The minimum number of characters before the 
     *      search functionality triggers
     */
    public function configureSettings($hint = "false", $highlight = "false", $minLength = "3")
    {
        //TODO: Abstract out all of the hardcoded values to allow configuration
        //TODO: Create object for each search engine being inserted (loop through)
        $this->typeAheadConfig = <<<EOT
            controlName = '';
            searchName = "Contacts";
            searchEngine = contactSearch;
            displayKey = 'name';
            onSelect = function(obj, data) {window.location = "http://kelcstu06/~cst230/habitat/public/contact/" + data.value;};
    
            $( controlName + " .typeahead").typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            },
            {
                name: searchName,
                displayKey: displayKey,
                source: searchEngine.ttAdapter(),
                templates: {header: '<h4>' + searchName +'</h4>'}
            }).on('typeahead:selected', onSelect);        
EOT;
    }
    
    /**
     * Purpose: Display the search control on the page
     */
    public function show()
    {
        echo "<input id='$this->searchName' class='typeahead' type='text' placeholder='$this->placeholderText'>";
    }
    
    /**
     * Purpose: 
     */
    public function build()
    {
        $this->searchFor();
        $this->configureSettings();
        $engines = "";
        // TODO: Build array of search engines to be placed in the script
        foreach($this->bloodHoundEngines as $currEngine)
        {
            $engines .= $currEngine;
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
