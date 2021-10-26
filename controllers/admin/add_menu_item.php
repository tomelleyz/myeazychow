<?php
  // Import db connection file
  require_once "../config/db_connect.php";

  // Initialize form data with empty values
  $add_menu_item_name = "";
  $add_menu_item_category = "";
  $add_menu_item_description = "";
  $add_menu_item_qty = "";
  $add_menu_item_price = "";
  $add_menu_item_img = "";
  $add_menu_item_msg = "";

  // Process form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_menu_item"])) {
    $add_menu_item_name = trim($_POST["menu_item_name"]);
    $add_menu_item_category = $_POST["menu_item_category"];
    $add_menu_item_description = trim($_POST["menu_item_description"]);
    $add_menu_item_qty = $_POST["menu_item_qty"];
    $add_menu_item_price = trim($_POST["menu_item_price"]);
    $menu_item_img_filename = $_FILES["menu_item_img"]["name"];
    $menu_item_img_tempname = $_FILES["menu_item_img"]["tmp_name"];    
    $menu_item_img_folder = "../uploads/".$menu_item_img_filename;

    $sql = "INSERT INTO menuitems (menu_name, category, `description`, qty_in_stock, buy_price, menu_item_img)
    VALUES ('$add_menu_item_name', '$add_menu_item_category', '$add_menu_item_description', '$add_menu_item_qty', '$add_menu_item_price', '$menu_item_img_filename')";

    $result = mysqli_query($conn, $sql);
    
    if ($result) {
      if (!file_exists("../uploads/" . $menu_item_img_filename)){
        move_uploaded_file($menu_item_img_tempname, $menu_item_img_folder);
      }
      $add_menu_item_msg = "New menu item added!";
    } else {
      $add_menu_item_msg = "Failed to add menu item.";
    }
  }

?>