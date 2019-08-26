<?php include '../database/connection.php' ?>
<?php
session_start();
date_default_timezone_set('Europe/Kaliningrad');
  // car_number: number, test: test_name, status: test_status, category: team_category
  $car_number = $_REQUEST['car_number'];
  $test = $_REQUEST['test'];
  $status = $_REQUEST['status'];
  $category = $_REQUEST['category'];

  $time = date('d.m G:i');

  if ($category == 'cv') {
    $query = "UPDATE cv_inspection SET `$test` = '$status', last_update = '$time' WHERE car_number = '$car_number'";
  } else {
    $query = "UPDATE ev_inspection SET `$test` = '$status', last_update = '$time' WHERE car_number = '$car_number'";
  }

  $result = mysqli_query($date, $query);

  if (!$result) {
    echo mysqli_error($date);
  }

?>
