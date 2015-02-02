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
    public function searchFor(/*$engineName, $dataURL, $dataFormat*/)
    {
        //TODO: Separate out the hard-coded stuff for flexibility
        $this->bloodHoundEngines[0] = <<<EOT
            var contactSearch = new Bloodhound({
                datumTokenizer: function(data) { return Bloodhound.tokenizers.whitespace(data.value)},
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                limit: 10,
                remote: {
                    url: 'http://kelcstu06/~cst222/habitat/public/search/searchContacts',
                    filter: function(list)
                    {
                        return $.map(list, function(contact){return {value: contact.id, name: contact.first_name + " " + contact.last_name};});
                    }
                }
            });
                
            contactSearch.initialize();
EOT;
        
        // Add code to array of data sources
    }
    
    public function configureSettings()
    {
        //TODO: Abstract out all of the hardcoded values to allow configuration
        //TODO: Create object for each search engine being inserted (loop through)
        $this->typeAheadConfig = <<<EOT
            controlName = '';
            searchName = "Contacts";
            searchEngine = contactSearch;
            displayKey = 'name';
            onSelect = function(obj, data) {window.location = "http://kelcstu06/~cst222/habitat/public/contact/" + data.value;};
    
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
        
        // TODO: Build array of search engines to be placed in the script
        
        $scriptBlock = <<<EOT
        "<script type='text/javascript'>
            $(function()
            {
                %s
                
                %s
            });</script>"
EOT;
        
        
        printf($scriptBlock, $this->bloodHoundEngines[0], $this->typeAheadConfig);
    }
}
