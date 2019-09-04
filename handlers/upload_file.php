<?php
  include '../database/connection.php';
  include '../scripts/translit.php';
?>
<?php

if(isset($_FILES['result-file'])){
  $errors= array();
  $file_name = $_FILES['result-file']['name'];
  $file_name = str2url($file_name);

  $file_size =$_FILES['result-file']['size'];
  $file_tmp =$_FILES['result-file']['tmp_name'];
  $file_type=$_FILES['result-file']['type'];
  if(empty($errors)==true){
    move_uploaded_file($file_tmp,"../result_files/".$file_name);
  } else {
    print_r($errors);
  }

  $text = $_REQUEST['link-text'];

  $query = "INSERT INTO results (id, text, uri, time) VALUES (NULL, '$text', '$file_name', NULL)";
		$result = mysqli_query($date, $query);
    if (!$result) {
      echo mysqli_error($date);
    }

  header('Location: ../index.php');
}

?>
