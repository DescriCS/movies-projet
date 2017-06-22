<?php
include('inc/pdo.php');
include('inc/functions.php');

//////////////////////////////////
$error   = array();
$success = false;
$title   = 'Modification de mot de passe';
//////////////////////////////////

// Vérification de l'user + sécurisation de changement MDP
if (!empty($_GET['token'])) {

  $token = $_GET['token'];

  $sql = "SELECT * FROM users WHERE token = :token";
  $query = $pdo->prepare($sql);

  $query->bindValue(':token',$token, PDO::PARAM_STR);

  $query-> execute();
  $user = $query->fetch();

  if (!empty($user)) {
  } else {
    echo 'error 404';
  }


  // Envoie du formulaire pour le changement de MDP
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

      $id = $user['id'];

      // hash password
      $passwordhash  = password_hash($password1, PASSWORD_DEFAULT);

      $sql2 = "UPDATE users SET password=  :password , updated_at= NOW(), token= :token  WHERE id = :id";

      $query2 = $pdo->prepare($sql2);

      $query2->bindValue(':id',$id, PDO::PARAM_INT);
      $query2->bindValue(':password',$passwordhash, PDO::PARAM_STR);
      $query2->bindValue(':token',$token, PDO::PARAM_STR);

      $query2->execute();

      echo 'Votre mot de passe a bien été changer';
    }
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
