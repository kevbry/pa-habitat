$(document).ready(function(){
    
    
    document.getElementById('editFamily').style.display = 'none';
    document.getElementById('changeFamButton').style.padding = '10px 0px 0px 0px';  

   $('.changeFam').click(function(e) {

       e.preventDefault();

        document.getElementById('familySet').style.display = 'none';
        document.getElementById('editFamily').style.display = 'block';
        document.getElementById('changeFamButton').style.display = 'none'; 
    });

   $('.cancelChange').click(function(e) {

        e.preventDefault();
       document.getElementById('familySet').style.display = 'block';
        document.getElementById('editFamily').style.display = 'none';
        document.getElementById('changeFamButton').style.display = 'block'; 
       
    });
    
    
    
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

    $('.removeEdit').click(function(e) {
        e.preventDefault();
        var row = $(this).closest('.formrow');
        row.remove();
    });

    if ($('.formrow').length === 0)
    {
        $('#submitEdit').remove();
    }
    
    $('.hint').hover(function(e){
        $(e.currentTarget).children('.hiddenHint').css("display", "block");
    }
    , function(e){
        $(e.currentTarget).children('.hiddenHint').css("display", "none");
    });
    
    
    
    
});
