$(function(){                            var findFamily = new Bloodhound({
                datumTokenizer: function(data) { return Bloodhound.tokenizers.whitespace(data.value); },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                limit: 10,
                remote: {
                    url: "http://kelcstu06/~cst211/habitat/public/search/searchFamilies?families=%QUERY%",
                    filter: function(list)
                    {
                        return $.map(list, function(result){return {value: result.id, name: result.name, type: result.type};});
                    }
                }
            });
                
            findFamily.initialize();

                
                $( "#family-search" + " .typeahead").typeahead({
                hint: true,
                highlight: true,
                minLength: 3
            },
                        {
            name: 'Family',
            displayKey: 'name',
            source: findFamily.ttAdapter(),
            templates: {
                empty: "<p class='error'>No matches found</p>",
                header: '<h4>' + 'Family' +'</h4>'
                }
        }
            ).on('typeahead:selected',             
    function(obj, data)
        {
            postKey = "family";
            
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
);

                            var contactSearch = new Bloodhound({
                datumTokenizer: function(data) { return Bloodhound.tokenizers.whitespace(data.value); },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                limit: 10,
                remote: {
                    url: "http://kelcstu06/~cst211/habitat/public/search/searchContacts?contacts=%QUERY%",
                    filter: function(list)
                    {
                        return $.map(list, function(result){return {value: result.id, name: result.name, type: result.type};});
                    }
                }
            });
                
            contactSearch.initialize();
            var volunteerSearch = new Bloodhound({
                datumTokenizer: function(data) { return Bloodhound.tokenizers.whitespace(data.value); },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                limit: 10,
                remote: {
                    url: "http://kelcstu06/~cst211/habitat/public/search/searchVolunteers?volunteers=%QUERY%",
                    filter: function(list)
                    {
                        return $.map(list, function(result){return {value: result.id, name: result.name, type: result.type};});
                    }
                }
            });
                
            volunteerSearch.initialize();
            var projectSearch = new Bloodhound({
                datumTokenizer: function(data) { return Bloodhound.tokenizers.whitespace(data.value); },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                limit: 10,
                remote: {
                    url: "http://kelcstu06/~cst211/habitat/public/search/searchProjects?projects=%QUERY%",
                    filter: function(list)
                    {
                        return $.map(list, function(result){return {value: result.id, name: result.name, type: result.type};});
                    }
                }
            });
                
            projectSearch.initialize();
            var familySearch = new Bloodhound({
                datumTokenizer: function(data) { return Bloodhound.tokenizers.whitespace(data.value); },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                limit: 10,
                remote: {
                    url: "http://kelcstu06/~cst211/habitat/public/search/searchFamilies?families=%QUERY%",
                    filter: function(list)
                    {
                        return $.map(list, function(result){return {value: result.id, name: result.name, type: result.type};});
                    }
                }
            });
                
            familySearch.initialize();
            var companySearch = new Bloodhound({
                datumTokenizer: function(data) { return Bloodhound.tokenizers.whitespace(data.value); },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                limit: 10,
                remote: {
                    url: "http://kelcstu06/~cst211/habitat/public/search/searchCompanies?companies=%QUERY%",
                    filter: function(list)
                    {
                        return $.map(list, function(result){return {value: result.id, name: result.name, type: result.type};});
                    }
                }
            });
                
            companySearch.initialize();

                
                $( "#master-search" + " .typeahead").typeahead({
                hint: true,
                highlight: true,
                minLength: 3
            },
                        {
            name: 'Contacts',
            displayKey: 'name',
            source: contactSearch.ttAdapter(),
            templates: {
                empty: "<p class='error'>No matches found</p>",
                header: '<h4>' + 'Contacts' +'</h4>'
                }
        },        {
            name: 'Volunteers',
            displayKey: 'name',
            source: volunteerSearch.ttAdapter(),
            templates: {
                empty: "<p class='error'>No matches found</p>",
                header: '<h4>' + 'Volunteers' +'</h4>'
                }
        },        {
            name: 'Projects',
            displayKey: 'name',
            source: projectSearch.ttAdapter(),
            templates: {
                empty: "<p class='error'>No matches found</p>",
                header: '<h4>' + 'Projects' +'</h4>'
                }
        },        {
            name: 'Families',
            displayKey: 'name',
            source: familySearch.ttAdapter(),
            templates: {
                empty: "<p class='error'>No matches found</p>",
                header: '<h4>' + 'Families' +'</h4>'
                }
        },        {
            name: 'Companies',
            displayKey: 'name',
            source: companySearch.ttAdapter(),
            templates: {
                empty: "<p class='error'>No matches found</p>",
                header: '<h4>' + 'Companies' +'</h4>'
                }
        }
            ).on('typeahead:selected', function(obj, data) {window.location = "http://kelcstu06/~cst211/habitat/public/" + data.type + "/" + data.value;});

 });