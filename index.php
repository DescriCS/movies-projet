<?php
include('inc/pdo.php');
include('inc/functions.php');

$title = 'Page d\'acceuil';

$sql = "SELECT * FROM movies_full ORDER BY RAND() LIMIT 20";

$query = $pdo->prepare($sql);
$query->execute();
$movies_full = $query->fetchAll();


// echo "<pre>";
// print_r($movies_full);
// echo "<pre>";

//// Nous souhaitons en effet lui laisser la possibilité de filtrer selon les critères suivants :
	// -	Catégorie (plusieurs checkboxes, dont une pour cocher tout et une pour tout décocher)

	// -    Années (de xxxx à xxxx)
	// -    Popularité


include('inc/header.php');

?>

<h1>Liste des films</h1>

<?php

  $sql = "SELECT * FROM movies_full ORDER BY RAND() DESC LIMIT 50";
    $query = $pdo->prepare($sql);
    $query->execute();
    $movies_full = $query->fetchAll();

 foreach ($movies_full as $movie) { ?>

   <div class="movie">
      <a href="single.php?id=<?php echo $movie['id']; ?>">
        <img src="./asset/posters/<?php echo $movie['id']; ?>.jpg" alt="<?php echo $movie['title']; ?>">
        <p><?php echo $movie['title']; ?></p>
      </a>
   </div>

 <?php } ?>


<?php include('inc/footer.php'); ?>
