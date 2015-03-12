
$(document).ready(function() {



    document.getElementById('edit').style.display = 'none';
    document.getElementById('changeButton').style.padding = '10px 0px 0px 0px';

    $('.change').click(function(e) {

        e.preventDefault();

        document.getElementById('set').style.display = 'none';
        document.getElementById('edit').style.display = 'block';
        document.getElementById('changeButton').style.display = 'none';
    });

//   $('.cancelChange').click(function(e) {
//
//        e.preventDefault();
//       document.getElementById('familySet').style.visibility = 'visible';
//        document.getElementById('editFamily').style.visibility = 'none';
//        document.getElementById('changeFamButton').style.display = 'block'; 
//       
//    });

});
