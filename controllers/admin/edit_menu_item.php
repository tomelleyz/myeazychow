<?php
  // Import db connection file
  require_once "../config/db_connect.php";

  // Initialize form data with empty values
  $edit_menu_item_name = "";
  $edit_menu_item_description = "";
  $edit_menu_item_qty = "";
  $edit_menu_item_price = "";
  $menu_item_id = "";
  $edit_menu_item_msg = "";

  // Process form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_menu_item"])) {
    $edit_menu_item_name = trim($_POST["edit_menu_item_name"]);
    $edit_menu_item_description = trim($_POST["edit_menu_item_description"]);
    $edit_menu_item_qty = $_POST["edit_menu_item_qty"];
    $edit_menu_item_price = trim($_POST["edit_menu_item_price"]);
    $menu_item_id = (int)$_POST["menu_item_id"];

    $sql = "UPDATE menuitems 
    SET menu_name='$edit_menu_item_name', 
    `description`='$edit_menu_item_description', 
    qty_in_stock=".$edit_menu_item_qty.", 
    buy_price='$edit_menu_item_price' WHERE menu_id=".$menu_item_id."";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      $edit_menu_item_msg = "Menu item successfully updated!";
    } else {
      $edit_menu_item_msg = "Failed to update menu item.";
    }
  }

?>