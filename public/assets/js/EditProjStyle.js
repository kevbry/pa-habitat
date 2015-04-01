
$(document).ready(function() {



    document.getElementById('edit').style.display = 'none';
    document.getElementById('changeButton').style.padding = '10px 0px 0px 0px';

    $('.change').click(function(e) {

        e.preventDefault();

        document.getElementById('oldData').style.display = 'none';
        document.getElementById('edit').style.display = 'block';
        document.getElementById('changeButton').style.display = 'none';
    });


});
