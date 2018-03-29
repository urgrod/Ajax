<?php

$error = '';
$loginSaisi ='';
$mdpSaisi = '';

if(isset($_POST["login"]) && isset($_POST["password"])){
  include 'database.php';

  $loginSaisi = $_POST["login"];
  $mdpSaisi = $_POST["password"];

  $db = dbConnect();

  $request = "SELECT login,password FROM users WHERE login =:loginSaisi";
  $statement = $db->prepare($request);
  $statement->bindParam(":loginSaisi", $id, PDO::PARAM_INT);

  $statement->execute();

  $result = $statement->fetchAll(PDO::FETCH_ASSOC);

  if($loginSaisi == $result["login"]){

    $mdpSaisiChiffre = sha1($mdpSaisi);

    if($mdpSaisiChiffre == $result["password"]){
      header('Location: ../index_gallerie.html');
      exit();
    }
    else{
      $error .= '<div class="alert alert-danger">
      <strong>Erreur!</strong> Vous n\'avez pas saisis le bon mot de passe.
      </div>';

    }
  }
  else{
    $error .= '<div class="alert alert-danger">
    <strong>Erreur!</strong> Vous n\'avez pas saisis le bon login.
    </div>';

  }
  else{
    $error .= '<div class="alert alert-danger">
    <strong>Erreur!</strong> Vous n\'avez pas saisis de login ou de mot de passe.
    </div>';
  }
}



  ?>
