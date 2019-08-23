<?php
  session_start();
  include '../database/connection.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>FSR - Status</title>
    <script type="text/javascript" src='../scripts/toggle.js'></script>
  </head>
  <body>
    <div class="container-page">

      <div class="page-title">
        Status
      </div>

      <div class="search">

      </div>

      <div class="list-container">
        <?php
          $query = 'SELECT * FROM teams';
          $result = mysqli_query($date, $query);
          if (!$result) {
            echo mysqli_error($date);
          }
          while ($team = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            $team_name = $team['number'] . ' ' . $team['country'] . ' ' . $team['name'];

            $car_number = $team['number'];
            if ($team['category'] == 'cv') {
              $query2 = "SELECT * FROM cv_inspection WHERE car_number = '$car_number'";
            } else {
              $query2 = "SELECT * FROM ev_inspection WHERE car_number = '$car_number'";
            }
            $result2 = mysqli_query($date, $query2);
            $inspection = mysqli_fetch_array($result2, MYSQL_ASSOC);
            $update_time = $inspection['update'];
        ?>
          <div class="team">

            <div class="team-item team-name">
              <span><?php echo $team_name ?></span>
            </div>

            <div class="team-item update">
              <span style="margin-right: 10px;">Last update: </span>
              <span><?php echo $update_time; ?></span>
            </div>

            <div class="statuses">
              <?php
              foreach ($inspection as $key => $value) {
                ?>
                <div class="status">
                  <span><?php echo $key ?></span>
                  <span><?php echo $value ?></span>
                </div>
                <?php
              }
              ?>
            </div>
          </div>
        <?php
          }
        ?>
      </div>
    </div>
  </body>
</html>
