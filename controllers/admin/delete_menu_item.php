<?php
  // Import db connection file
  require_once "../config/db_connect.php";

  $delete_menu_item_msg = "";

  // Process form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_menu_item"])) {
    $menu_item_id = (int)$_POST["menu_item_id"];

    $sql = "DELETE from menuitems WHERE menu_id=".$menu_item_id."";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      $delete_menu_item_msg = "Menu item successfully deleted!";
    } else {
      $delete_menu_item_msg = "Failed to delete menu item.";
    }
  }

?>