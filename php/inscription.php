<?php

$error = '';
$loginSaisi ='';
$mdpSaisi = '';
$mdpSaisi2 ='';

if(isset($_POST["login"]) && isset($_POST["password1"]) && isset($_POST["password2"])){
  include 'database.php';

  $loginSaisi = $_POST["login"];
  $mdpSaisi = $_POST["password1"];
  $mdpSaisi2 = $_POST["password2"];

  $longueur = '';

  $db = dbConnect();

  if ($mdpSaisi === $mdpSaisi2) {

    $request = "INSERT INTO users (login, password) VALUES (:login, :password);";
    $statement = $db->prepare($request);
    $statement->bindParam(":login", $loginSaisi, PDO::PARAM_INT);
    $statement->bindParam(":password", $mdpSaisi, PDO::PARAM_INT);

    $statement->execute();

    header('Location: ../index_gallerie.html?login='.$loginSaisi.'');

  }else {
    header('Location: ../index.html?error=4');
  }


?>
