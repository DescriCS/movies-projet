<?php
include('inc/pdo.php');
include('inc/functions.php');

//////////////////////////////////
$error   = array();
$success = false;
$title   = 'Modification de mot de passe';
//////////////////////////////////

if (!empty($_POST['submitnewpassword'])) {

  $password1  = trim(strip_tags($_POST['newpassword']));
  $password2  = trim(strip_tags($_POST['newpassword2']));

  if ($password1 != $password2) {
    $error['password'] = 'Les mots de passe ne sont pas identiques.';
  } elseif(strlen($password1) <= 5) {
    $error['password'] = 'Votre mot de passe doit faire plus de caractères.';
  }

//////////////////////////////////

  if(count($error) == 0) {
    // Envoie du nouveau MDP
    $success = true;

    // hash password
    $token = md5(uniqid(rand(), true));
    $passwordhash  = password_hash($password1, PASSWORD_DEFAULT);

    $_GET['id'] = $id;

    $sql = "UPDATE users SET password= '+ $password1 +' , updated_at= 'NOW()', token= '+ $token +' WHERE id =  '+ $id +' ";
    $query = $pdo->prepare($sql);
    $query->bindValue(':password',$passwordhash, PDO::PARAM_STR);
    $query->bindValue(':token',$token, PDO::PARAM_STR);
    $query->execute();

    echo 'Votre mot de passe a bien été changer';
  }
}

?>

<?php include('inc/header.php'); ?>

<h1>Modifier votre mot de passe</h1>

<form method="post">

  <label for="newpassword">Votre nouveau mot de passe :</label>
  <input type="password" name="newpassword" value="">

  <label for="newpassword2">Confirmer votre nouveau mot de passe :</label>
  <input type="password" name="newpassword2" value="">

  <input type="submit" name="submitnewpassword" value="Modifier">
</form>

<?php include('inc/footer.php'); ?>
