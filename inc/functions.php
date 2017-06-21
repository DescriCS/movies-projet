<?php

function debug($array) {
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

function isLogged() {

   if (!empty($_SESSION['id']) && !empty($_SESSION['pseudo'])
        && !empty($_SESSION['email']) && !empty($_SESSION['password'])
        && !empty($_SESSION['role']) && !empty($_SESSION['ip_add'])) {
          if (is_numeric($_SESSION['id'])) {
            if ($_SESSION['ip_add'] == $_SERVER['REMOTE_ADDR']) {

             //header('Location: index.php');

             return true;

           }
        }
    }
    return false;
}

function showJson($data)
{
  header("Content-type: application/json");
  $json = json_encode($data, JSON_PRETTY_PRINT);
  if ($json){
    die($json);
  }
  else {
    die("error in json encoding");
  }
}
