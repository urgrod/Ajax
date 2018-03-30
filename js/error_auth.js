var url = document.location.href;
var error;

/*
Affichage des erreurs selon le type d'erreur renvoye par le php
code d'erreur 3 -> pas de login ou mot de passe de saisis
code d'erreur 2 -> saisis d'un mauvais login
code d'erreur 1 -> saisis d'un mauvais mot de passe
*/

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
