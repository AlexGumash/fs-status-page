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
    </script>
  </head>
  <body>
    <div class="container-page">

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
              <span>Noise/rain test</span>
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
                <td class="result-table-cell"><?php echo $team['number'] ?></td>
                <td class="result-table-cell"><?php echo $team['uni'] ?></td>
                <td class="result-table-cell"><?php echo $team['name'] ?></td>
                <td class="result-table-cell"><?php echo $team['category'] ?></td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['pre_inspection']); ?>"><?php echo $team['pre_inspection'] ?></td>
                <td class="result-table-cell cross"></td>
                <td class="result-table-cell cross"></td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['m_inspection']); ?>"><?php echo $team['m_inspection'] ?></td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['tilt']); ?>"><?php echo $team['tilt'] ?></td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['noise']); ?>"><?php echo $team['noise'] ?></td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['brake']); ?>"><?php echo $team['brake'] ?></td>
                <td class="result-table-cell"><?php echo $team['weight'] ?></td>
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
                <td class="result-table-cell"><?php echo $team['number'] ?></td>
                <td class="result-table-cell"><?php echo $team['uni'] ?></td>
                <td class="result-table-cell"><?php echo $team['name'] ?></td>
                <td class="result-table-cell"><?php echo $team['category'] ?></td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['pre_inspection']); ?>"><?php echo $team['pre_inspection'] ?></td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['accumulator']); ?>"><?php echo $team['accumulator'] ?></td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['e_inspection']); ?>"><?php echo $team['e_inspection'] ?></td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['m_inspection']); ?>"><?php echo $team['m_inspection'] ?></td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['tilt']); ?>"><?php echo $team['tilt'] ?></td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['rain']); ?>"><?php echo $team['rain'] ?></td>
                <td class="result-table-cell" style="background-color: <?php echo getColor($team['brake']); ?>"><?php echo $team['brake'] ?></td>
                <td class="result-table-cell"><?php echo $team['weight'] ?></td>
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
