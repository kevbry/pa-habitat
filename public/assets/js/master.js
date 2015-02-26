$(document).ready(function(){
    //Was a default title attribute for a hint, don't think we need anymore, but too close to release
    //so it's staying in for now.
    $('#namehelp').attr("title", "Changing this will move the hour row into another project's hours.");
    
    $('#addhours').click(function(e){
        e.preventDefault();
        var existingRow = $('.formrow:last-of-type');

        var template = document.getElementById('rowtemplate').innerHTML;
        console.log(template);
        var newRow = existingRow.after(template);

        $('body').on('click', '.remove', function(e) {
            e.preventDefault();
            var row = $(this).closest('.formrow');
            var allRows = $('.formrow');
            if (allRows.size() > 1)
            {
                row.remove();
            }
        });
    });

    $('.remove').click(function(e) {
        e.preventDefault();
        var row = $(this).closest('.formrow');
        var allRows = $('.formrow');
        if (allRows.size() > 1)
        {
            row.remove();
        }
        else
        {
            $('form')[0].reset();
        }

    });
    //Simply removes a row from the edit pages.
    $('.removeEdit').click(function(e) {
        e.preventDefault();
        var row = $(this).closest('.formrow');
        row.remove();
    });
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
