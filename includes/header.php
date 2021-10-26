<header class="px-5 py-3 bg-light text-dark d-flex align-items-center justify-content-between">
  <h3>EazyChow</h3>
  <?php if (isset($_SESSION["logged_in"]) && isset($_SESSION["is_admin"])) : ?>
  <!-- Log out -->
  <form method="POST">
    <input type="submit" class="btn btn-primary" name="logout" id="logout" value="Log Out" />
  </form>

  <?php endif; ?>
</header>