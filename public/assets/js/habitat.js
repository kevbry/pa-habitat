$(document).ready(function(){
    $('#addhours').click(function(e){
        e.preventDefault();
        var hourRow = $('.hourrow:last-of-type');
        hourRow.clone().insertAfter(hourRow);
        
        $('body').on('click','.remove',function(e){
            e.preventDefault();
            var row = $(this).closest('.hourrow');
            row.remove();
        });
    });
    
    $('.remove').click(function(e){
        e.preventDefault();
        var row = $(this).closest('.hourrow');
        row.remove();
    });
});
