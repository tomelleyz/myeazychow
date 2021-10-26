<?php 
  session_start(); 

  if (!isset($_SESSION["logged_in"]) && !isset($_SESSION["is_admin"])) {
    header("Location: ../admin/login.php");
    exit;
  }
  
  require_once "../controllers/admin/add_menu_cat.php";
  require_once "../controllers/admin/edit_menu_cat.php";
  require_once "../controllers/admin/delete_menu_cat.php";
  require_once "../controllers/admin/add_menu_item.php";
  require_once "../controllers/admin/edit_menu_item.php";
  require_once "../controllers/admin/delete_menu_item.php";
  require_once "../controllers/logout.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EazyChow | Admin Dashboard</title>
</head>
<body>
  <?php require_once "../config/db_connect.php"; ?>
  <h1>Admin Homepage <?php echo $_SESSION["job_title"]; ?></h1>

  <!-- Retrieve all menu categories -->
  <section>
    <?php require_once "../controllers/admin/get_all_menu_cat.php"; ?>
  </section>

  <!-- Add new menu category -->
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
    <h2>Add New Menu Category</h2>
    <div>
      <label for="menuCategoryName" >Menu Category Name: </label>
      <input type="text" id="menuCategoryName" name="menu_cat_name" placeholder="Name" required/>
    </div>
    <div>
      <label for="menuCategoryImage" >Upload menu category image: </label>
      <input type="file" id="menuCategoryImage" name="menu_cat_img" required/>
    </div>
    <button type="submit" name="add_menu_cat" id="add_menu_cat">Create menu category</button>

    <p><?php echo $add_menu_cat_msg; ?></p>
  </form>

  <!-- Add new menu item -->
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
    <h2>Add New Menu Item</h2>
    <div>
      <label for="menuItemName" >Menu Item Name: </label>
      <input type="text" id="menuItemName" name="menu_item_name" placeholder="Name" required/>
    </div>
    <div>
      <label for="menuItemCategory">Menu Item Category</label>
      <select id="menuItemCategory" name="menu_item_category" required>
        <?php 
          $sql = "SELECT menucat_id, `name` from menucategory"; 
          
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
            while ($menu_categories = mysqli_fetch_assoc($result)) : ?> 
            <option value="<?php echo $menu_categories['name']; ?>"><?php echo $menu_categories['name']; ?></option>
            <?php endwhile;
          } else {?>
            <option value="No category">No category</option> <?php
          }
        ?>
      </select>
    </div>
    <div>
      <label for="menuItemDescription" >Menu Item Description: </label>
      <input type="text" id="menuItemDescription" name="menu_item_description" placeholder="Description" required/>
    </div>
    <div>
      <label for="menuItemQty" >Menu Item Quantity: </label>
      <input type="number" id="menuItemQty" name="menu_item_qty" placeholder="Quantity in stock" required/>
    </div>
    <div>
      <label for="menuItemPrice" >Menu Item Price: </label>
      <input type="text" id="menuItemPrice" name="menu_item_price" placeholder="Buy price" required/>
    </div>
    
    <button type="submit" name="add_menu_item" id="add_menu_item">Create menu item</button>

    <p><?php echo $add_menu_item_msg; ?></p>
  </form>

  <?php require_once "../controllers/admin/get_all_menu_items.php"; ?>

  <!-- Log out -->
  <form method="POST">
    <input type="submit" name="logout" id="logout" value="Log Out" />
  </form>
</body>
</html>