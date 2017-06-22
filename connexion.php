<?php

session_start();
>>>>>>> olivier
include('inc/pdo.php');
include('inc/functions.php');

$title = 'Page de connexion';

if (isLogged() === true) {
  echo '<script language="javascript">';
  echo 'alert("Vous êtes déjà connecté !")';
  echo '</script>';
  header('Location: index.php');

if (!empty($_SESSION)) {
  echo '<script language="javascript">';
  echo 'alert("Vous êtes déjà connecté !")';
  echo '</script>';
  // header('Location: index.php');


}

$error = array();

if (!empty($_POST['connex'])) {

  $userInfo = trim(strip_tags($_POST['user']));
  $userpass = trim(strip_tags($_POST['password']));

  if (!empty($userInfo)) {
    $sql = "SELECT * FROM users WHERE pseudo = :user OR email = :user";

    $query = $pdo->prepare($sql);

    $query->bindValue(':user', $userInfo, PDO::PARAM_STR);
    $query->execute();
    $user_bdd = $query->fetch();

    // print_r($user_bdd);
    // die();

    if (!empty($user_bdd)) {
      if (empty($userpass)) {
        $error['password'] = '!Renseigner un mot de passe!';
      } elseif (password_verify($userpass, $user_bdd['password']) === false) {
          $error['password'] = '!Mot de passe invalide!';
        } else {
          // print_r($user_bdd);

            $_SESSION = array(
              'id' => $user_bdd['id'],
              'pseudo' => $user_bdd['pseudo'],
              'email' => $user_bdd['email'],
              'password' => $user_bdd['password'],
              'role' => $user_bdd['role'],
              'ip_add' => $_SERVER['REMOTE_ADDR']
            );
            if (isLogged() == true) {
              header('Location: index.php');
            }
        }
    }
    else {
      $error['user'] = '!Nom d\'utilisateur ou courriel invalide!';
    }
  } else {
      $error['user'] = '!Renseigner le champ!';
    }
  if (count($error) == 0) {
    echo 'Bravo !';
  }
}
elseif (!empty($_POST['forget'])) {
  header('Location: forgetpsw.php');
}

?>

<?php include('inc/header.php'); ?>


<form action="" method="post">

  <label for="user">Pseudo ou Courriel :</label>
  <span class="error"><?php if (!empty($error['user'])) {echo $error['user']; } ?></span><br />
  <input type="text" name="user" value="<?php if (!empty($_POST['user'])) {echo $_POST['user'] ; } ?>"><br />

  <label for="password">Mot de passe :</label>
  <span class="error"><?php if (!empty($error['password'])) {echo $error['password']; } ?></span><br />
  <input type="password" name="password" value="<?php if (!empty($_POST['password'])) {echo $_POST['password'] ; } ?>">


  <input type="submit" name="connex" value="Connexion">
  <input type="submit" name="forget" value="Code oublié"><br />



</form>


<?php include('inc/footer.php'); ?>
