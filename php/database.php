<?php
/**
 * @Author: Thibault Napoléon <Imothep>
 * @Company: ISEN Yncréa Ouest
 * @Email: thibault.napoleon@isen-ouest.yncrea.fr
 * @Created Date: 22-Jan-2018 - 13:57:23
 * @Last Modified: 29-Jan-2018 - 22:39:10
 */

  require_once('constants.php');

  //----------------------------------------------------------------------------
  //--- dbConnect --------------------------------------------------------------
  //----------------------------------------------------------------------------
  // Create the connection to the database.
  // \return False on error and the database otherwise.
  function dbConnect()
  {
    try
    {
      $db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME.';charset=utf8',
        DB_USER, DB_PASSWORD);
    }
    catch (PDOException $exception)
    {
      error_log('Connection error: '.$exception->getMessage());
      return false;
    }
    return $db;
  }

  //----------------------------------------------------------------------------
  //--- dbRequestPhotos --------------------------------------------------------
  //----------------------------------------------------------------------------
  // Get all photos.
  // \param db The connected database.
  // \return The list of small photos.
  function dbRequestPhotos($db)
  {
    try
    {
      $request = 'select id, small as src from photos';
      $statement = $db->prepare($request);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
    return $result;
  }

  //----------------------------------------------------------------------------
  //--- dbRequestPhoto ---------------------------------------------------------
  //----------------------------------------------------------------------------
  // Get a specific photo.
  // \param db The connected database.
  // \param id The id of the photo.
  // \return The photo.
  function dbRequestPhoto($db, $id)
  {
    try
    {
      $request = 'select id, title, large as src from photos where id=:id';
      $statement = $db->prepare($request);
      $statement->bindParam(':id', $id, PDO::PARAM_INT);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
    return $result;
  }

  function dbRequestComments($db, $photoId)
  {
    try
    {
      $request = 'SELECT id, comment, userLogin FROM comments where photoId=:photoId';
      $statement = $db->prepare($request);
      $statement->bindParam(':photoId', $photoId, PDO::PARAM_INT);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
    return $result;
  }


  function dbAddComments($db, $userLogin, $photoId,$comment)
{
  try
  {

    $request = 'INSERT INTO comments (userLogin, photoId, comment) VALUES ( :login, :id, :comment);';
    $statement = $db->prepare($request);
    $statement->bindParam(':userLogin', $userlogin, PDO::PARAM_STR, 20);
    $statement->bindParam(':photoId', $photoId, PDO::PARAM_STR, 256);
    $statement->bindParam(':comment', $comment, PDO::PARAM_STR, 256);
    $statement->execute();
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
  return true;
}

//----------------------------------------------------------------------------
//--- dbModifyTwitt ----------------------------------------------------------
//----------------------------------------------------------------------------
// Function to modify a twitt.
// \param db The connected database.
// \param id The id of the twitt to update.
// \param login The login of the user.
// \param text The new twitt.
// \return True on success, false otherwise.
/*function dbModifyComments($db, $id, $login, $text)
{
  try
  {
    $request = 'update twitts set text=:text where id=:id and login=:login ';
    $statement = $db->prepare($request);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':login', $login, PDO::PARAM_STR, 20);
    $statement->bindParam(':text', $text, PDO::PARAM_STR, 80);
    $statement->execute();
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
  return true;
}

//----------------------------------------------------------------------------
//--- dbDeleteTwitt ----------------------------------------------------------
//----------------------------------------------------------------------------
// Delete a twitt.
// \param db The connected database.
// \param id The id of the twitt.
// \param login The login of the user.
// \return True on success, false otherwise.
function dbDeleteComments($db, $id, $login)
{
  try
  {
    $request = 'delete from twitts where id=:id and login=:login';
    $statement = $db->prepare($request);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':login', $login, PDO::PARAM_STR, 20);
    $statement->execute();
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
  return true;
}*/
?>
