$(document).ready(function($){
    
    $('#addhours').click(function(e){
        e.preventDefault();
        
        // Find the last row in the form
        var existingRow = $('.formrow:last-of-type');
        
        // Create a template row
        var template = document.getElementById('rowtemplate').innerHTML;

        var counter = $('.volunteer_id').length;
        
        // Update all of the new row's indexes
        if(counter !== 1)
        {
            template = template.replace("volunteer_id[1]", "volunteer_id[" + counter + "]");
            template = template.replace("hours[1]", "hours[" + counter + "]");
            template = template.replace("date_of_contribution[1]", "date_of_contribution[" + counter + "]");
            template = template.replace("paid_hours[1]", "paid_hours[" + counter + "]");
            template = template.replace("project_id[1]", "project_id[" + counter + "]");
            template = template.replace("family_id[1]", "family_id[" + counter + "]");
            template = template.replace('name="[1]"', "name='[" + counter + "]'");
        }
        console.log(counter++);
        
        // Add row to form
        var newRow = existingRow.after(template);
    });

    // Attach on click event handlers
    $('body').on('click', '.remove', removeRow);
    $('body').on('click', '.removeEdit', removeRowEdit);

    /**
     * Purpose: Marks a row as deleted in an edit page
     * @param {type} e
     * @returns {undefined}
     */
    function removeRowEdit(e)
    {
        e.preventDefault();
        
        // Find the row to delete
        var row = $(this).closest('.formrow');
        
        console.log(row.find(".hiddenInput"));
        
        // Toggle deleted state for a row already marked as deleted
        if (row.hasClass("deletedrow"))
        {
            //$(".hiddenInput").remove();
            
            // Remove deleted indicator from the row
            row.removeClass("deletedrow");
            
            // Undisable all the row's controls
            $.each(row.find("input, select"), 
            function(){
                $(this).removeAttr("disabled");
            });
            
            // Remove deleted row hidden inputs when marking a row as un-deleted
            $.each(row.find(".hiddenInput"),
            function(){
                $(this).remove();
            });
        }
        else
        {
            // Mark the row as deleted
            row.addClass("deletedrow");

            // For each form control in the row
            $.each(row.find("input, select"), 
            function(){
                
                // Mark all controls but the row_id control as disabled
                if ($(this).attr("id") !== "row_id[]")
                {
                        $(this).attr("disabled", "disabled");

                        // Grab the selected value from the controls
                        var selectedValue = $(this).is("input") ? $(this).attr('value') : $(this).find(":selected").val() ;

                        // Add a hidden field to pass deleted rows to the controller
                        $("<input>").attr({
                                class: 'hiddenInput',
                                type: 'hidden',
                                name: "deleted_" + $(this).attr('name'),
                                value: selectedValue}).insertAfter($(this));
                }
            });                      
        }
    }
    
    /**
     * Remove a row from an Add page
     * @param {type} e
     * @returns {undefined}
     */
    function removeRow(e) {
        e.preventDefault();
        
        // 
        var clearAll = false;
        
        if ($(".btn").html().search("Add") < 0)
        {
            clearAll = true;
        }
        
        var row = $(this).closest('.formrow');
        var allRows = $('.formrow');
        if (allRows.size() > 1 || clearAll)
        {
            // Determine the index of the row to remove
            var startingIndex = $(this).attr('name').match(/\d/)[0];

            // For each form input control
            $.each($('.formrow [name$="]"]'), function()
                {
                    // Find the current row index
                    var curIndex = $(this).attr('name');
                    
                    if ($(this).attr("id") !== "row_id[]")
                    {
                        curIndex = curIndex.match(/\d/)[0];
                    }
                                        
                    // If the current index is greater than the index to remove
                    if (curIndex > startingIndex)
                    {
                        // Decrement the id for rows below the removed row
                        $(this).attr('name', $(this).attr('name').replace(/\d/, curIndex - 1));
                    }
                });
                     
            row.remove();
        }
        else
        {
            $('form')[0].reset();
        }

    }
    
    
    //If there are no rows on the edithours pages
    //Remove the submit button.
    if ($('.formrow').length === 0)
    {
        $('#submitEdit').remove();
    }
    //The hint box needs a hover function
    $('.hint').hover(function(e){
        //When hint is hovered, display the hint inside of it's block.
        $(e.currentTarget).children('.hiddenHint').css("display", "block");
    }
    , function(e){
        //When hint is not-hovered anymore, stop displaying the hint block.
        $(e.currentTarget).children('.hiddenHint').css("display", "none");
    });
});
