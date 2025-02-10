<form method="POST" action="/auth/register">
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
        <div class="mb-3">
            <label for="firstname" class="form-label">firstname</label>
            <input type="firstname" class="form-control" name="firstname" id="firstname" aria-describedby="firstnameHelp">
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">lastname</label>
            <input type="lastname" class="form-control" name="lastname" id="lastname" aria-describedby="lastnameHelp">
        </div>
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelp">
    </div>
    <div class="mb-3">
        <label for="Cpassword" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="Cpassword" id="Cpassword" aria-describedby="CpasswordHelp">
    </div>
    <div class="mb-3">
        <select name="role" required>
            <option value="client">Client</option>
            <option value="freelancer" selected>Freelancer</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>