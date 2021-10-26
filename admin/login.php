<?php require_once "../controllers/admin/admin_login.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EazyChow | Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
  <?php include "../includes/header.php"; ?>
  <div class="container">
    <div class="d-flex min-vh-100 align-items-center justify-content-center">
      <div class="col-12 col-md-6 col-lg-5 col-xl-4">
        <div class="bg-light shadow-sm rounded px-5 pt-4 pb-5">
          <h2 class="mb-4">Admin Login</h2>
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="mb-3"> 
              <label for="emailField" class="form-label">Email: </label>
              <input 
                type="email" 
                id="emailField" 
                class="form-control" 
                name="email" 
                placeholder="Enter your email" 
                required 
              />
            </div>
            <div class="mb-4">
              <label for="passowrdField" class="form-label">Password: </label>
              <input 
                type="password" 
                id="passwordField" 
                class="form-control" 
                name="password" 
                placeholder="Enter your password" 
                required 
              />
            </div>
            <button type="submit" class="btn btn-primary w-100">Log In</button>
          </form> 
        </div>
      </div>
    </div>
  </div>

  <?php include "../includes/footer.php"; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>