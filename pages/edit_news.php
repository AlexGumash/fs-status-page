<?php
  session_start();
  include '../database/connection.php';
?>
<?php
  $news_id = $_REQUEST['news_id'];
  $query = "SELECT * FROM news WHERE id = '$news_id'";
  $res = mysqli_query($date, $query);

  $news_item = mysqli_fetch_array($res, MYSQL_ASSOC);
  $datetime = $news_item['time'];
  $datetime_arr = explode(" ", $datetime);
  $news_date = $datetime_arr[0];
  $time = $datetime_arr[1];
  $date_arr = explode("-", $news_date);
  $time_arr = explode(":", $time);
?>

  <form class="" action="../handlers/edit_news.php?id=<?php echo $news_item['id']; ?>" method="post" style="width: 100%" enctype="multipart/form-data">

    <div class="news_item_header">
      <input type="text" name="new-title" value="<?php echo $news_item['title']; ?>" style="width: 50%">
    </div>

    <div class="news_item_content">
      <textarea name="new-content" rows="8" style="width: 95%; resize: none" required><?php echo $news_item['content']; ?></textarea>
    </div>

    <div class="form-input-div-textarea" style="margin-bottom: 20px">
      <input type="file" name="new-news-files[]" multiple>
    </div>

    <div class="news-files-list">
      <?php
      $news_id = $news_item['id'];
      $query = "SELECT * FROM news_files WHERE news_id = $news_id";
      $result = mysqli_query($date, $query);
      while ($news_file = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        ?>

        <div class="news-file">
          <div class="delete-file" onclick="deleteNewsFile(<?php echo $news_file['id']; ?>, '<?php echo $news_file['file']; ?>')">
            <img class="delete-file-icon" src="../images/delete.png" alt="">
          </div>
          <a href="../result_files/<?php echo $news_file['file']; ?>" download><?php echo $news_file['file']; ?></a>
        </div>

        <?php
      }
      ?>
    </div>
    <input type="submit" name="edit-submit" value="Submit changes">
  </form>
