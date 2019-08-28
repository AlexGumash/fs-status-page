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
    <script type="text/javascript" src='../scripts/toggle.js'></script>
  </head>
  <body>
    <div class="container-page">

      <div class="page-title">
        News
      </div>

      <?php
        if ($_SESSION['rights'] == 'nr') {
          ?>
          <div class="create-news">
            <button id="create-news-button" type="button" name="button">Create news</button>
            <!-- <div id="create-news-button" class="create-news-button">
              <span>Create news</span>
            </div> -->

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






      <div class="content">
        <?php
          $query = "SELECT * FROM news ORDER BY time DESC";
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
