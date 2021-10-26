<?php
  // Import db connection file
  require_once "../config/db_connect.php";

  $delete_menu_cat_msg = "";

  // Process form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_menu_cat"])) {
    $menu_cat_id = (int)$_POST["delete_menu_cat_id"];

    $sql = "DELETE from menucategory WHERE menucat_id=".$menu_cat_id."";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $delete_menu_cat_msg = "Menu category successfully deleted!";
    } else {
      echo "Failed to delete menu category.";
    }
  }

?>