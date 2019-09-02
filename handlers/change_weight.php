<?php include '../database/connection.php' ?>
<?php
session_start();
date_default_timezone_set('Europe/Kaliningrad');
  // data: {car_number: number, car_weight: weight, category: team_category}
  $car_number = $_REQUEST['car_number'];
  $weight = $_REQUEST['car_weight'];
  $category = $_REQUEST['category'];
  $user = $_SESSION['login'];
  echo $user;

  $time = date('d.m G:i');

  if ($category == 'cv') {
    $query = "UPDATE cv_inspection SET weight = '$weight', last_update = '$time' WHERE car_number = '$car_number'";
  } else {
    $query = "UPDATE ev_inspection SET weight = '$weight', last_update = '$time' WHERE car_number = '$car_number'";
  }

  $result = mysqli_query($date, $query);

  $log_message = "$car_number: " . "weight - " . "$weight";
  $query_log = "INSERT INTO logs VALUES (NULL, NULL, '$log_message', '$user')";
  $result_log = mysqli_query($date, $query_log);

  if (!$result_log) {
    echo mysqli_error($date);
  }

  if (!$result) {
    echo mysqli_error($date);
  }

?>
