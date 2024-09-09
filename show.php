<?php require('layout/header.php'); ?>

<?php
$job_id = $_GET['id'];
$query = "SELECT * FROM jobs WHERE id = $job_id";
$result = mysqli_query($conn, $query);
$job = mysqli_fetch_assoc($result);

// Handle deletion if the form is submitted
if (isset($_POST['delete'])) {
    $delete_query = "DELETE FROM jobs WHERE id = $job_id";
    if (mysqli_query($conn, $delete_query)) {
        // Redirect after deletion
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
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

    <!-- Edit and Delete Buttons -->
    <div class="mt-6 flex space-x-4">
        <a href="edit.php?id=<?php echo $job_id; ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md focus:outline-none transition duration-300">
            <i class="fas fa-edit mr-2"></i> Edit
        </a>

        <!-- Delete Button Triggering Modal -->
        <button id="deleteBtn"
            class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75 transition duration-300">
            <i class="fas fa-trash-alt mr-2"></i> Delete
        </button>
    </div>
</div>

<!-- Modal for Delete Confirmation -->
<div id="deleteModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-4">Confirm Deletion</h2>
        <p class="text-gray-700 mb-6">Are you sure you want to delete this job? This action cannot be undone.</p>
        <div class="flex justify-end space-x-4">
            <button id="cancelBtn" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Cancel</button>
            <form method="POST" class="inline">
                <button type="submit" name="delete" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Delete</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Show the delete modal when the Delete button is clicked
    document.getElementById('deleteBtn').addEventListener('click', function() {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    });

    // Hide the delete modal when the Cancel button is clicked
    document.getElementById('cancelBtn').addEventListener('click', function() {
        document.getElementById('deleteModal').classList.remove('flex');
        document.getElementById('deleteModal').classList.add('hidden');
    });
</script>

<?php require('layout/footer.php'); ?>
