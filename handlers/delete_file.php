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
  $result_id = $_REQUEST['file_id'];

  $query = "DELETE FROM results WHERE id = '$result_id'";
  $result = mysqli_query($date, $query);
  if (!$result) {
    echo mysqli_error($date);
  } else {
    deleteFile('../result_files', $_REQUEST['file']);
  }

?>
