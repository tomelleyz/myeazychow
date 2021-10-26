<?php
  // Import db connection file
  require_once "../config/db_connect.php";

  // Initialize form data with empty values
  $edit_menu_cat_name = "";
  $edit_menu_cat_filename = "";
  $menu_cat_id = "";
  $edit_menu_cat_msg = "";

  // Process form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_menu_cat"])) {
    $edit_menu_cat_filename = $_FILES["edit_menu_cat_img"]["name"];
    $edit_menu_cat_tempname = $_FILES["edit_menu_cat_img"]["tmp_name"];    
    $edit_menu_cat_folder = "../uploads/".$edit_menu_cat_filename;
    $edit_menu_cat_name = trim($_POST["edit_menu_cat_name"]);
    $menu_cat_id = (int)$_POST["menu_cat_id"];

    // Determine what to update depending on which fields were filled
    if (isset($_POST["edit_menu_cat_name"]) && !isset($_POST["edit_menu_cat_img"])) {
      $sql = "UPDATE menucategory SET `name`='$edit_menu_cat_name' WHERE menucat_id=".$menu_cat_id."";

      $result = mysqli_query($conn, $sql);

      if ($result) {
        $edit_menu_cat_msg = "Menu category successfully updated!";
      } else {
        echo "Failed to add menu category.";
      }

    } else {
      $sql = "UPDATE menucategory SET `name`='$edit_menu_cat_name', `image`='$edit_menu_cat_filename' WHERE menucat_id=".$menu_cat_id."";
      
      $result = mysqli_query($conn, $sql);

      if ($result) {
        if (!file_exists("uploads/" . $edit_menu_cat_filename)){
          move_uploaded_file($edit_menu_cat_tempname, $edit_menu_cat_folder);
          $edit_menu_cat_msg = "Menu category successfully updated!";
        }
    
      } else {
        echo "Failed to update menu category.";
      }
    }
  }

?>