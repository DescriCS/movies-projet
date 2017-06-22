<?php
include('inc/pdo.php');
include('inc/functions.php');

if(!empty($_POST['submitbtn'])){
	// protection XSS
	$email = trim(strip_tags($_POST['email']));

		if(empty($email) || (filter_var($email, FILTER_VALIDATE_EMAIL)) === false) {
	      $error['email'] = 'Adresse email invalide.';
	    }
	    elseif(strlen($email) > 155) {
	      $error['email'] = 'Votre adresse e-mail est trop longue.';
	    }
	    // verifier que email exist dans la BDD
	    else {
	    	$sqlmail = "SELECT pseudo,email,token FROM users WHERE email = :email";
                $smtp = $pdo->prepare($sqlmail);
                $smtp->bindValue(':email',$email);
                $smtp->execute();
                $user = $smtp->fetch();

                if(!$user) {
                   $error['email'] = 'Cette adresse e-mail n\'est pas enregistrer sur notre site.';
                } else {
                	// envoi email avec lien contenant le token
                	$tokenprepare = urlencode($user['token']);

                	// mettre une date d'expiration de validation du token ++ securite ++
                	$emailprepare = urlencode($user['email']);
                	// envoie de mail par
                	$body = '<p>Veuillez cliquer sur le lien ci-dessous</p>';
                	$body .= '<p><a href="http://localhost/J15/movies-projet/passwordmodification.php?email='.$emailprepare.'&token='.$tokenprepare.'">ICI</a></p>';
                	$body .= '<p>Rappel : Votre pseudo => '. $user['pseudo'] .'</p>';
                	echo $body;
                }
	    }
}

?>

<?php include('inc/header.php'); ?>

<h4>Récupération de mot de passe</h4>

<form class="" action="" method="post">

  <!-- Login -->
  <div class="email">
    <span class="error"><?php if(!empty($error['email'])) { echo $error['email']; } ?></span>
    <input type="text" placeholder="Pseudo/E-mail" name="email" class="email" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } ?>" />
  </div>

  <br>

  <input type="submit" name="submitbtn" class="btn" value="Envoyer">

</form>

<?php include('inc/footer.php'); ?>
