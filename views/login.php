<div class="card p-4 shadow-lg" style="width: 400px;">
  <h3 class="text-center">Login</h3>
  <form method="POST" action="/auth/login" onsubmit="return validateLogin()">
    <?php
    if (isset($_SESSION['message'])) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>Oups!</strong> ' . $_SESSION['message'] . '
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
      unset($_SESSION['message']);
    }
    ?>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" name="email" id="email">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" id="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  <div class="text-center mt-3">
    <a href="register">Don't have an account? Register</a>
  </div>
</div>