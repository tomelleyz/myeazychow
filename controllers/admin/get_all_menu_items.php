<?php
  // Import db connection file
  require_once "../config/db_connect.php";

  $menu_items = "";

  $sql = "SELECT menu_id, menu_name, category, `description`, qty_in_stock, buy_price from menuitems";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while($menu_items = mysqli_fetch_assoc($result)) : ?>
        <div>
          <h3>Menu Item Details:</h3>
          <p>Item name: <?php echo $menu_items['menu_name']; ?></p>
          <p>Item category: <?php echo $menu_items['category']; ?></p>
          <p>Item description: <?php echo $menu_items['description']; ?></p>
          <p>Item quantity in stock: <?php echo $menu_items['qty_in_stock']; ?></p>
          <p>Item buy price: <?php echo $menu_items['buy_price']; ?></p>
          
          <!-- Edit menu item form-->
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h2>Edit <?php echo $menu_items['menu_name']; ?> Menu Item</h2>
            <div>
              <label for="editMenuItemName" >Menu Item Name: </label>
              <input 
                type="text" 
                id="editMenuItemName" 
                name="edit_menu_item_name" 
                value="<?php echo $menu_items['menu_name']; ?>" 
                required
              />
            </div>
            <div>
              <label for="editMenuItemDescription">Menu Item Description</label>
              <input 
                type="text" 
                id="editMenuItemDescription" 
                name="edit_menu_item_description" 
                value="<?php echo $menu_items['description']; ?>" 
                required
              />
            </div>
            <div>
              <label for="editMenuItemQty">Menu Item Quantity</label>
              <input 
                type="number" 
                id="editMenuItemQty" 
                name="edit_menu_item_qty" 
                value="<?php echo $menu_items['qty_in_stock']; ?>" 
                required
              />
            </div>
            <div>
              <label for="editMenuItemPrice">Menu Item Price</label>
              <input 
                type="text" 
                id="editMenuItemPrice" 
                name="edit_menu_item_price" 
                value="<?php echo $menu_items['buy_price']; ?>" 
                required
              />
            </div>
            <input type="hidden" name="menu_item_id" value=<?php echo $menu_items['menu_id']; ?> />
            <button type="submit" name="edit_menu_item" id="edit_menu_item">Save changes</button>

            <p><?php echo $edit_menu_item_msg; ?></p>
          </form>

          <!-- Delete menu category form -->
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h2>Are you sure you want to delete <?php echo $menu_items['menu_name']; ?> Menu Item?</h2>
            
            <input type="hidden" name="menu_item_id" value=<?php echo $menu_items['menu_id']; ?> />
            <button type="submit" name="delete_menu_item" id="delete_menu_item">Yes, Delete</button>

            <p><?php echo $delete_menu_item_msg; ?></p>
          </form>          
        </div>
    <?php endwhile; ?>
  <?php
  } else {
    echo "No menu item has been added yet.";
  }
?>