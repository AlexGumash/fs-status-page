<?php
  session_start();
  include '../database/connection.php';
  function getColor($status) {
    if ($status == 'failed') {
      return 'rgb(204, 65, 49)';
    }
    if ($status == 'passed') {
      return 'rgb(121, 193, 85)';
    }
    if ($status == 'present') {
      return 'rgb(230, 212, 103)';
    }
    if ($status == 'none') {
      return 'rgb(231, 231, 231)';
    }
  }
  function getWeightColor($status) {
    if ($status != 0) {
      return 'rgb(121, 193, 85)';
    }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

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
          data: {car_number: number, test: test_name, status: test_status, category: team_category},
          beforeSend: function(){
            var parentStatus = event.target.parentElement;
            if (test_status == 'failed') {
              $(parentStatus).css("background-color","rgb(204, 65, 49)");
            }
            if (test_status == 'passed') {
              $(parentStatus).css("background-color","rgb(121, 193, 85)");
            }
            if (test_status == 'present') {
              $(parentStatus).css("background-color","rgb(230, 212, 103)");
            }
            if (test_status == 'none') {
              $(parentStatus).css("background-color","rgb(231, 231, 231)");
            }
          }
        }).done(function(result){
          console.log(result);
        })
      }
      function changeWeight(number, team_category) {
        var weight = $(event.target).val()
        $.ajax({
          type: "post",
          url: "../handlers/change_weight.php",
          data: {car_number: number, car_weight: weight, category: team_category},
          beforeSend: function(){
            var parentStatus = event.target.parentElement.parentElement;
            if (weight != 0) {
              $(parentStatus).css("background-color","rgb(121, 193, 85)");
            } else {
              $(parentStatus).css("background-color","rgb(231, 231, 231)");
            }
          }
        }).done(function(result){
          console.log(result);
          // $("p#44.test").css("background-color","yellow");
        })

      }
      // function searchFilter() {
      //   var input = document.getElementById('search-input');
      //   var inputValue = input.value;
      //   console.log(inputValue);
      //   var teams = document.getElementsByClassName('team-name');
      //   Object.values(teams).forEach(function(name) {
      //     let carNumber = name.innerText.split(' ')[0];
      //     let parentDiv = name.parentElement
      //
      //     if (carNumber.search(inputValue) == -1) {
      //       $(parentDiv).hide();
      //     } else {
      //       $(parentDiv).css("display", "flex");
      //     }
      //   })
      //   // console.log("---------------------");
      // }

      document.querySelector('#search-input').oninput = function () {
        let val = this.value.trim();
        console.log(val);
        let elasticItems = document.querySelectorAll('.team-name');
        if (val != '') {
          elasticItems.forEach(function (elem) {
            let number = elem.innerText.trim().split(' ')[0];
            if (number.search(val) == -1) {
              let parentDiv = elem.parentElement;
              parentDiv.classList.add('hide');
            }
            else {
              let parentDiv = elem.parentElement;
              parentDiv.classList.remove('hide');
            }
          });
        }
        else {
          elasticItems.forEach(function (elem) {
            let parentDiv = elem.parentElement;
            parentDiv.classList.remove('hide');
          });
        }
    }
    </script>

  </head>
  <body>
    <div class="container-page">

      <div class="search">
        <span>Car number: </span>
        <input type="text" name="search-input" value="" id="search-input" style="width: 80px" placeholder="f.e. 259">
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
                      <div class="status" style="background-color: <?php echo getWeightColor($value); ?>">
                        <span><?php echo $names[$key] ?></span>

                        <?php
                          if ($_SESSION['rights'] == 's') {
                            ?>
                            <div class="">
                              <input type="text" name="car_weight" value="<?php echo $inspection['weight']; ?>" style="width: 80px" onchange="changeWeight('<?php echo $team['number']?>', '<?php echo $team['category'] ?>')" placeholder="f.e. 231.44">
                              <span>[kg]</span>
                            </div>
                            <?php
                          } else {
                            ?>
                            <div class="">
                              <span><?php echo $value; ?></span>
                              <span>[kg]</span>
                            </div>
                            <?php
                          }
                        ?>

                      </div>
                    <?php
                  } else {
                  ?>
                  <div class="status" style="background-color: <?php echo getColor($value); ?>">
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
