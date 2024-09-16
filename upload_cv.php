<?php

require('layout/header.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please log in.");
}

$user_id = $_SESSION['user_id'];
$job_id = $_GET['job_id'];

// Check if the user has passed the quiz
$application_query = "SELECT * FROM applications WHERE user_id = $user_id AND job_id = $job_id AND passed = 1";
$application_result = mysqli_query($conn, $application_query);
$application = mysqli_fetch_assoc($application_result);

if (!$application) {
    die("You haven't passed the quiz for this job or have already applied.");
}

// Handle CV upload
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] == 0) {
        // File upload handling
        $file_name = $_FILES['cv']['name'];
        $file_tmp = $_FILES['cv']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        // Allowed file types: PDF
        if ($file_ext === 'pdf') {
            // Generate unique file name and move the file to the uploads directory
            $new_file_name = uniqid() . '.pdf';
            $upload_dir = 'uploads/cv/';
            move_uploaded_file($file_tmp, $upload_dir . $new_file_name);

            // Update the application record with the uploaded CV path
            $cv_path = $new_file_name;
            $update_query = "UPDATE applications SET uploaded_cv = '$cv_path' WHERE user_id = $user_id AND job_id = $job_id";
            mysqli_query($conn, $update_query);

            $_SESSION['message'] = "CV uploaded successfully!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Only PDF files are allowed.";
            $_SESSION['message_type'] = "error";
        }

        // Redirect to the same page after submission
        header("Location: upload_cv.php?job_id=$job_id");
        exit();
    } else {
        $_SESSION['message'] = "Error uploading file.";
        $_SESSION['message_type'] = "error";
    }
}

// Display message if set
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;
$message_type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : null;
unset($_SESSION['message']);
unset($_SESSION['message_type']);
?>

<div class="container mx-auto p-6 my-3">
    <h1 class="text-3xl font-bold mb-4">Upload Your CV</h1>

    <!-- Show success/error message -->
    <?php if ($message): ?>
        <div class="bg-<?php echo $message_type == 'success' ? 'green' : 'red'; ?>-500 text-white p-4 rounded mb-4">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <!-- CV Upload Form -->
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-4">
            <label class="block text-gray-700">Upload CV (PDF only):</label>
            <input type="file" name="cv" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Upload CV</button>
    </form>
</div>

<?php require('layout/footer.php'); ?>
