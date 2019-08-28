<?php
  session_start();
  include '../database/connection.php';
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
      <div class="page-title" style="margin-bottom: 20px;">
        Results
      </div>
      <?php
        if ($_SESSION['rights'] == 'nr') {

          ?>
          <button id="upload-files-button" type="button" name="button2" style="margin-bottom: 10px">Upload files</button>
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
