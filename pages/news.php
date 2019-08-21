<?php
  session_start();
  include '../database/connection.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>FSR - News</title>
    <link rel="stylesheet" href="../styles/main.css">
  </head>
  <body>
    <div class="container-page">

      <div class="page-title">
        News
      </div>

      <div class="content">
        <?php
          $query = "SELECT * FROM news";
          $res = mysqli_query($date, $query);

          while ($news_item = mysqli_fetch_array($res, MYSQL_ASSOC)) {
            ?>
            <div class="news_item">

              <div class="news_item_header">
                <span><?php echo $news_item['title']; ?></span>
              </div>

              <div class="news_item_content">
                <span><?php echo $news_item['content']; ?></span>
              </div>
            </div>
        <?php
          }
        ?>
      </div>

    </div>
  </body>
</html>
