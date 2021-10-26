<?php
  // Import db connection file
  require_once "../config/db_connect.php";

  // Initialize form data with empty values
  $submitted_cat_name = "";
  $filename = "";
  $add_menu_cat_msg = "";

  // Process form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_menu_cat"])) {
    $filename = $_FILES["menu_cat_img"]["name"];
    $tempname = $_FILES["menu_cat_img"]["tmp_name"];    
    $folder = "../uploads/".$filename;
    $submitted_cat_name = trim($_POST["menu_cat_name"]);

    $sql = "INSERT INTO menucategory (`name`, `image`)
    VALUES ('$submitted_cat_name', '$filename')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      if (!file_exists("../uploads/" . $filename)){
        move_uploaded_file($tempname, $folder);
      }
      $add_menu_cat_msg = "New menu category added!";
  
    } else {
      $add_menu_cat_msg = "Failed to add menu category.";
    }
  }

?>