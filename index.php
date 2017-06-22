<?php
include('inc/pdo.php');
include('inc/functions.php');
?>

<?php

$genres = array(
  'drama' => 'Drama',
  'fantasy' =>  'Fantasy',
  'romance' =>  'Romance',
  'action' =>  'Action',
  'thriller' =>  'Thriller',
  'adventure' =>  'Adventure',
  'animation' =>  'Animation',
  'comedy' =>  'Comedy',
  'family' =>  'Family',
  'mystery' =>  'Mystery',
  'horror' =>  'Horror',
  'sci-Fi' =>  'Scifi',
  'crime' =>  'Crime',
  'music' =>  'Music',
  'war' =>  'War',
  'biography' =>  'Biography'

);

// print_r($_POST);
// die();






$title = 'Page d\'acceuil';

// traitement de formulaire
if (!empty($_POST['btncheck'])) {
  // print_r($_POST);
  $sql = "SELECT * FROM movies_full WHERE 1 = 1";

  if (!empty($_POST['genres'])) {
    $genres = $_POST['genres'];
        $sql .= "AND genres LIKE '%".trim($genres)."%'";

  }

    $query = $pdo->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();

}


$sql = "SELECT * FROM movies_full ORDER BY RAND() DESC LIMIT 100";
  $query = $pdo->prepare($sql);
  $query->execute();
  $movies_full = $query->fetchAll();

?>
 <?php include('inc/header.php'); ?>


<!-- filtrage genres-->



<form class="" action="" method="post">
  <div id="genre">
    <label for="genres">Genres</label>
    <span class="error"><?php if(!empty($error['genres'])) { echo $error['genres']; } ?></span>
    <select name="genres">
      <option value="">??</option>
      <?php foreach($genres as $key => $value) { ?>
        <option value="<?php echo $key; ?>"<?php if(!empty($_POST['genres'])) { if($_POST['genres'] == $key) { echo ' selected="selected"'; } } ?>><?php echo $value; ?></option>
      <?php } ?>
    </select>
  </div>



<!-- filtrage annees-->

<div id="years">
  <div class="input-group">
    <label for="years">Années</label>

    <select class="years" name="year2">
      <?php for ($i=date('Y'); $i>=date('Y')-99 ; $i--): ?>
        <option value="<?php echo $i;?>"><?php echo $i;?></option>
      <?php endfor;?>
        <option selected value="<?php echo date('Y')-100; ?>"><?php echo date('Y')-100; ?></option>
    </select>

    <span> entre </span>

    <select class="years" name="year">
      <option selected value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
      <?php for ($i=date('Y')-1; $i>=date('Y')-100 ; $i--): ?>
        <option value="<?php echo $i;?>"><?php echo $i;?></option>
      <?php endfor;?>
    </select>

  </div>
</div>

<!-- filtrage popularité-->

<div id="popularity">
  <div class="input-group">
    <label for="popularity">Popularité</label>

    <select class="popularity" name="popularity2">
      <option selected value="">Note</option>
      <?php for ($i=0; $i<=100 ; $i++): ?>
        <option value="<?php echo $i;?>"><?php echo $i;?></option>
      <?php endfor;?>
    </select>

    <span> entre </span>

    <select class="popularity" name="popularity">
      <option selected value="">Note</option>
      <?php for ($i=0; $i<=100 ; $i++): ?>
        <option value="<?php echo $i;?>"><?php echo $i;?></option>
      <?php endfor;?>
    </select>

  </div>
</div>

<input type="submit" name="btncheck" value="Rechercher">

</form>

 <?php foreach ($movies_full as $movie) { ?>

   <div class="movie">
      <a href="single.php?id=<?php echo $movie['id']; ?>">
        <img src="./asset/posters/<?php echo $movie['id']; ?>.jpg" alt="<?php echo $movie['title']; ?>">
      </a>
   </div>

 <?php } ?>


<?php include('inc/footer.php'); ?>
