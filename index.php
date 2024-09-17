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
$query = "SELECT jobs.*, users.id as user_id, users.profile_pic, users.username FROM jobs JOIN users ON users.id=jobs.created_by ORDER BY jobs.created_at DESC LIMIT $offset, $jobs_per_page";
$result = mysqli_query($conn, $query);
$jobs = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Fetch top companies
$top_companies_query = "SELECT id, username, profile_pic FROM users WHERE is_company = 1 ORDER BY id DESC LIMIT 5";
$top_companies_result = mysqli_query($conn, $top_companies_query);
$top_companies = mysqli_fetch_all($top_companies_result, MYSQLI_ASSOC);
?>


<!-- CSS for Fade Transition -->
<style>
    /* Fading animation */
    .fade {
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }

    .mySlides {
        display: none;
    }

    .mySlides.fade {
        opacity: 1;
    }

    /* Style for prev/next buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        margin-top: -22px;
        padding: 10px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 50%;
        user-select: none;
        background-color: #bbb;
    }

    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Dot indicators */
    .dot {
        cursor: pointer;
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .dot.active {
        background-color: #717171;
    }
</style>


<!-- Hero Section -->
<div class="relative overflow-hidden text-white py-20 px-6 bg-blue-500">
    <!-- Slideshow Container -->
    <div class="slideshow-container relative">

        <!-- Slide 1 -->
        <div class="mySlides fade">
            <div class="container mx-auto text-center">
                <h1 class="text-4xl font-bold mb-4">Find Your Dream Job</h1>
                <p class="text-lg mb-6">Browse through the best opportunities in tech, design, marketing, and more. Start your career today.</p>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="mySlides fade">
            <div class="container mx-auto text-center">
                <h1 class="text-4xl font-bold mb-4">Explore Top Companies</h1>
                <p class="text-lg mb-6">Find the best employers and grow your career with the right company.</p>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="mySlides fade">
            <div class="container mx-auto text-center">
                <h1 class="text-4xl font-bold mb-4">Get Ready for Your Next Opportunity</h1>
                <p class="text-lg mb-6">Prepare with the best resources and ace your next job interview.</p>
            </div>
        </div>

        <!-- Previous and Next Buttons -->
        <a class="prev absolute left-0 top-1/2 transform -translate-y-1/2 bg-white text-blue-500 px-3 py-2 rounded-full cursor-pointer" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next absolute right-0 top-1/2 transform -translate-y-1/2 bg-white text-blue-500 px-3 py-2 rounded-full cursor-pointer" onclick="plusSlides(1)">&#10095;</a>

        <!-- Slideshow Navigation Dots -->
        <div class="text-center mt-6">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </div>
</div>

<!-- Slideshow JavaScript -->
<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");

        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }

        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }

        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }

    // Auto slide every 5 seconds
    setInterval(() => {
        plusSlides(1);
    }, 5000);
</script>



