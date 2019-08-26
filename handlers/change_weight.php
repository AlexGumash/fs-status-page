<?php include '../database/connection.php' ?>
<?php
session_start();
date_default_timezone_set('Europe/Kaliningrad');
  // data: {car_number: number, car_weight: weight, category: team_category}
  $car_number = $_REQUEST['car_number'];
  $weight = $_REQUEST['car_weight'];
  $category = $_REQUEST['category'];

  $time = date('d.m G:i');

  if ($category == 'cv') {
    $query = "UPDATE cv_inspection SET weight = '$weight', last_update = '$time' WHERE car_number = '$car_number'";
  } else {
    $query = "UPDATE ev_inspection SET weight = '$weight', last_update = '$time' WHERE car_number = '$car_number'";
  }

  $result = mysqli_query($date, $query);

  if (!$result) {
    echo mysqli_error($date);
  }

?>
