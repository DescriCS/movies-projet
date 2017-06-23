<?php
include('inc/pdo.php');
include('inc/functions.php');

$title = 'Détail du film';
$error = array();
$success = false;

if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "SELECT * FROM movies_full WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id',$id, PDO::PARAM_INT);
    $query->execute();
    $movie = $query->fetch();

     //echo '<pre>';
     //print_r($movie);
     //echo '</pre>';
     //die();

} else {
  die('error 404');

}


// print_r($sql2);

if (!empty($_POST['btnavis'])) {
  if (isLogged() === true) {
  $sql2 = "SELECT a.movie_id, m.title FROM movies_full AS m RIGHT JOIN avis AS a ON a.movie_id = m.id";
  } else {
    $error['note'] = 'Vous devez être connecter pour donner votre avis !';
  }
}


?>

<?php include('inc/header.php'); ?>

<div class="container">
  <h1>Detail d'un film</h1>

        <div class="movieDetail">
            <h2><?php echo $movie['title']; ?></h2>
            <a href="single.php?id=<?php echo $movie['id']; ?>">
              <?php if (file_exists("./asset/posters/".$movie['id'].'.jpg') === TRUE) { ?>
              <img src="./asset/posters/<?php echo $movie['id']; ?>.jpg" alt="<?php echo $movie['title']; ?>">
              <?php } else  { ?>
              <img src="./asset/images/nopic.png" alt="pas d\'image disponible">
              <?php } ?>
            </a>
            <p>Titre : <?php echo $movie['title']; ?></p>
            <p>Année : <?php echo $movie['year']; ?></p>
            <p>Genre : <?php echo $movie['genres']; ?></p>
            <p>Synopsis : <?php echo $movie['plot']; ?></p>
            <p>Réalisateur : <?php echo $movie['directors']; ?></p>
            <p>Acteur : <?php echo $movie['cast']; ?></p>
            <p>Scénariste : <?php echo $movie['writers']; ?></p>
            <p>Durée du film : <?php echo $movie['runtime']; ?></p>
            <p>Note : <?php echo $movie['rating']; ?></p>
            <p>Popalarité : <?php echo $movie['popularity']; ?></p>

            <select>
              <option value="one">1</option>
              <option value="two">2</option>
              <option value="three">3</option>
              <option value="four">4</option>
              <option value="five">5</option>
            </select>

            <?php if (isLogged() === false) { ?>
              <p>Vous devez être <a href="connexion.php">connecter</a> ou <a href="inscription.php">inscrit</a> pour donner votre avis.</p>
            <?php } ?>
            <?php if (isLogged() === true) { ?>
              <input type="submit" name="btnavis" value="Donner son avis sur le film !">
            <?php } ?>

        </div>

</div>

<?php include('inc/footer.php'); ?>
