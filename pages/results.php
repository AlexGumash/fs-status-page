<?php
  session_start();
  include '../database/connection.php';
  include '../scripts/names.php';

  function getColor($status) {
    if ($status == 'failed') {
      return 'rgb(255, 36, 0)';
    }
    if ($status == 'passed') {
      return 'rgb(86, 255, 1)';
    }
    if ($status == 'present') {
      return 'rgb(245, 249, 6)';
    }
    if ($status == 'none') {
      return 'rgb(231, 231, 231)';
    }
  }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>FSR - Results</title>
    <script type="text/javascript">
      $('#upload-files-button').click(function() {
        $('.upload-files').toggle()
      })

      function deleteFile(id, filename) {
        console.log(id);
        $.ajax({
          type: "post",
          url: "../handlers/delete_file.php",
          data: {file_id: id, file: filename},
          beforeSend: function(){
            var parentLink = event.target.parentElement.parentElement;
            parentLink.classList.add('hide');
          }
        }).done(function(result){
          console.log(result);
          // $("p#44.test").css("background-color","yellow");
        })

      }
    </script>
  </head>
  <body>
    <div class="container-page">
      <div class="result-label">
        <span>Technical Inspection Status</span>
      </div>

      <div class="result-table-div">
        <table class="result-table">

          <tr class="result-table-row">
            <th class="result-table-cell">
              <span>#</span>
            </th>
            <th class="result-table-cell">
              <span>Uni</span>
            </th>
            <th class="result-table-cell">
              <span>Name</span>
            </th>
            <th class="result-table-cell">
              <span>Category</span>
            </th>
            <th class="result-table-cell">
              <span>Pre-inspection</span>
            </th>
            <th class="result-table-cell">
              <span>Accumulator</span>
            </th>
            <th class="result-table-cell">
              <span>E-inspection</span>
            </th>
            <th class="result-table-cell">
              <span>M-inspection</span>
            </th>
            <th class="result-table-cell">
              <span>Tilt test</span>
            </th>
            <th class="result-table-cell">
              <span>Noise/Rain test</span>
            </th>
            <th class="result-table-cell">
              <span>Brake test</span>
            </th>
            <th class="result-table-cell">
              <span>Weight</span>
            </th>
          </tr>

          <?php
            $query = "SELECT * FROM teams JOIN cv_inspection ON teams.number = cv_inspection.car_number";
            $result = mysqli_query($date, $query);
            if (!$result) {
              echo mysqli_error($date);
            }
            while ($team = mysqli_fetch_array($result, MYSQL_ASSOC)) {

              ?>

              <tr class="result-table-row">
                <td class="result-table-cell">
                  <div class="inside-cell">
                    <?php echo $team['number'] ?>
                  </div>
                </td>
                <td class="result-table-cell">
                  <div class="inside-cell">
                    <?php echo $team['uni'] ?>
                  </div>
                </td>
                <td class="result-table-cell">
                  <div class="inside-cell">
                    <?php echo $team['name'] ?>
                  </div>
                </td>
                <td class="result-table-cell">
                  <div class="inside-cell">
                    <?php echo $names[$team['category']] ?>
                  </div>
                </td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['pre_inspection']); ?>">
                  <div class="inside-cell">
                    <?php echo $names[$team['pre_inspection']] ?>
                  </div>
                </td>
                <td class="result-table-cell cross"></td>
                <td class="result-table-cell cross"></td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['m_inspection']); ?>">
                  <div class="inside-cell">
                    <?php echo $names[$team['m_inspection']] ?>
                  </div>
                </td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['tilt']); ?>">
                  <div class="inside-cell">
                    <?php echo $names[$team['tilt']]?>
                  </div>
                </td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['noise']); ?>">
                  <div class="inside-cell">
                    <?php echo $names[$team['noise']] ?>
                  </div>
                </td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['brake']); ?>">
                  <div class="inside-cell">
                    <?php echo $names[$team['brake']] ?>
                  </div>
                </td>
                <td class="result-table-cell">
                  <div class="inside-cell">
                    <span style="font-weight: bold">
                      <?php echo $team['weight'] ?>
                       [kg]
                    </span>
                  </div>
                </td>
              </tr>

              <?php
            }
          ?>

          <?php
            $query = "SELECT * FROM teams JOIN ev_inspection ON teams.number = ev_inspection.car_number";
            $result = mysqli_query($date, $query);
            if (!$result) {
              echo mysqli_error($date);
            }
            while ($team = mysqli_fetch_array($result, MYSQL_ASSOC)) {

              ?>

              <tr class="result-table-row">
                <td class="result-table-cell">
                  <div class="inside-cell">
                    <?php echo $team['number'] ?>
                  </div>
                </td>
                <td class="result-table-cell">
                  <div class="inside-cell">
                    <?php echo $team['uni'] ?>
                  </div>
                </td>
                <td class="result-table-cell">
                  <div class="inside-cell">
                    <?php echo $team['name'] ?>
                  </div>
                </td>
                <td class="result-table-cell">
                  <div class="inside-cell">
                    <?php echo $names[$team['category']] ?>
                  </div>
                </td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['pre_inspection']); ?>">
                  <div class="inside-cell">
                    <?php echo $names[$team['pre_inspection']] ?>
                  </div>
                </td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['accumulator']); ?>">
                  <div class="inside-cell">
                    <?php echo $names[$team['accumulator']] ?>
                  </div>
                </td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['e_inspection']); ?>">
                  <div class="inside-cell">
                    <?php echo $names[$team['e_inspection']] ?>
                  </div>
                </td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['m_inspection']); ?>">
                  <div class="inside-cell">
                    <?php echo $names[$team['m_inspection']] ?>
                  </div>
                </td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['tilt']); ?>">
                  <div class="inside-cell">
                    <?php echo $names[$team['tilt']]?>
                  </div>
                </td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['rain']); ?>">
                  <div class="inside-cell">
                    <?php echo $names[$team['rain']]?>
                  </div>
                </td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['brake']); ?>">
                  <div class="inside-cell">
                    <?php echo $names[$team['brake']] ?>
                  </div>
                </td>
                <td class="result-table-cell">
                  <div class="inside-cell">
                    <span style="font-weight: bold">
                      <?php echo $team['weight'] ?>
                       [kg]
                    </span>
                  </div>
                </td>
              </tr>

              <?php
            }
          ?>
        </table>
      </div>


      <?php
        if ($_SESSION['rights'] == 'nr') {

          ?>
          <button id="upload-files-button" type="button" name="button2" style="margin-bottom: 10px">Upload files</button>
          <div class="upload-files-container">
            <div class="upload-files">
              <form action="../handlers/upload_file.php" method="post" enctype="multipart/form-data">
                <div class="form-container-files">
                  <span style="margin-bottom: 20px">Select file to upload: </span>
                  <div class="form-input-div">
                    <input type="file" name="result-file" required>
                  </div>
                  <span style="margin-top: 10px; margin-bottom: 10px">Link text:</span>
                  <div class="form-input-div">
                    <input type="text" name="link-text" value="" required>
                  </div>
                  <input type="submit" name="upload-file" value="Upload">
                </div>
              </form>
            </div>
          </div>

          <?php
        }
        ?>
        <div class="links">

        <?php
          $query = "SELECT * FROM results ORDER BY time DESC";
          $res = mysqli_query($date, $query);

          while ($result = mysqli_fetch_array($res, MYSQL_ASSOC)) {
            ?>
            <div class="link">
              <?php
                if ($_SESSION['rights'] == 'nr') {
                  ?>
                    <div class="delete-file" onclick="deleteFile(<?php echo $result['id']; ?>, '<?php echo $result['uri']; ?>')">
                      <img class="delete-file-icon" src="../images/delete.png" alt="">
                    </div>
                  <?php
                }
              ?>
              <span><?php echo $result['text'] ?> - </span>
              <a href="../result_files/<?php echo $result['uri']; ?>" download><?php echo $result['uri']; ?></a>
            </div>

        <?php
        }
      ?>




        </div>


      <!-- <iframe src="https://docs.google.com/document/d/e/2PACX-1vQBc1gQi1hoiSvjqCyh5_yG4Ac5EYn22GrcTHyem6Z-OHMQ1-Wee7dgLgdOVypjlhBquhtUxObqVfnN/pub?embedded=true"></iframe> -->
    </div>
  </body>
</html>
