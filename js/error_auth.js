
console.log(document.location.href);

var url = document.location.href;
var error;

if (url.indexOf("error=3") != -1) {


  error = "<div class='alert alert-danger'>"+
  "<strong>Erreur!</strong> Vous n'avez pas saisis de login ou de mot de passe."+
  "</div>";
  $('#errors').html(error);

} else {
  if (url.indexOf("error=2") != -1) {


    error = "<div class='alert alert-danger'>"+
    "<strong>Erreur!</strong> Vous n'avez pas saisis le bon login."+
    "</div>";
    $('#errors').html(error);



  } else {
    if (url.indexOf("error=1") != -1) {


      error = "<div class='alert alert-danger'>"+
      "<strong>Erreur!</strong> Vous n'avez pas saisis le bon de mot de passe."+
      "</div>";
      $('#errors').html(error);

    }
  }
}
