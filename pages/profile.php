<?php
  session_start();
  include '../database/connection.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script type="text/javascript" src='../scripts/toggle.js'></script>
  </head>
  <body>
    <div class="container-page">
      <div class="" style="width: 100%">
        <?php
          if (isset($_SESSION['login']) && isset($_SESSION['rights'])) {
            ?>

            <form class="" action="../handlers/loginout.php" method="post">
              <div class="form-container">
                <div class="form-input-div" style="width: 40%">
                  <span>Login: </span>
                  <span><?php echo $_SESSION['login']; ?></span>
                </div>

                <input type="submit" name="submit-button-exit" value="Exit">
              </div>
            </form>
            <hr>

            <?php
              if ($_SESSION['rights'] == 'nr') {
                ?>
                <div class="create-news">
                  <!-- <div id="create-news-button" class="create-news-button">
                    <span>Create news</span>
                  </div> -->
                  <button id="create-news-button" type="button" name="button">Create news</button>

                  <div class="create-news-form">

                    <form class="" action="../handlers/create_news.php" method="post">
                      <div class="form-container">

                        <div class="form-input-div">
                          <span>Title:</span>
                          <input type="text" name="title" value="">
                        </div>

                        <div class="form-input-div-textarea">
                          <span>Content:</span>
                          <textarea name="content" rows="8" style="width: 100%" required></textarea>
                        </div>
                        
                        <input type="submit" name="submit-button-news" value="Submit">
                      </div>

                    </form>

                  </div>
                </div>
            <?php
              }

            ?>

            <?php
          } else {
        ?>
        <form class="" action="../handlers/loginout.php" method="post">
          <div class="form-container">
            <div class="form-input-div">
              <span>Login:</span>
              <input type="text" name="login" value="" required>
            </div>

            <div class="form-input-div">
              <span>Pass:</span>
              <input type="password" name="password" value="" required>
            </div>

            <input type="submit" name="submit-button-entry" value="Submit">
          </div>
        </form>
      <?php } ?>
      </div>
    </div>
  </body>
</html>
