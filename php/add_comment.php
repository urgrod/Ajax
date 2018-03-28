<?php

$error = '';
$comment = '';
$login = '';
$id = '';

if (empty($_POST["add-commentaire-area"])){
  $error .= '<p class="text-danger">Un commentaire est requis</p>';
}
else {
  $comment = $_POST["add-commentaire-area"];
}

if (empty($_POST["login"])){
  $error .= '<p class="text-danger">Un login est requis</p>';
}
else {
  $login = $_POST["login"];
}

if (empty($_POST["id_photo"])){
  $error .= '<p class="text-danger">Un login est requis</p>';
}
else {
  $id = $_POST["id_photo"];
}


if ($error == ''){
  $query = "INSERT INTO comments (id, userLogin, photoId, comment) VALUES (NULL, :login, :id, :comment)";

  $request = $db->prepare($query);
  $request->execute(
      array(
        ':userLogin' =>$login,
        ':id' => $id,
        ':comment' => $comment
      )
    );

 $error = '<label class="text-success">CCommentaire ajoute</label>';
}

$data = array(
  'error' => $error
);

echo json_encode($data);
 ?>
