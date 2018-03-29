<?php

//affichage du formulaire d'author

//si auth ok --> index.html
//si auth non ok --> on boucle avec infos comme quoi mdp ou login pas bon
$error = '';
$loginSaisi ='';
$mdpSaisi = '';

if(isset($_POST["login"]) && isset($_POST["password"])){
  include 'database.php';

  dbConnect();

  try{
    $loginSaisi = $_POST["login"];
    $mdpSaisi = $_POST["password"];

    $request = "SELECT password FROM users WHERE login =:loginSaisi"
    $query = $db->prepare($request);
    $query->bindParam(":loginSaisi", $id, PDO::PARAM_INT);

    $query->execute();

    $row = $query->fetchAll(PDO::FETCH_ASSOC);

    $mdpSaisiChiffre = sha1($mdpSaisi);

    if($mdpSaisiChiffre == $row["password"]){
      header('Location: /index.html');
      exit();
    }
    else{
      $error .= '<div class="alert alert-danger">
      <strong>Erreur!</strong> Vous n\'avez pas saisis le bon mot de passe.
      </div>'

    }
  }
  catch{
    $error .= '<div class="alert alert-danger">
    <strong>Erreur!</strong> Vous n\'avez pas saisis le bon login.
    </div>'

  }
}else{
  $error .= '<div class="alert alert-danger">
  <strong>Erreur!</strong> Vous n\'avez pas saisis de login ou de mot de passe.
  </div>'
}




?>
