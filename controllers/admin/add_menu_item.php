<?php
  // Import db connection file
  require_once "../config/db_connect.php";

  // Initialize form data with empty values
  $add_menu_item_name = "";
  $add_menu_item_category = "";
  $add_menu_item_description = "";
  $add_menu_item_quantity = "";
  $add_menu_item_price = "";
  $add_menu_item_msg = "";

  // Process form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_menu_item"])) {
    $add_menu_item_name = trim($_POST["menu_item_name"]);
    $add_menu_item_category = $_POST["menu_item_category"];
    $add_menu_item_description = trim($_POST["menu_item_description"]);
    $add_menu_item_quantity = $_POST["menu_item_quantity"];
    $add_menu_item_price = trim($_POST["menu_item_price"]);

    $sql = "INSERT INTO menuitems (menu_name, category, `description`, qty_in_stock, buy_price)
    VALUES ('$add_menu_item_name', '$add_menu_item_category', '$add_menu_item_description', '$add_menu_item_quantity', '$add_menu_item_price')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      $add_menu_item_msg = "New menu item added!";
  
    } else {
      $add_menu_item_msg = "Failed to add menu item.";
    }
  }

?>