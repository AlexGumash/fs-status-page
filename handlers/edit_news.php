<?php
include '../database/connection.php';
include '../scripts/translit.php';
?>
<?php
session_start();


function incoming_files() {
    $files = $_FILES;
    $files2 = array();
    foreach ($files as $input => $infoArr) {
        $filesByInput = array();
        foreach ($infoArr as $key => $valueArr) {
            if (is_array($valueArr)) { // file input "multiple"
                foreach($valueArr as $i=>$value) {
                    $filesByInput[$i][$key] = $value;
                }
            }
            else { // -> string, normal file input
                $filesByInput[] = $infoArr;
                break;
            }
        }
        $files2 = array_merge($files2,$filesByInput);
    }
    $files3 = array();
    foreach($files2 as $file) { // let's filter empty & errors
        if (!$file['error']) $files3[] = $file;
    }
    return $files3;
}


if (isset($_REQUEST['edit-submit'])) {
  $title = $_REQUEST['new-title'];
  $content = $_REQUEST['new-content'];
  $news_id = $_REQUEST['id'];

  $query = "UPDATE news SET time = NULL, title = '$title', content = '$content' WHERE id = '$news_id'";
  $result = mysqli_query($date, $query);
  if (!$result) {
    echo mysqli_error($date);
  }

  if(isset($_FILES['new-news-files'])){
    $files2 = incoming_files();
    foreach ($files2 as $key1 => $value1) {
      $file_tmp = $value1['tmp_name'];
      $file_name = $value1['name'];
      $file_name = str2url($file_name);
      move_uploaded_file($file_tmp,"../result_files/".$file_name);
      $query = "INSERT INTO news_files VALUES (NULL, $news_id , '$file_name')";
      $result = mysqli_query($date, $query);
      if (!$result) {
        echo mysqli_error($date);
      }
    }

  }

  header('Location: ../index.php');
}


?>
