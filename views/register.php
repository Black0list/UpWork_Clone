<div class="card p-4 shadow-lg" style="width: 400px;">
    <h3 class="text-center">Register</h3>
    <form id="registerForm" method="POST" action="/auth/register" novalidate>
        <div class="mb-3">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" name="firstname" id="firstname" required pattern="^[A-Za-z]+$">
            <div class="invalid-feedback">Please enter a valid first name (letters only).</div>
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="lastname" id="lastname" required pattern="^[A-Za-z]+$">
            <div class="invalid-feedback">Please enter a valid last name (letters only).</div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
            <div class="invalid-feedback">Please enter a valid email.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" required minlength="6">
            <div class="invalid-feedback">Password must be at least 6 characters.</div>
        </div>
        <div class="mb-3">
            <label for="Cpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="Cpassword" id="Cpassword" required>
            <div class="invalid-feedback">Passwords do not match.</div>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" name="role" id="role" required>
                <option value="client">Client</option>
                <option value="freelancer" selected>Freelancer</option>
            </select>
            <div class="invalid-feedback">Please select a role.</div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
    <div class="text-center mt-3">
        <a href="login">Already have an account? Login</a>
    </div>
</div>