$(function()
{


   contactSearch.initialize();
    
//    controlName;  // unique identifier
//    searchName;   // English name of searchbox
//    searchEngine; // Bloodhound Object
//    displayKey;   // What information should populate the search field
//    onSelect;     // anonymous function for behaviour on click
    
    
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
    
    function searchBox()
    {
        console.log("test");
    }
});

