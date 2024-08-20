<?php
session_start();
require('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT id, username, password, is_company FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_company'] = $user['is_company'];

            // Redirect to the homepage or another page
            header("Location: ../index.php?login=true");
            exit();
        } else {
            // Incorrect password
            header("Location: ../index.php?error=true");
            exit();
        }
    } else {
        // No user found with that email
        header("Location: ../index.php?error=true");
        exit();
    }
}
?>
