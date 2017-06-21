<?php
include('inc/pdo.php');
include('inc/functions.php');

$title = 'Détail';

if(!empty($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "SELECT * FROM movies_full WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id',$id, PDO::PARAM_INT);
    $query->execute();
    $movie = $query->fetch();

    // echo '<pre>';
    // print_r($movies_full);
    // echo '</pre>';
    // die();

 } else {
   die('error 404');

 }

?>

<?php include('inc/header.php'); ?>

<h1>Detail d'un film</h1>


      <div class="movieDetail">
          <h2><?php echo $movie['title']; ?></h2>
          <a href="single.php?id=<?php echo $movie['id']; ?>">
            <img src="./asset/posters/<?php echo $movie['id']; ?>.jpg" alt="<?php echo $movie['title']; ?>">
          </a>
          <p>title : <?php echo $movie['title']; ?></p>
          <p>year : <?php echo $movie['year']; ?></p>
          <p>genre : <?php echo $movie['genres']; ?></p>
          <p>plot : <?php echo $movie['plot']; ?></p>
          <p>directors : <?php echo $movie['directors']; ?></p>
          <p>cast : <?php echo $movie['cast']; ?></p>
          <p>writer : <?php echo $movie['writers']; ?></p>
          <p>runtime : <?php echo $movie['runtime']; ?></p>
          <p>rating : <?php echo $movie['rating']; ?></p>
          <p>popularity : <?php echo $movie['popularity']; ?></p>



      </div>





<?php include('inc/footer.php'); ?>
