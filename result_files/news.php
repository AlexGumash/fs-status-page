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
    <script type="text/javascript">
      function deleteNewsFile(id, filename) {
        $.ajax({
          type: "post",
          url: "../handlers/delete_news_file.php",
          data: {news_id: id, file: filename},
          beforeSend: function(){
            var parentLink = event.target.parentElement.parentElement;
            parentLink.classList.add('hide');
          }
        }).done(function(result){
          console.log(result);
        })

      }

      function deleteNews(id) {
        $.ajax({
          type: "post",
          url: "../handlers/delete_news.php",
          data: {news_id: id},
          beforeSend: function(){
            var parentNews = event.target.parentElement.parentElement;
            parentNews.classList.add('hide');
          }
        }).done(function(result){
          console.log(result);
        })

      }

      function editNews(id) {
        var parentNews = event.target.parentElement.parentElement;
        $.ajax({
          url: 'pages/edit_news.php',
          data: {news_id: id},
          cache: true,
          success: function(html){
            $(parentNews).html(html);
          }
        });
      }


    </script>
  </head>
  <body>
    <div class="container-page">

      <?php
        if ($_SESSION['rights'] == 'nr') {
          ?>
          <div class="create-news">
            <button id="create-news-button" type="button" name="button">Create news</button>
            <!-- <div id="create-news-button" class="create-news-button">
              <span>Create news</span>
            </div> -->

            <div class="create-news-form">

              <form class="" action="../handlers/create_news.php" method="post" enctype="multipart/form-data">
                <div class="form-container">

                  <div class="form-input-div-textarea" style="margin-bottom: 20px">
                    <span style="margin-bottom: 10px">Title:</span>
                    <input type="text" name="title" value="" style="width:50%" required>
                  </div>

                  <div class="form-input-div-textarea" style="margin-bottom: 20px">
                    <span style="margin-bottom: 10px">Content:</span>
                    <textarea name="content" rows="8" style="width: 100%; resize: none" required></textarea>
                  </div>

                  <div class="form-input-div-textarea" style="margin-bottom: 20px">
                    <span style="margin-bottom: 10px">Files:</span>
                    <input type="file" name="news-files[]" multiple>
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
            $datetime = $news_item['time'];
            $datetime_arr = explode(" ", $datetime);
            $news_date = $datetime_arr[0];
            $time = $datetime_arr[1];
            $date_arr = explode("-", $news_date);
            $time_arr = explode(":", $time);
            ?>
            <div class="news_item">

              <div class="news_item_header">
                <span style="font-weight: bold"><?php echo $news_item['title']; ?></span>
              </div>

              <div class="news_item_info">
                <span><?php echo $date_arr[2]?><?php echo "-"; ?><?php echo $date_arr[1]; ?></span>
                <span><?php echo " "; ?><?php echo $time_arr[0]?><?php echo ":"; ?><?php echo $time_arr[1]; ?></span>
              </div>

              <div class="news_item_content">
                <span><?php echo $news_item['content']; ?></span>
              </div>

              <div class="news-files-list">
                <?php
                $news_id = $news_item['id'];
                $query = "SELECT * FROM news_files WHERE news_id = $news_id";
                $result = mysqli_query($date, $query);
                while ($news_file = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                  ?>

                  <div class="news-file">
                    <a href="../result_files/<?php echo $news_file['file']; ?>" download><?php echo $news_file['file']; ?></a>
                  </div>

                  <?php
                }
                ?>
              </div>

              <?php
                if ($_SESSION['rights'] == 'nr') {
                  ?>
                    <div class="edit-delete">
                      <span style="text-decoration: underline; cursor: pointer" onclick="editNews(<?php echo $news_item['id']; ?>)">edit</span>
                      <span> | </span>
                      <span style="text-decoration: underline; cursor: pointer" onclick="deleteNews(<?php echo $news_item['id']; ?>)">delete</span>
                    </div>
                  <?php
                }
              ?>

            </div>
        <?php
          }
        ?>
      </div>

    </div>
  </body>
</html>
