<?php
  // Import db connection file
  require_once "../config/db_connect.php";

  $menu_items = "";

  $sql = "SELECT menu_id, menu_name, category, `description`, qty_in_stock, buy_price, menu_item_img from menuitems";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while($menu_items = mysqli_fetch_assoc($result)) : ?>
        <div class="col-12 col-lg-6 h-100">
          <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4">
                <img 
                  src="<?php echo "../uploads/".$menu_items['menu_item_img']."";?>" 
                  class="img-fluid rounded-start" 
                  alt="<?php echo $menu_items['menu_name']; ?>"
                />
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $menu_items['menu_name']; ?></h5>
                  <p class="card-text">
                    <span class="text-muted">Description: </span>
                    <?php echo $menu_items['description']; ?>
                  </p>
                  <div class="d-flex justify-content-between">
                    <p class="card-text">
                      <span class="text-muted">Category: </span>
                      <?php echo $menu_items['category']; ?>
                    </p>
                    <p class="card-text">
                      <span class="text-muted">Quantity: </span>
                      <?php echo $menu_items['qty_in_stock']; ?>
                    </p>
                  </div>
                  <p class="card-text"><span class="text-muted">Price: </span>₦<?php echo $menu_items['buy_price']; ?></p>
                </div>
              </div>
            </div>
          </div>
          
          <div class="d-flex">
            <!-- Button trigger modal for editing menu items -->
            <button type="button" class="btn btn-primary px-4 me-3" data-bs-toggle="modal" data-bs-target="#editMenuItemModal-<?php echo $menu_items['menu_id']; ?>">
              Edit
            </button>

            <!-- Button trigger modal for deleting menu items -->
            <button type="button" class="btn btn-light px-4" data-bs-toggle="modal" data-bs-target="#deleteMenuItemModal-<?php echo $menu_items['menu_id']; ?>">
              Delete
            </button>
          </div>

          <!-- Edit Menu Items Modal/Form -->
          <div class="modal fade" id="editMenuItemModal-<?php echo $menu_items['menu_id']; ?>" tabindex="-1" aria-labelledby="editMenuItemModal-<?php echo $menu_items['menu_id']; ?>Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editMenuItemModal-<?php echo $menu_items['menu_id']; ?>Label">
                    Edit <?php echo $menu_items['menu_name']; ?> Menu Item
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="editMenuItemName" class="form-label">Menu Item Name: </label>
                      <input 
                        type="text" 
                        id="editMenuItemName" 
                        class="form-control"
                        name="edit_menu_item_name" 
                        value="<?php echo $menu_items['menu_name']; ?>" 
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="editMenuItemDescription" class="form-label">Menu Item Description</label>
                      <input 
                        type="text" 
                        id="editMenuItemDescription" 
                        class="form-control"
                        name="edit_menu_item_description" 
                        value="<?php echo $menu_items['description']; ?>" 
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="editMenuItemQty" class="form-label">Menu Item Quantity</label>
                      <input 
                        type="number" 
                        id="editMenuItemQty" 
                        class="form-control"
                        name="edit_menu_item_qty" 
                        value="<?php echo $menu_items['qty_in_stock']; ?>" 
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="editMenuItemPrice" class="form-label">Menu Item Price</label>
                      <input 
                        type="text" 
                        id="editMenuItemPrice" 
                        class="form-control"
                        name="edit_menu_item_price" 
                        value="<?php echo $menu_items['buy_price']; ?>" 
                        required
                      />
                    </div>
                    <input type="hidden" name="menu_item_id" value=<?php echo $menu_items['menu_id']; ?> />

                    <p><?php echo $edit_menu_item_msg; ?></p>
                  
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="edit_menu_item" id="edit_menu_item" class="btn btn-primary">Save changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Delete Menu Items Modal/Forms -->
          <div class="modal fade" id="deleteMenuItemModal-<?php echo $menu_items['menu_id']; ?>" tabindex="-1" aria-labelledby="deleteMenuItemModal-<?php echo $menu_items['menu_id']; ?>Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteMenuItemModal-<?php echo $menu_items['menu_id']; ?>Label">
                    Are you sure you want to delete <?php echo $menu_items['menu_name']; ?> Menu Item?
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <div class="modal-body">
                    <input type="hidden" name="menu_item_id" value=<?php echo $menu_items['menu_id']; ?> />

                    <p><?php echo $delete_menu_item_msg; ?></p>
                  
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Cancel</button>
                    <button type="submit" name="delete_menu_item" id="delete_menu_item" class="btn btn-danger">Yes, Delete</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
    <?php endwhile; ?>
  <?php
  } else {
    echo "No menu item has been added yet.";
  }
?>