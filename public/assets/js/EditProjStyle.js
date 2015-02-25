
$(document).ready(function() {



    document.getElementById('editFamily').style.display = 'none';
    document.getElementById('changeFamButton').style.padding = '10px 0px 0px 0px';

    $('.changeFam').click(function(e) {

        e.preventDefault();

        document.getElementById('familySet').style.display = 'none';
        document.getElementById('editFamily').style.display = 'block';
        document.getElementById('changeFamButton').style.display = 'none';
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
