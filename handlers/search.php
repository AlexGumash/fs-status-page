<?php include '../database/connection.php' ?>
<?php

if(!empty($_POST["number"])){ //Принимаем данные

    $number = $_POST['number'];

    $query = "SELECT * FROM teams WHERE number LIKE '$number'";
    $result = mysqli_query($date, $query);
    $team = mysqli_fetch_array($result, MYSQL_ASSOC);

    if (!$team) {
      echo "No team found";
    } else {
      echo "string";
    }

}
?>
