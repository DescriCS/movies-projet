<?php
include('inc/pdo.php');
include('inc/functions.php');

$title = 'Page d\'acceuil';
?>

<?php include('inc/header.php'); ?>

<button type="button" name="button"><a href="inscription.php">Inscription</a></button>
<button type="button" name="button"><a href="connexion.php">Connexion</a></button>

<?php

  $sql = "SELECT * FROM movies_full ORDER BY RAND() DESC LIMIT 100";
    $query = $pdo->prepare($sql);
    $query->execute();
    $movies_full = $query->fetchAll();

 foreach ($movies_full as $movie) { ?>

   <div class="movie">
      <a href="single.php?id=<?php echo $movie['id']; ?>">
        <img src="./asset/posters/<?php echo $movie['id']; ?>.jpg" alt="<?php echo $movie['title']; ?>">
      </a>
   </div>

 <?php } ?>


<?php include('inc/footer.php'); ?>
