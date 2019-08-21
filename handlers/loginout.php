<?php include '../database/connection.php' ?>
<?php
session_start();

if (isset($_REQUEST['submit-button-entry'])) {

  $login = $_REQUEST['login'];
  $password = $_REQUEST['password'];

  $query = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
  $result = mysqli_query($date, $query);
  $user = mysqli_fetch_array($result, MYSQL_ASSOC);
  if (!$user) {
    die("Неправильный логин или пароль");
  }
  $_SESSION['login'] = $login;
  $_SESSION['rights'] = $user['rights'];
  header('Location: ../index.php');
}

?>
