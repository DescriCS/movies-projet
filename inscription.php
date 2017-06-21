<?php
include('inc/pdo.php');
include('inc/functions.php');

$title = 'Page d\'insciption';



?>

<?php include('inc/header.php'); ?>

<form class="" action="index.html" method="post">

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

  <!-- EMAIL -->
  <div class="password">
    <label for="">Mot de passe : </label>
    <span class="error"><?php if (!empty($error['password'])) { echo $error['password']; } ?></span>
    <input type="text" name="password" value="<?php if (!empty($_POST['password'])) { echo $_POST['password']; } ?>">
  </div>

  <!-- EMAIL -->
  <div class="confirmpassword">
    <label for="">Confirmation du mot de passe : </label>
    <span class="error"><?php if (!empty($error['confirmpassword'])) { echo $error['confirmpassword']; } ?></span>
    <input type="text" name="confirmpassword" value="<?php if (!empty($_POST['confirmpassword'])) { echo $_POST['confirmpassword']; } ?>">
  </div>

  <input type="submit" name="btnsubmit" value="Crée mon compte">

</form>

<?php include('inc/footer.php'); ?>
