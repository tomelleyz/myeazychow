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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
  <?php include "../includes/header.php"; ?>
  <?php require_once "../config/db_connect.php"; ?>
  <div class="d-flex align-items-start">
    <div class="nav flex-column nav-pills bg-light text-dark min-vh-100" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      
      <div class="bg-secondary text-white rounded px-4 py-3 mx-4 my-5">
        <h3>Welcome <?php echo $_SESSION["firstname"]; ?></h3>
        <p><?php echo $_SESSION["job_title"]; ?></p>
        <p><?php echo $_SESSION["email"]; ?></p>
      </div>
      

      <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Menu Categories</button>
      <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Menu Items</button>
    </div>
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active p-5" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        <!-- Add New Category Button and Modal/Form -->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#addNewMenuCategoryModal">
          Add New Menu Category
        </button>

        <!-- Add New Category Modal Modal/Form -->
        <div class="modal fade" id="addNewMenuCategoryModal" tabindex="-1" aria-labelledby="addNewMenuCategoryModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addNewMenuCategoryModalLabel">Add New Menu Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="mb-3">
                    <label for="menuCategoryName" class="form-label">Menu Category Name: </label>
                    <input type="text" id="menuCategoryName" class="form-control" name="menu_cat_name" placeholder="Name" required/>
                  </div>
                  <div class="mb-4">
                    <label for="menuCategoryImage" class="form-label">Upload menu category image: </label>
                    <input type="file" id="menuCategoryImage" class="form-control" name="menu_cat_img" required/>
                  </div>

                  <p><?php echo $add_menu_cat_msg; ?></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" id="add_menu_cat" name="add_menu_cat">Create Menu category</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        
        <!-- Retrieve all menu categories -->
        <section class="row d-flex align-items-stretch">
          <?php require_once "../controllers/admin/get_all_menu_cat.php"; ?>
        </section>
      </div>
      <div class="tab-pane fade p-5" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
        <!-- Add New Menu item Button and Modal/Form -->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#addNewMenuItemModal">
          Add New Menu Item
        </button>

        <!-- Add New Menu Item Modal/Form -->
        <div class="modal fade" id="addNewMenuItemModal" tabindex="-1" aria-labelledby="addNewMenuItemModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addNewMenuItemModalLabel">Add New Menu Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                <div class="modal-body">
                  <!-- Add new menu item -->
                  <div class="mb-3">
                    <label for="menuItemName" class="form-label">Menu Item Name: </label>
                    <input type="text" id="menuItemName" class="form-control" name="menu_item_name" placeholder="Name" required/>
                  </div>
                  <div class="mb-3">
                    <label for="menuItemCategory" class="form-label">Menu Item Category</label>
                    <select id="menuItemCategory" class="form-select" name="menu_item_category" required>
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
                  <div class="mb-3">
                    <label for="menuItemDescription" class="form-label">Menu Item Description: </label>
                    <input type="text" id="menuItemDescription" class="form-control" name="menu_item_description" placeholder="Description" required/>
                  </div>
                  <div class="mb-3">
                    <label for="menuItemQty" class="form-label">Menu Item Quantity: </label>
                    <input type="number" id="menuItemQty" class="form-control" name="menu_item_qty" placeholder="Quantity in stock" required/>
                  </div>
                  <div class="mb-3">
                    <label for="menuItemPrice" class="form-label">Menu Item Price: </label>
                    <input type="text" id="menuItemPrice" class="form-control" name="menu_item_price" placeholder="Buy price" required/>
                  </div>
                  <div class="mb-3">
                    <label for="menuItemImage" class="form-label">Upload menu item image: </label>
                    <input type="file" id="menuItemImage" class="form-control" name="menu_item_img" required/>
                  </div>

                  <p><?php echo $add_menu_item_msg; ?></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" id="add_menu_item" name="add_menu_item">Create Menu Item</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <section class="row d-flex align-items-stretch">
          <?php require_once "../controllers/admin/get_all_menu_items.php"; ?>
        </section>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>