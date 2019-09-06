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

  $query = "DELETE FROM news_files WHERE id = '$news_id'";
  $result = mysqli_query($date, $query);
  if (!$result) {
    echo mysqli_error($date);
  } else {
    deleteFile('../result_files', $_REQUEST['file']);
  }

?>
