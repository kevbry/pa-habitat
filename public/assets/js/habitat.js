$(document).ready(function() {



    $('#addhours').click(function(e) {
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



    document.getElementById('editFamily').style.display = 'none';
    document.getElementById('changeFamButton').style.padding = '10px 0px 0px 0px';
    document.getElementById('cancelFamChange').style.padding = '10px 0px 0px 0px';
    document.getElementById('cancelFamChange').style.display = 'none';

    $('.changeFam').click(function(e) {

        e.preventDefault();

        document.getElementById('familySet').style.display = 'none';
        document.getElementById('editFamily').style.display = 'block';
        document.getElementById('changeFamButton').style.display = 'none';
        document.getElementById('cancelFamChange').style.display = 'block';
    });

    $('.cancelChange').click(function(e) {

        e.preventDefault();
        document.getElementById('familySet').style.display = 'block';
        document.getElementById('editFamily').style.display = 'none';
        $('#editFamily').remove();
        document.getElementById('changeFamButton').style.display = 'block';
        document.getElementById('cancelFamChange').style.display = 'none';
    });
});
