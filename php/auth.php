<?php
$loginSaisi ='';
$mdpSaisi = '';

/*
Verification si les champs ne sont pas vies, si les mots de passes sont identiques puis si le login existe bien en base
*/

if(isset($_POST["login"]) || isset($_POST["password"])){
  include 'database.php';

  $loginSaisi = $_POST["login"];
  $mdpSaisi = $_POST["password"];
  $longueur = '';

  $db = dbConnect();

  $request = "SELECT login,password FROM users WHERE login = :loginSaisi";
  $statement = $db->prepare($request);
  $statement->bindParam(":loginSaisi", $loginSaisi, PDO::PARAM_INT);

  $statement->execute();



  $result = $statement->fetch(PDO::FETCH_ASSOC);

  $longueur = sizeof($result);



  if($loginSaisi == $result['login']){

    $mdpSaisiChiffre = sha1($mdpSaisi);

    if($mdpSaisiChiffre == $result["password"]){
      header('Location: ../index_gallerie.html?login='.$loginSaisi.'');
      exit();


    }
    else{
      header('Location: ../index.html?error=3');


    }//else mdp
  }
  else{

    header('Location: ../index.html?error=2');


  }//fin else login saisi
}
else{

  header('Location: ../index.html?error=1');

}//fin else verif post


?>
