<?php
  // Import db connection file
  require_once "../config/db_connect.php";

  $menu_categories = "";

  $sql = "SELECT menucat_id, `name`, `image` from menucategory";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while($menu_categories = mysqli_fetch_assoc($result)) : ?>
        <div>
          <p>Category name:<?php echo $menu_categories['name']; ?></p>
          <img 
            src="<?php echo "../uploads/".$menu_categories['image']."";?>"
            alt="<?php echo "".$menu_categories["name"]."";?>"
          />
          
          <!-- Edit menu category form-->
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <h2>Edit <?php echo $menu_categories['name']; ?> Menu Category</h2>
            <div>
              <label for="editMenuCategoryName" >Menu Category Name: </label>
              <input 
                type="text" 
                id="editMenuCategoryName" 
                name="edit_menu_cat_name" 
                value="<?php echo $menu_categories['name']; ?>" 
                required
              />
            </div>
            <div>
              <img 
                src="<?php echo "../uploads/".$menu_categories['image']."";?>" 
                alt="<?php echo "".$menu_categories["name"]."";?>" 
              />
              <div>
                <label for="editMenuCategoryImage">Change menu category image: </label>
                <input 
                  type="file" 
                  id="editMenuCategoryImage" 
                  name="edit_menu_cat_img" 
                />
              </div>
            </div>
            <input type="hidden" name="menu_cat_id" value=<?php echo $menu_categories['menucat_id']; ?> />
            <button type="submit" name="edit_menu_cat" id="edit_menu_cat">Save changes</button>

            <p><?php echo $edit_menu_cat_msg; ?></p>
          </form>

          <!-- Delete menu category form -->
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h2>Are you sure you want to delete <?php echo $menu_categories['name']; ?> Menu Category?</h2>
            
            <input type="hidden" name="delete_menu_cat_id" value=<?php echo $menu_categories['menucat_id']; ?> />
            <button type="submit" name="delete_menu_cat" id="delete_menu_cat">Yes, Delete</button>

            <p><?php echo $delete_menu_cat_msg; ?></p>
          </form>          
        </div>
    <?php endwhile; ?>
  <?php
  } else {
    echo "No menu category has been created yet.";
  }
?>