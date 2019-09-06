<?php include '../database/connection.php' ?>
<?php

function deletefile($directory,$filename)  {
  $dir = opendir($directory);
  while(($file = readdir($dir))) {
    if ((is_file("$directory/$file")) && ("$directory/$file" == "$directory/$filename")) {
      unlink("$directory/$file");
      if (!file_exists($directory."/".$filename)) {
        return $s = TRUE;
      };
    };
  };
  closedir($dir);
};

?>
<?php
  $news_id = $_REQUEST['news_id'];

  $query = "SELECT * FROM news_files WHERE news_id = $news_id";
  $result = mysqli_query($date, $query);
  while ($news_file = mysqli_fetch_array($result, MYSQL_ASSOC)) {
    deleteFile('../result_files', $news_file['file']);
  }

  $query = "DELETE FROM news_files WHERE news_id = '$news_id'";
  $result = mysqli_query($date, $query);

  $query = "DELETE FROM news WHERE id = '$news_id'";
  $result = mysqli_query($date, $query);


?>
