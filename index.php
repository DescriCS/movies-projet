<?php
include('inc/pdo.php');
include('inc/functions.php');

$title = 'Page d\'acceuil';
?>

<?php include('inc/header.php'); ?>

<div class="container">

  <?php

    $sql = "SELECT * FROM movies_full ORDER BY RAND() DESC LIMIT 100";
      $query = $pdo->prepare($sql);
      $query->execute();
      $movies_full = $query->fetchAll();

   foreach ($movies_full as $movie) { ?>

     <div class="movie d-inline-flex">
        <a href="single.php?id=<?php echo $movie['id']; ?>">

          <?php if (file_exists("./asset/posters/".$movie['id'].'.jpg') === TRUE) { ?>
          <img src="./asset/posters/<?php echo $movie['id']; ?>.jpg" alt="<?php echo $movie['title']; ?>">
          <h4><?php echo $movie['title'] ?></h4>
          <?php } else  { ?>
          <img src="./asset/images/nopic.png" alt="pas d\'image disponible">
          <h4><?php echo $movie['title'] ?></h4>
          <?php } ?>

        </a>
     </div>

   <?php } ?>

</div>


<?php include('inc/footer.php'); ?>
