<?php
  session_start();
  include '../database/connection.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>FSR - Status</title>

    <script type="text/javascript">
      $('.team').click(function(event) {
        $(this).children('.statuses').show()
      })

      $(document).mouseup(function (e){ // событие клика по веб-документу
    		var div = $(".statuses"); // тут указываем ID элемента
    		if (!div.is(e.target) // если клик был не по нашему блоку
    		    && div.has(e.target).length === 0) { // и не по его дочерним элементам
    			div.hide(); // скрываем его
    		}
    	});

      function changeStatus(test_name, number, team_category) {
        var test_status = $(event.target).val()
        $.ajax({
          type: "post",
          url: "../handlers/change_status.php",
          data: {car_number: number, test: test_name, status: test_status, category: team_category}
        }).done(function(result){
          console.log(result);
        })
      }
      function changeWeight(number, team_category) {
        var weight = $(event.target).val()
        $.ajax({
          type: "post",
          url: "../handlers/change_weight.php",
          data: {car_number: number, car_weight: weight, category: team_category}
        }).done(function(result){
          console.log(result);
        })
      }
    </script>

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
            $update_time = $inspection['last_update'];
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
              include '../scripts/names.php';
              foreach ($inspection as $key => $value) {
                if ($key != 'id' && $key != 'car_number' && $key != 'last_update') {
                  if ($key == 'weight') {
                    ?>
                      <div class="status">
                        <span><?php echo $names[$key] ?></span>

                        <?php
                          if ($_SESSION['rights'] == 's') {
                            ?>
                            <input type="text" name="car_weight" value="<?php echo $inspection['weight']; ?>" style="width: 80px" onchange="changeWeight('<?php echo $team['number']?>', '<?php echo $team['category'] ?>')">
                            <span>[kg]</span>
                            <?php
                          } else {
                            ?>
                            <span><?php echo $value; ?></span>
                            <?php
                          }
                        ?>

                      </div>
                    <?php
                  } else {
                  ?>
                  <div class="status">
                    <span><?php echo $names[$key] ?></span>

                    <?php
                      if ($_SESSION['rights'] == 's') {
                        ?>
                        <select class="" name="status-selector" onchange="changeStatus('<?php echo $key?>', '<?php echo $team['number']?>', '<?php echo $team['category'] ?>')">
                          <option value="none" <?php if ($value == 'none') {
                            echo "selected";
                          } ?>>NONE</option>
                          <option value="present" <?php if ($value == 'present') {
                            echo "selected";
                          } ?>>PRESENT</option>
                          <option value="failed" <?php if ($value == 'failed') {
                            echo "selected";
                          } ?>>FAILED</option>
                          <option value="passed" <?php if ($value == 'passed') {
                            echo "selected";
                          } ?>>PASSED</option>
                        </select>
                        <?php
                      } else {
                        ?>
                        <span><?php echo $names[$value] ?></span>
                        <?php
                      }
                    ?>

                  </div>

                <?php
                  }
                }
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
