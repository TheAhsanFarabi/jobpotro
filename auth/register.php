<?php
require('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $is_company = isset($_POST['is_company']) ? 1 : 0;

    // Check if username or email already exists
    $check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        // If username or email is already taken, redirect with an error
        header("Location: ../index.php?error=duplicate");
        exit();
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the user into the database
        $query = "INSERT INTO users (username, email, password, is_company) 
                  VALUES ('$username', '$email', '$hashed_password', '$is_company')";

        if (mysqli_query($conn, $query)) {
            // Redirect to the registration page with a success query parameter
            header("Location: ../index.php?success=true");
            exit();
        } else {
            // Handle other errors here
            header("Location: ../index.php?error=true");
            exit();
        }
    }
}
?>
