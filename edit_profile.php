<?php require('layout/header.php') ?>

<?php
// Fetch user details
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Handle profile update form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // File upload handling
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $file_name = $_FILES['profile_pic']['name'];
        $file_tmp = $_FILES['profile_pic']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_exts = array('jpg', 'jpeg', 'png', 'gif');
        
        if (in_array($file_ext, $allowed_exts)) {
            $new_file_name = uniqid() . '.' . $file_ext;
            $upload_dir = 'uploads/profile_pics/';
            move_uploaded_file($file_tmp, $upload_dir . $new_file_name);

            // Update profile_pic in database
            $profile_pic = $new_file_name;
        } else {
            echo "Invalid file type. Only JPG, PNG, and GIF files are allowed.";
            $profile_pic = $user['profile_pic']; // Use the current profile pic if upload fails
        }
    } else {
        $profile_pic = $user['profile_pic']; // No new file uploaded, retain old profile picture
    }

    // Update user information in the database
    $update_query = "UPDATE users SET username = '$username', email = '$email', profile_pic = '$profile_pic' WHERE id = $user_id";
    if (mysqli_query($conn, $update_query)) {
        $_SESSION['message'] = "Profile updated successfully!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error updating profile.";
        $_SESSION['message_type'] = "error";
    }

    // Refresh the page to show updated profile
    header("Location: edit_profile.php");
    exit();
}

// Display message if set
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;
$message_type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : null;
unset($_SESSION['message']);
unset($_SESSION['message_type']);
?>

<div class="container mx-auto p-6 my-3">
    <h1 class="text-3xl font-bold mb-4">Edit Profile</h1>

    <!-- Show success/error message -->
    <?php if ($message): ?>
        <div class="bg-<?php echo $message_type == 'success' ? 'green' : 'red'; ?>-500 text-white p-4 rounded mb-4">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <!-- Profile Update Form -->
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-4">
            <label class="block text-gray-700">Username</label>
            <input type="text" name="username" value="<?php echo $user['username']; ?>" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Profile Picture</label>
            <input type="file" name="profile_pic" class="w-full p-2 border border-gray-300 rounded">
            <?php if ($user['profile_pic']): ?>
                <img src="uploads/profile_pics/<?php echo $user['profile_pic']; ?>" alt="Profile Picture" class="mt-4 h-32 w-32 object-cover rounded-full">
            <?php endif; ?>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Profile</button>
    </form>
</div>

<?php require('layout/footer.php'); ?>
