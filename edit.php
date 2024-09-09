<?php
require('layout/header.php');


// Check if the user is logged in and if they are a company user
if (!isset($_SESSION['user_id']) || $_SESSION['is_company'] != 1) {
    die("Access denied. Only companies can edit job posts.");
}

// Database connection
$connection = mysqli_connect('localhost', 'root', '', 'jobpotro');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the job ID from the URL
$job_id = $_GET['id'];
$created_by = $_SESSION['user_id']; // Get the logged-in user's ID

// Fetch the job details (ensure the user is the owner of the job)
$query = "SELECT * FROM jobs WHERE id = $job_id AND created_by = $created_by";
$result = mysqli_query($connection, $query);
$job = mysqli_fetch_assoc($result);

if (!$job) {
    die("You do not have permission to edit this job.");
}

// Handle form submission for updating the job
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $salary = mysqli_real_escape_string($connection, $_POST['salary']);
    $details = mysqli_real_escape_string($connection, $_POST['details']);
    $requirements = mysqli_real_escape_string($connection, $_POST['requirements']);
    $job_type = mysqli_real_escape_string($connection, $_POST['job_type']);
    $responsibility = mysqli_real_escape_string($connection, $_POST['responsibility']);
    $deadline = mysqli_real_escape_string($connection, $_POST['deadline']);

    // Update the job in the database
    $update_query = "UPDATE jobs SET 
                     title = '$title', 
                     salary = '$salary', 
                     details = '$details', 
                     requirements = '$requirements', 
                     job_type = '$job_type', 
                     responsibility = '$responsibility', 
                     deadline = '$deadline' 
                     WHERE id = $job_id AND created_by = $created_by";

    if (mysqli_query($connection, $update_query)) {
        $_SESSION['message'] = "Job updated successfully!";
        $_SESSION['message_type'] = "success";
        // Redirect after successful update
        //header("Location: show.php?id=$job_id");
        //exit();
    } else {
        $_SESSION['message'] = "Error updating job.";
        $_SESSION['message_type'] = "error";
    }
}

$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;
$message_type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : null;
unset($_SESSION['message']);
unset($_SESSION['message_type']);
?>

<div class="container mx-auto p-6 my-3">
    <h1 class="text-3xl font-bold mb-4">Edit Job: <?php echo $job['title']; ?></h1>

    <!-- Display Message (if any) -->
    <?php if ($message): ?>
        <div class="bg-<?php echo $message_type == 'success' ? 'green' : 'red'; ?>-500 text-white p-4 rounded mb-4">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-4">
            <label class="block text-gray-700">Job Title</label>
            <input type="text" name="title" value="<?php echo $job['title']; ?>" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Salary</label>
            <input type="text" name="salary" value="<?php echo $job['salary']; ?>" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Details</label>
            <textarea name="details" class="w-full p-2 border border-gray-300 rounded" required><?php echo $job['details']; ?></textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Requirements</label>
            <textarea name="requirements" class="w-full p-2 border border-gray-300 rounded"><?php echo $job['requirements']; ?></textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Job Type</label>
            <input type="text" name="job_type" value="<?php echo $job['job_type']; ?>" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Responsibility</label>
            <textarea name="responsibility" class="w-full p-2 border border-gray-300 rounded"><?php echo $job['responsibility']; ?></textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Deadline</label>
            <input type="date" name="deadline" value="<?php echo $job['deadline']; ?>" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Job</button>
    </form>
</div>

<?php require('layout/footer.php'); ?>
