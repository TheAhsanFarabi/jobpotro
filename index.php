<?php require('layout/header.php') ?>

<?php
$jobs_per_page = 6;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $jobs_per_page;

$total_jobs_query = "SELECT COUNT(*) AS total FROM jobs";
$total_jobs_result = mysqli_query($conn, $total_jobs_query);
$total_jobs_row = mysqli_fetch_assoc($total_jobs_result);
$total_jobs = $total_jobs_row['total'];
$total_pages = ceil($total_jobs / $jobs_per_page);
?>

<?php
$query = "SELECT id, title, salary, job_type, deadline FROM jobs ORDER BY created_at DESC LIMIT $offset, $jobs_per_page";
$result = mysqli_query($conn, $query);
$jobs = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Available Jobs</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php if (empty($jobs)): ?>
        <p>No jobs available at the moment.</p>
        <?php else: ?>
        <?php foreach ($jobs as $job): ?>
        <div class="bg-white shadow-md p-4 rounded">
            <h2 class="text-xl font-semibold"><?php echo $job['title']; ?></h2>
            <p class="text-gray-600">Salary: <?php echo $job['salary']; ?> BDT</p>
            <p class="text-gray-600">Job Type: <?php echo $job['job_type']; ?></p>
            <p class="text-gray-600">Deadline: <?php echo $job['deadline']; ?></p>
            <a href="show.php?id=<?php echo $job['id']; ?>" class="text-blue-500 hover:underline">View Details</a>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php include('components/pagination.php') ?>

</div>
<?php require('layout/footer.php') ?>