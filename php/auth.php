<?php

$error = '';
$loginSaisi ='';
$mdpSaisi = '';

if(isset($_POST["login"]) && isset($_POST["password"])){
  include 'database.php';

  $loginSaisi = $_POST["login"];
  // var_dump($loginSaisi);
  $mdpSaisi = $_POST["password"];
  $longueur = '';

  $db = dbConnect();

  $request = "SELECT login,password FROM users WHERE login = :loginSaisi";
  $statement = $db->prepare($request);
  $statement->bindParam(":loginSaisi", $loginSaisi, PDO::PARAM_INT);

  $statement->execute();

  // var_dump($statement);


  $result = $statement->fetch(PDO::FETCH_ASSOC);

  $longueur = sizeof($result);

  // var_dump($result);


  if($loginSaisi == $result['login']){

    $mdpSaisiChiffre = sha1($mdpSaisi);

    if($mdpSaisiChiffre == $result["password"]){
      header('Location: ../index_gallerie.html?login='.$loginSaisi.'');
      setCookie("login", $loginSaisi);
      exit();


    }
    else{
      $error .= '<div class="alert alert-danger">
      <strong>Erreur!</strong> Vous n\'avez pas saisis le bon mot de passe.
      </div>';

      header('Location: ../index.html?error=3');


    }//else mdp
  }
  //fin if login saisi
  else{

    header('Location: ../index.html?error=2');


  }//fin else login saisi
}
else{

  header('Location: ../index.html?error=1');

}//fin else verif post


?>
