<?php
  if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest") {
    
    include '../class/youtube.class.php';

    $youtube = new YouTube;

    if (isset($_POST['url'])) {
      echo $youtube->checkURL($_POST['url']);
    }
}
