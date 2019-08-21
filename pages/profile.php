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
      <div class="">
        <form class="" action="../handlers/loginout.php" method="post">
          <div class="form-container">
            <div class="form-input-div">
              <span>Login:</span>
              <input type="text" name="login" value="">
            </div>

            <div class="form-input-div">
              <span>Pass:</span>
              <input type="password" name="password" value="">
            </div>

            <input type="submit" name="submit-button-entry" value="Submit">
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
