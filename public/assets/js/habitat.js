$(document).ready(function(){
    $('#namehelp').attr("title", "Changing this will move the hour row into another project's hours.");
    
    $('#addhours').click(function(e){
        e.preventDefault();
        var existingRow = $('.formrow:last-of-type');
        
        var template = document.getElementById('rowtemplate').innerHTML;
        console.log(template);
        var newRow = existingRow.after(template);
        
        $('body').on('click','.remove',function(e){
            e.preventDefault();
            var row = $(this).closest('.formrow');
            var allRows = $('.formrow');
            if (allRows.size() > 1)
            {
                row.remove();
            }
        });
    });
    
    $('.remove').click(function(e){
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
    
    $('.removeEdit').click(function(e){
        e.preventDefault();
        var row = $(this).closest('.formrow');
        row.remove();
    });
     
    if($('.formrow').length === 0)
    {
        $('#submitEdit').remove();
    }
});
