<?php
include('inc/pdo.php');
include('inc/functions.php');

<<<<<<< HEAD
$title = 'Page d\'insciption';
=======
//////////////////////////////////

$title = 'Page d\'inscription';
$error = array();
$success = false;

//////////////////////////////////

if (!empty($_POST['btnsubmit'])) {

  $email = trim(strip_tags($_POST['email']));

  if (!empty($email)) {

    if (strlen($email) > 155) {
      // Vérification du nombre de caractères de l'email
      $error['email'] = 'L\'email renseigner est trop long ( Max 155 Caractères )';
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      // Vérification l'email possède un @ est qu'elle soit valide
      $error['email'] = 'L\'email renseigner n\'est pas valide';
    } else {
      // Vérification si l'email est déjà présente dans la table de la BDD
      $sql = "SELECT email FROM users WHERE email = :email";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':email',$email, PDO::PARAM_STR);
      $stmt->execute();
      $useremail = $stmt->fetch();

      if (!empty($useremail)) {
        // Après vérification dans la base de donnée on arrive ici seulement si l'email est déjà présente dans la BDD
        $error['email'] = 'L\'email est déjà présente dans la BDD. Il est donc impossible de vous enregistrez avec celle ci';
      }
    }

  } else {
    // Si le champ est vide on arrive ici.
    $error['email'] = 'Veuillez renseigner un email.';
  }

  //////////////////////////////////

  $pseudo = trim(strip_tags($_POST['pseudo']));

  if (!empty($pseudo)) {
    if (strlen($pseudo) < 3) {
      // Le nombre de caractères est de mini 3.
      $error['pseudo'] = 'Votre pseudo est trop court. (minimum 3 caractères)';
    } elseif (strlen($pseudo) > 155) {
      // Le nombre de caratères est de max 155
      $error['pseudo'] = 'Votre pseudo est trop long. (maximum 155 caractères)';
    } else {
      // Vérification si le pseudo n'est pas déjà présente dans la base de donné.
      $sql = "SELECT pseudo FROM users WHERE pseudo = :pseudo";
      $stmt2 = $pdo->prepare($sql);
      $stmt2->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
      $stmt2->execute();
      $userpseudo = $stmt2->fetch();

      if(!empty($userpseudo)) {
        // L'email est déjà présente on r'envoie une erreur.
        $error['pseudo'] = 'Le pseudo existe déjà dans la base de donnée.';
      }
    }
  } else {
    // Aucun pseudo n'est renseigner.
    $error['pseudo'] = 'Aucun pseudo renseigner.';
  }

  //////////////////////////////////

  $password = trim(strip_tags($_POST['password']));
  $confirmpassword = trim(strip_tags($_POST['confirmpassword']));

  if (!empty($password) || !empty($confirmpassword)) {

    if ($_POST['password'] != $_POST['confirmpassword']) {
      // Vérifcation si le MDP sont correct
      $error['password'] = 'Les mots de passe sont différents!';

    } elseif(strlen($password) < 5 || strlen($confirmpassword) < 5) {
      // Mini 5 caractères.
      $error['password'] = 'Votre mot de passe est trop court. (minimum 5 caractères)';


    } elseif(strlen($password) > 255 || strlen($confirmpassword) > 255) {
      // MAX 255 caractères.
      $error['password'] = 'Votre mot de passe est trop long.';
    }
  } else {
    // Le champ des caractères est vide.
    $error['password'] = 'Veuillez renseigner votre mot de passe.';
  }

  //////////////////////////////////

  // On passe a la vérification d'erreur
  
  if (count($error) == 0) {
    $succes = true;

    $token = md5(uniqid(rand(), true));

    $passwordhash  = password_hash($password, PASSWORD_DEFAULT);

      $sql = "INSERT INTO users (pseudo,email,password,created_at,updated_at,role,token) VALUES ( :pseudo, :email, :password, NOW(), NOW(),'Membre', :token)";
      $query = $pdo->prepare($sql);

      $query->bindValue(':email',$email, PDO::PARAM_STR);
      $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
      $query->bindValue(':password',$passwordhash, PDO::PARAM_STR);
      $query->bindValue(':token',$token, PDO::PARAM_STR);

      $query->execute();

      echo 'Votre compte a bien été enregistrer.';
  }

}
>>>>>>> olivier

?>

<?php include('inc/header.php'); ?>

<<<<<<< HEAD
=======
<form class="" action="" method="post">

  <!-- EMAIL -->
  <div class="email">
    <label for="">Email : </label>
    <span class="error"><?php if (!empty($error['email'])) { echo $error['email']; } ?></span>
    <input type="text" name="email" value="<?php if (!empty($_POST['email'])) { echo $_POST['email']; } ?>">
  </div>

  <!-- PSEUDO -->
  <div class="pseudo">
    <label for="">Pseudo : </label>
    <span class="error"><?php if (!empty($error['pseudo'])) { echo $error['pseudo']; } ?></span>
    <input type="text" name="pseudo" value="<?php if (!empty($_POST['pseudo'])) { echo $_POST['pseudo']; } ?>">
  </div>

  <!-- PASSWORD -->
  <div class="password">
    <label for="">Mot de passe : </label>
    <span class="error"><?php if (!empty($error['password'])) { echo $error['password']; } ?></span>
    <input type="text" name="password" value="<?php if (!empty($_POST['password'])) { echo $_POST['password']; } ?>">
  </div>

  <!-- CONFIRM PASSWORD -->
  <div class="confirmpassword">
    <label for="">Confirmation du mot de passe : </label>
    <span class="error"><?php if (!empty($error['confirmpassword'])) { echo $error['confirmpassword']; } ?></span>
    <input type="text" name="confirmpassword" value="<?php if (!empty($_POST['confirmpassword'])) { echo $_POST['confirmpassword']; } ?>">
  </div>

  <input type="submit" name="btnsubmit" value="Crée mon compte">

</form>

>>>>>>> olivier

<?php include('inc/footer.php'); ?>