<!-- Two-Column Layout -->
<div class="container mx-auto p-6 grid grid-cols-1 lg:grid-cols-4 gap-6">

    <!-- Left Column: Navigation Buttons and Top Companies -->
    <div class="bg-white shadow-md rounded-lg p-4">
        <h2 class="text-2xl font-semibold mb-6">Navigation</h2>
        <ul class="space-y-4">
            <li>
                <a href="index.php" class="block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Home</a>
            </li>
            <li>
                <a href="applied_jobs.php" class="block bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300">Applied Jobs</a>
            </li>
            <li>
                <a href="free_courses.php" class="block bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300">Free Courses</a>
            </li>
            <li>
                <a href="job_prep_guide.php" class="block bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300">Job Prep Guide</a>
            </li>
            <li>
                <a href="settings.php" class="block bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300">Settings</a>
            </li>
        </ul>

        <!-- Top Companies Section -->
        <h2 class="text-xl font-semibold mt-8 mb-4">Top Companies</h2>
        <ul class="space-y-4">
            <?php if (!empty($top_companies)): ?>
                <?php foreach ($top_companies as $company): ?>
                    <li class="flex items-center space-x-4">
                        <img src="uploads/profile_pics/<?= $company['profile_pic'] ?>" alt="Company Logo" class="w-8 h-8 rounded-full">
                        <a href="profile.php?id=<?= $company['id'] ?>" class="text-gray-800 font-semibold hover:underline"><?= $company['username'] ?></a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No companies available.</li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Right Column: Job Listings -->
    <div class="col-span-3">
        <div id="search" class="container mx-auto p-6 bg-gray-200 rounded-lg mb-5">
            <h1 class="text-3xl font-bold mb-4">Latest Jobs</h1>
            <form action="search.php" method="GET" class="mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Job title, keywords, or company -->
                    <div class="col-span-1 md:col-span-2">
                        <input type="text" name="query" placeholder="Job title, keywords, or company" class="w-full px-4 py-2 border border-gray-300 rounded-lg" value="<?= isset($_GET['query']) ? $_GET['query'] : '' ?>" />
                    </div>

                    <!-- Location Filter -->
                    <div class="col-span-1">
                        <input type="text" name="location" placeholder="Location" class="w-full px-4 py-2 border border-gray-300 rounded-lg" value="<?= isset($_GET['location']) ? $_GET['location'] : '' ?>" />
                    </div>

                    <!-- Job Type Filter -->
                    <div class="col-span-1">
                        <select name="job_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <option value="">All Types</option>
                            <option value="Full-time" <?= (isset($_GET['job_type']) && $_GET['job_type'] == 'Full-time') ? 'selected' : '' ?>>Full-time</option>
                            <option value="Part-time" <?= (isset($_GET['job_type']) && $_GET['job_type'] == 'Part-time') ? 'selected' : '' ?>>Part-time</option>
                            <option value="Freelance" <?= (isset($_GET['job_type']) && $_GET['job_type'] == 'Freelance') ? 'selected' : '' ?>>Freelance</option>
                            <option value="Internship" <?= (isset($_GET['job_type']) && $_GET['job_type'] == 'Internship') ? 'selected' : '' ?>>Internship</option>
                        </select>
                    </div>
                </div>


                <div class="flex flex-row space-x-4 mt-4 items-center">

                    <!-- Salary Range Filter with Single Slider -->
                    <div class="w-1/2">
                        <label for="salary_range" class="block text-gray-700">Maximum Salary (BDT): <span id="salary-value">200000+</span></label>
                        <input type="range" id="max_salary" name="max_salary" min="0" max="200000" value="<?= isset($_GET['max_salary']) ? $_GET['max_salary'] : 200000 ?>" step="5000" class="w-full" oninput="updateSalaryValue()">
                    </div>

                    <!-- Job Post Date Filter -->
                    <div>
                        <select name="post_date" id="post_date" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <option value="">Date</option>
                            <option value="24_hours" <?= (isset($_GET['post_date']) && $_GET['post_date'] == '24_hours') ? 'selected' : '' ?>>Last 24 Hours</option>
                            <option value="7_days" <?= (isset($_GET['post_date']) && $_GET['post_date'] == '7_days') ? 'selected' : '' ?>>Last 7 Days</option>
                            <option value="30_days" <?= (isset($_GET['post_date']) && $_GET['post_date'] == '30_days') ? 'selected' : '' ?>>Last 30 Days</option>
                        </select>
                    </div>


                    <!-- Search Button -->
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Search</button>

                    <!-- Reset Button -->
                    <a href="search.php" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Reset</a>
                </div>
            </form>
        </div>

        <!-- JavaScript for Salary Slider -->
        <script>
            function updateSalaryValue() {
                let maxSalary = document.getElementById('max_salary').value;
                document.getElementById('salary-value').textContent = maxSalary + ' BDT';
            }

            // Set initial salary value
            updateSalaryValue();
        </script>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php if (empty($jobs)): ?>
                <p>No jobs available at the moment.</p>
            <?php else: ?>
                <?php foreach ($jobs as $job): ?>
                    <div class="bg-white shadow-md p-4 rounded">
                        <div class="flex flex-row items-center space-x-4 mb-2">
                            <img src="uploads/profile_pics/<?= $job['profile_pic'] ?>" class="w-6 border-rounded" alt="Company Logo" />
                            <h1 class="text-sm font-bold"><?php echo $job['username']; ?></h1>
                        </div>
                        <h2 class="text-xl font-semibold"><?php echo $job['title']; ?></h2>
                        <p class="text-gray-600">Salary: <?php echo $job['salary']; ?> BDT</p>
                        <p class="text-gray-600">Job Type: <?php echo $job['job_type']; ?></p>
                        <p class="text-gray-600">Deadline: <?php echo $job['deadline']; ?></p>
                        <a href="show.php?id=<?php echo $job['id']; ?>" class="text-blue-500 hover:underline">View Details</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php include('components/pagination.php') ?>
    </div>
</div>

<?php require('layout/footer.php') ?>