<?php require('layout/header.php') ?>



<?php 

// Check if the user is logged in and if they are a company user
if (!isset($_SESSION['user_id']) || $_SESSION['is_company'] != 1) {
    die("Access denied. Only companies can create job posts.");
}
$message = NULL;
// Handle form submission for creating a job
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $requirements = mysqli_real_escape_string($conn, $_POST['requirements']);
    $job_type = mysqli_real_escape_string($conn, $_POST['job_type']);
    $responsibility = mysqli_real_escape_string($conn, $_POST['responsibility']);
    $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
    $created_by = $_SESSION['user_id']; // Get the logged-in user's ID

    // Insert the job into the jobs table
    $query = "INSERT INTO jobs (title, salary, details, requirements, job_type, responsibility, deadline, created_by) 
              VALUES ('$title', '$salary', '$details', '$requirements', '$job_type', '$responsibility', '$deadline', '$created_by')";

    if (mysqli_query($conn, $query)) {
        $message = "Job Created Successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

?>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Create a Job</h1>
<?php if($message) { ?>
    <div class="bg-green-500 my-2 shadow-lg"><?= $message ?></div>
<?php } ?>
    <form method="POST">
        <div class="mb-4">
            <label class="block text-gray-700">Job Title</label>
            <input type="text" name="title" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Salary</label>
            <input type="text" name="salary" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Details</label>
            <textarea name="details" class="w-full p-2 border border-gray-300 rounded" required></textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Requirements</label>
            <textarea name="requirements" class="w-full p-2 border border-gray-300 rounded"></textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Job Type</label>
            <input type="text" name="job_type" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Responsibility</label>
            <textarea name="responsibility" class="w-full p-2 border border-gray-300 rounded"></textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Deadline</label>
            <input type="date" name="deadline" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Job</button>
    </form>
</div>




<?php require('layout/footer.php') ?>