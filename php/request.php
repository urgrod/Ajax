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
    $data = dbRequestPhoto($db,intval($id));
  }
  else {
    $data = dbRequestPhotos($db);
  }
}else if ($requestRessource == 'comments') {
  if ($requestType == 'GET') {
    $data = dbRequestComments($db,$id);
  }
  if ($requestType == 'POST'){
    $data = dbAddComments($db,$id,$_POST['comment'],"cir2");
  }
  /*if ($requestType == 'PUT'){
    parse_str(file_get_contents('php://input'),$_PUT);
    $data = dbModifyComments($db,intval($id),$_PUT['login'],$_PUT['text']);
  }
  if ($requestType == 'DELETE'){
    $data = dbDeleteComments($db, intval($id),$_GET['login']);
  }*/
}
header('Content-Type: text/plain;charset=utf-8');
header('Cache-control: no-store,no-cache,must-revalidate');
header('Pragma:no-cache');
header('HTTP/1.1 200 OK');
echo json_encode($data);
exit;
