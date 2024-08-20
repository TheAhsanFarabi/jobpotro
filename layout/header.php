<?php
session_start();
require('config/db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobpotro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <header>
        <nav class="bg-gray-800 p-4">
            <div class="container mx-auto flex justify-between items-center">
                <a href="index.php" class="text-white hover:text-primary font-bold flex items-center space-x-2">
                    <!-- Font Awesome Icon -->
                    <i class="fas fa-briefcase text-xl"></i>
                    <span>Jobpotro</span>
                </a>

                <div class="space-x-4">
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="auth/logout.php" class="text-white hover:text-gray-300">Logout</a>
                    <?php if ($_SESSION['is_company']): ?>
                    <a href="create.php" class="text-white hover:text-gray-300">Create Job</a>
                    <?php endif; ?>
                    <?php else: ?>
                    <button onclick="openModal('loginModal')" class="text-white hover:text-gray-300">Login</button>
                    <button onclick="openModal('registerModal')"
                        class="text-white hover:text-gray-300">Register</button>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>

   <?php include('components/toasts.php') ?>
   <?php include('components/login.php') ?>
   <?php include('components/register.php') ?>




