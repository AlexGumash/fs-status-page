<?php include '../database/connection.php' ?>
<?php
session_start();
date_default_timezone_set('Europe/Kaliningrad');

if (isset($_REQUEST['submit-button-news'])) {

  $title = $_REQUEST['title'];
  $content = $_REQUEST['content'];
  $time = date('d.m G:i');

  $query = "INSERT INTO news (id, time, title, content) VALUES (NULL, '$time', '$title', '$content')";
  $result = mysqli_query($date, $query);
  if (!$result) {
    echo mysqli_error($date);
  }

  header('Location: ../index.php');
}


?>
