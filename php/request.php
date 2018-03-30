<?php
require_once('database.php');
$db = dbConnect();
if(!$db){
  header('HTTP/1.1 503 Service Unavailable');
  exit;
}
$requestType = $_SERVER['REQUEST_METHOD'];
$request = substr($_SERVER['PATH_INFO'], 1);
$request = explode('/', $request);
$requestRessource = array_shift($request);
$id = array_shift($request);
if($id == '')
$id = NUll;
$data = false;
if ($requestRessource == 'photos'){
  if($id!=NULL) {
    //affichage d'une photo
    $data = dbRequestPhoto($db,intval($id));
  }
  else {
    //affichage de toutes les photos
    $data = dbRequestPhotos($db);
  }
}else if ($requestRessource == 'comments') {
  if ($requestType == 'GET') {
    //affichage de tout les commentaires liees a cette photo
    $data = dbRequestComments($db,$id);
  }
  if ($requestType == "POST"){
    //ajout d'un commentaire saisi par l'utilisateur en base de donnees
    $data = dbAddComment($db,'cir2',$_POST['photoId'],$_POST['text']);
  }
  if($requestType == 'DELETE'){
    //suppression d'un commentaire en base de donnees par un utilisateur
    $data = dbDeleteComment($db, $_GET['login'], intval($id));
  }
}
header('Content-Type: text/plain;charset=utf-8');
header('Cache-control: no-store,no-cache,must-revalidate');
header('Pragma:no-cache');
header('HTTP/1.1 200 OK');
echo json_encode($data);
exit;
