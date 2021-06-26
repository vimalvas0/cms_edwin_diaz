$(document).ready(function() {
  $('#summernote').summernote({
    'height' : '250px'
  });
});



const toFade = "<div id='load-screen'><div id='loading'></div></div>";

$('body').prepend(toFade);

$('#load-screen').delay(700).fadeOut(600, function(){
  $(this).remove();
});