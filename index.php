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

include('inc/header.php');

?>
<h1>Liste des films</h1>
<?php
foreach ($movies_full as $movies) { ?>

    <div class="maPageaccueil">
      <p>
          <a href="single.php?id=<?php echo $movies['id']; ?>">
            <img src="./asset/posters/<?php echo $movies['id']; ?>.jpg" alt="<?php echo $movies['id']; ?>"
            <p><?php echo $movies['title']; ?></p>
          </a>
      </p>


    </div>
<?php
}?>


<?php include('inc/footer.php');

?>
