$(document).ready(function(){
    $('#addhours').click(function(e){
        e.preventDefault();
        var hourRow = $('.hourrow:last-of-type');
        hourRow.clone().insertAfter(hourRow);
        
        $('body').on('click','.remove',function(e){
            e.preventDefault();
            var row = $(this).closest('.hourrow');
            var allRows = $('.hourrow');
            if (allRows.size() > 1)
            {
                row.remove();
            }
        });
    });
    
    $('.remove').click(function(e){
        e.preventDefault();
        var row = $(this).closest('.hourrow');
        var allRows = $('.hourrow');
        if (allRows.size() > 1)
        {
            row.remove();
        }
        else 
        {
            $('form')[0].reset();
        }
        
    });
});
