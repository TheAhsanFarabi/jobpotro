<?php
// Fetch search parameters
$query = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';
$location = isset($_GET['location']) ? mysqli_real_escape_string($conn, $_GET['location']) : '';
$job_type = isset($_GET['job_type']) ? mysqli_real_escape_string($conn, $_GET['job_type']) : '';
$max_salary = isset($_GET['max_salary']) ? (int)$_GET['max_salary'] : 200000;
$post_date = isset($_GET['post_date']) ? $_GET['post_date'] : '';

// Base SQL query
$sql = "SELECT * FROM jobs WHERE 1=1";

// Search by query (job title or company)
if ($query) {
    $sql .= " AND (title LIKE '%$query%' OR company LIKE '%$query%')";
}

// Filter by location
if ($location) {
    $sql .= " AND location LIKE '%$location%'";
}

// Filter by job type
if ($job_type) {
    $sql .= " AND job_type = '$job_type'";
}

// Filter by salary range
$sql .= " AND salary <= $max_salary";

// Filter by post date
if ($post_date) {
    if ($post_date == '24_hours') {
        $sql .= " AND created_at >= NOW() - INTERVAL 1 DAY";
    } elseif ($post_date == '7_days') {
        $sql .= " AND created_at >= NOW() - INTERVAL 7 DAY";
    } elseif ($post_date == '30_days') {
        $sql .= " AND created_at >= NOW() - INTERVAL 30 DAY";
    }
}

// Execute the query
$result = mysqli_query($conn, $sql);
?>
