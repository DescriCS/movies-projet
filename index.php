<?php
include('inc/pdo.php');
include('inc/functions.php');

$title = 'Page d\'acceuil';

echo 'my name is'
?>
<<<<<<< HEAD

<?php include('inc/header.php'); ?>

=======
<?php include('inc/header.php'); ?>

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






>>>>>>> origin/fred
<?php include('inc/footer.php'); ?>
