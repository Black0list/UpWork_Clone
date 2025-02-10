<?php

if(isset($_SESSION['user'])){
   header('location: /home');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Authentification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    {{content}}
<script>
        function validateLogin() {
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!email || !password) {
                alert("All fields are required.");
                return false;
            }
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email.");
                return false;
            }
            return true;
        }

        document.getElementById('registerForm').addEventListener('submit', function(event) {
            let form = event.target;
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            if (document.getElementById('password').value !== document.getElementById('Cpassword').value) {
                document.getElementById('Cpassword').setCustomValidity("Passwords do not match.");
            } else {
                document.getElementById('Cpassword').setCustomValidity("");
            }
            form.classList.add('was-validated');
        });
    </script>

</body>
</html>