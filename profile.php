<?php require('layout/header.php') ?>

<?php

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Access denied. You must be logged in to view your profile.");
}


$user_id = $_SESSION['user_id'];
$is_company = $_SESSION['is_company'];

// Fetch user details
$query = "SELECT username, email, is_company FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// If the user is a company, fetch the jobs they created
if ($is_company) {
    $jobs_query = "SELECT id, title, salary, job_type, deadline FROM jobs WHERE created_by = $user_id";
    $jobs_result = mysqli_query($conn, $jobs_query);
    $jobs = mysqli_fetch_all($jobs_result, MYSQLI_ASSOC);
}


?>



<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Profile: <?php echo $user['username']; ?></h1>
    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
    <p><strong>Account Type:</strong> <?php echo $user['is_company'] ? 'Company' : 'Job Seeker'; ?></p>

    <?php if ($is_company): ?>
        <h2 class="text-2xl font-bold mt-8">Jobs You Have Created</h2>
        <div class="mt-4">
            <?php if (!empty($jobs)): ?>
                <?php foreach ($jobs as $job): ?>
                    <div class="bg-white shadow-md p-4 rounded mb-4">
                        <h3 class="text-xl font-semibold"><?php echo $job['title']; ?></h3>
                        <p class="text-gray-600">Salary: <?php echo $job['salary']; ?> BDT</p>
                        <p class="text-gray-600">Job Type: <?php echo $job['job_type']; ?></p>
                        <p class="text-gray-600">Deadline: <?php echo $job['deadline']; ?></p>
                        <a href="show.php?id=<?php echo $job['id']; ?>" class="text-blue-500 hover:underline mr-2">View Details</a>
                        <a href="edit.php?id=<?php echo $job['id']; ?>" class="text-blue-500 hover:underline">Edit Job</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>You haven't created any jobs yet.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<?php require('layout/footer.php') ?>

