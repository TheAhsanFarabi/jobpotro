<?php require('layout/header.php') ?>

<?php
$job_id = $_GET['id'];
$query = "SELECT * FROM jobs WHERE id = $job_id";
$result = mysqli_query($conn, $query);
$job = mysqli_fetch_assoc($result);
?>


<div class="container mx-auto p-6 my-3">
    <h1 class="text-4xl font-bold mb-4 text-primary flex items-center">
        <i class="fas fa-briefcase mr-2"></i> 
        <?php echo $job['title']; ?>
    </h1>
    <p class="text-gray-700 mb-2 flex items-center">
        <i class="fas fa-money-bill-wave mr-2"></i> 
        Salary: <?php echo $job['salary']; ?> BDT
    </p>
    <p class="text-gray-700 mb-2 flex items-center">
        <i class="fas fa-clipboard-list mr-2"></i> 
        Job Type: <?php echo $job['job_type']; ?>
    </p>
    <p class="text-gray-700 mb-4 flex items-center">
        <i class="fas fa-calendar-alt mr-2"></i> 
        Deadline: <?php echo $job['deadline']; ?>
    </p>
    <h2 class="text-xl font-semibold mb-2 text-primary">Job Details:</h2>
        <p class="text-gray-800 mb-4 "><?php echo nl2br($job['details']); ?></p>
    <div class="grid gap-3">
    <div class="bg-white shadow-lg rounded-lg p-6 lg:w-1/2">
        <h2 class="text-2xl font-semibold mb-2 text-primary">Requirements:</h2>
        <p class="text-gray-800 mb-4"><?php echo nl2br($job['requirements']); ?></p>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 lg:w-1/2">
        <h2 class="text-2xl font-semibold mb-2 text-primary">Responsibilities:</h2>
        <p class="text-gray-800 mb-4"><?php echo nl2br($job['responsibility']); ?></p>
    </div>
    </div>
    <button id="applyBtn"
        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 mt-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-300">
        <i class="fas fa-pen-alt mr-2"></i> <!-- FontAwesome Icon -->
        Apply and Take Quiz
    </button>
</div>


<?php require('layout/footer.php') ?>