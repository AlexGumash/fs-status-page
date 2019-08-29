<?php
  session_start();
  include '../database/connection.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
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
          } else {
        ?>
        <form class="" action="../handlers/loginout.php" method="post">
          <div class="form-container">
            <div class="profile-container">
              <div class="form-input-div" style="width:70%">
                <span>Login:</span>
                <input type="text" name="login" value="" required>
              </div>

              <div class="form-input-div" style="width:70%">
                <span>Pass:</span>
                <input type="password" name="password" value="" required>
              </div>

              <input type="submit" name="submit-button-entry" value="Submit">
            </div>
          </div>
        </form>
      <?php } ?>
      </div>
    </div>
  </body>
</html>
