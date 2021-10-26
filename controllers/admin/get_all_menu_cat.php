<?php
  // Import db connection file
  require_once "../config/db_connect.php";

  $menu_categories = "";

  $sql = "SELECT menucat_id, `name`, `image` from menucategory";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while($menu_categories = mysqli_fetch_assoc($result)) : ?>
        <div class="col-12 col-lg-6 h-100">
          <!-- Display Each Menu Category -->
          <div class="card mb-3 h-100">
            <div class="row g-0">
              <div class="col-md-4">
                <img 
                  src="<?php echo "../uploads/".$menu_categories['image']."";?>" 
                  class="img-fluid rounded-start" 
                  alt="<?php echo "".$menu_categories["name"]."";?>"
                />
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $menu_categories['name']; ?></h5>
                  <div class="d-flex mt-5 justify-content-end">

                    <!-- Button trigger modal for editing menu category -->
                    <button type="button" class="btn btn-primary me-3 px-4" data-bs-toggle="modal" data-bs-target="#editMenuCategoryModal-<?php echo $menu_categories['menucat_id']; ?>">
                      Edit
                    </button>
                    <!-- Button trigger modal for deleting menu category -->
                    <button type="button" class="btn btn-light px-4" data-bs-toggle="modal" data-bs-target="#deleteMenuCategoryModal-<?php echo $menu_categories['menucat_id']; ?>">
                      Delete
                    </button>

                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Edit Menu Category Modal -->
          <div class="modal fade" id="editMenuCategoryModal-<?php echo $menu_categories['menucat_id']; ?>" tabindex="-1" aria-labelledby="editMenuCategoryModal-<?php echo $menu_categories['menucat_id']; ?>Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editMenuCategoryModal-<?php echo $menu_categories['menucat_id']; ?>Label">
                    Edit <?php echo $menu_categories['name']; ?> Menu Category
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="editMenuCategoryName" class="form-label">Menu Category Name: </label>
                      <input 
                        type="text" 
                        id="editMenuCategoryName" 
                        class="form-control"
                        name="edit_menu_cat_name" 
                        value="<?php echo $menu_categories['name']; ?>" 
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <img 
                        src="<?php echo "../uploads/".$menu_categories['image']."";?>" 
                        alt="<?php echo "".$menu_categories["name"]."";?>" 
                        class="img-thumbnail w-50 h-50"
                      />
                      <div>
                        <label for="editMenuCategoryImage" class="form-label">Change menu category image: </label>
                        <input 
                          type="file" 
                          id="editMenuCategoryImage" 
                          class="form-control"
                          name="edit_menu_cat_img" 
                        />
                      </div>
                    </div>
                    <input type="hidden" name="menu_cat_id" value=<?php echo $menu_categories['menucat_id']; ?> />

                    <p><?php echo $edit_menu_cat_msg; ?></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit_menu_cat" id="edit_menu_cat" class="btn btn-primary">Save changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Delete Menu Category Modal -->
          <div class="modal fade" id="deleteMenuCategoryModal-<?php echo $menu_categories['menucat_id']; ?>" tabindex="-1" aria-labelledby="deleteMenuCategoryModal-<?php echo $menu_categories['menucat_id']; ?>Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteMenuCategoryModal-<?php echo $menu_categories['menucat_id']; ?>Label">
                    Are you sure you want to delete <?php echo $menu_categories['name']; ?> Menu Category?
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <div class="modal-body">
                    <input type="hidden" name="delete_menu_cat_id" value=<?php echo $menu_categories['menucat_id']; ?> />

                    <p><?php echo $delete_menu_cat_msg; ?></p>
                  
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Cancel</button>
                    <button type="submit" name="delete_menu_cat" id="delete_menu_cat" class="btn btn-danger">Yes, Delete</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
    <?php endwhile; ?>
  <?php
  } else {
    echo "No menu category has been created yet.";
  }
?>