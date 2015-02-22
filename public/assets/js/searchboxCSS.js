                
                $( "#primary_1" + " .typeahead").typeahead({
                hint: true,
                highlight: true,
                minLength: 3
            },
                        {
            name: 'Volunteers',
            displayKey: 'name',
            source: volunteerSearch1.ttAdapter(),
            templates: {
                empty: "<p class='error'>No matches found</p>",
                header: '<h4>' + 'Volunteers' +'</h4>'
                }
        }
            ).on('typeahead:selected',             
    function(obj, data)
        {
            if ($('#value').length === 0)
            {
                console.log("Add New");
            }
            else
            {
                console.log("Modify Existing");
            }      
        });