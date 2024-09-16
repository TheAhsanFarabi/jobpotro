<?php
require('layout/header.php');


// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please log in to take the quiz.");
}

$user_id = $_SESSION['user_id'];
$job_id = $_GET['job_id']; // The job ID for which the quiz is taken

// Read the questions from the JSON file
$json_data = file_get_contents('questions.json');
$questions_data = json_decode($json_data, true);

// Get job-specific questions
$questions = isset($questions_data[$job_id]) ? $questions_data[$job_id] : [];

if (empty($questions)) {
    die("No quiz available for this job.");
}

$total_questions = count($questions); // Total number of questions
$submitted = false;
$missed_questions = [];

// Handle quiz form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $score = 0;
    $submitted = true;
    foreach ($questions as $index => $question) {
        $user_answer = mysqli_real_escape_string($conn, $_POST['question_' . $index]);

        if (strtolower(trim($user_answer)) === strtolower(trim($question['correct_answer']))) {
            $score++;
        } else {
            // Track missed questions
            $missed_questions[$index] = [
                'user_answer' => $user_answer,
                'correct_answer' => $question['correct_answer'],
            ];
        }
    }

    $passed = $score >= 3 ? 1 : 0;

    // Insert the result into the applications table
    $query = "INSERT INTO applications (user_id, job_id, score, passed) 
              VALUES ($user_id, $job_id, $score, $passed)";
    
    if (!mysqli_query($conn, $query)) {
        echo "Error: " . mysqli_error($conn);
    }

    // If the user passed, allow them to upload a CV
    if ($passed) {
        $_SESSION['message'] = "Congratulations! You passed the quiz with a score of $score/5. Please upload your CV.";
        $_SESSION['message_type'] = "success";
        header("Location: apply.php?job_id=$job_id");
        exit();
    } else {
        // If the user failed, suggest courses
        $courses_query = "SELECT * FROM courses";
        $courses_result = mysqli_query($conn, $courses_query);
        $courses = mysqli_fetch_all($courses_result, MYSQLI_ASSOC);

        $_SESSION['message'] = "You scored $score/5. Unfortunately, you didn't pass. Here are some courses to help improve your skills.";
        $_SESSION['message_type'] = "error";
    }
}

// Show success/error message
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;
$message_type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : null;
unset($_SESSION['message']);
unset($_SESSION['message_type']);
?>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Job Quiz</h1>

    <!-- Display message -->
    <?php if ($message): ?>
        <div class="bg-<?php echo $message_type == 'success' ? 'green' : 'red'; ?>-500 text-white p-4 rounded mb-4">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <?php if (!$submitted): ?>
        <!-- Timer Display -->
        <div class="text-right text-red-600 mb-6">
            Time left: <span id="timer">05:00</span>
        </div>

        <!-- Progress Bar -->
        <div class="w-full bg-gray-200 rounded-full h-6 mb-6">
            <div id="progress-bar" class="bg-blue-600 h-6 rounded-full text-center text-white font-bold" style="width: 0%;">0%</div>
        </div>

        <!-- Quiz Form -->
        <form method="POST" id="quiz-form">
            <?php foreach ($questions as $index => $question): ?>
                <div class="mb-6 question-block">
                    <label class="block text-gray-800 text-lg font-semibold">Question <?php echo $index + 1; ?>:</label>
                    <p class="text-gray-600 mb-2"><?php echo $question['question']; ?></p>
                    <div class="space-y-2">
                        <?php foreach ($question['options'] as $option): ?>
                            <label class="block">
                                <input type="radio" name="question_<?php echo $index; ?>" value="<?php echo $option; ?>" required class="mr-2 answer-option">
                                <span class="text-gray-800"><?php echo $option; ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-200">Submit Quiz</button>
        </form>
    <?php else: ?>
        <!-- Show the quiz results after submission -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold mb-4">Your Quiz Results:</h2>
            <?php foreach ($questions as $index => $question): ?>
                <div class="mb-6">
                    <label class="block text-gray-800 text-lg font-semibold">Question <?php echo $index + 1; ?>:</label>
                    <p class="text-gray-600 mb-2"><?php echo $question['question']; ?></p>
                    <div class="space-y-2">
                        <?php foreach ($question['options'] as $option): ?>
                            <label class="block">
                                <input type="radio" name="question_<?php echo $index; ?>" value="<?php echo $option; ?>" <?php echo isset($_POST['question_' . $index]) && $_POST['question_' . $index] === $option ? 'checked' : ''; ?> disabled class="mr-2">
                                <span class="<?php
                                    if (isset($missed_questions[$index]) && $missed_questions[$index]['user_answer'] === $option) {
                                        echo 'text-red-600'; // Highlight user's wrong answer in red
                                    } elseif ($question['correct_answer'] === $option) {
                                        echo 'text-green-600'; // Highlight the correct answer in green
                                    } else {
                                        echo 'text-gray-800';
                                    }
                                ?>">
                                    <?php echo $option; ?>
                                </span>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <!-- Display missed question feedback -->
                    <?php if (isset($missed_questions[$index])): ?>
                        <p class="text-red-600 mt-2">Your Answer: <?php echo $missed_questions[$index]['user_answer']; ?></p>
                        <p class="text-green-600">Correct Answer: <?php echo $missed_questions[$index]['correct_answer']; ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Course Recommendations (if failed) -->
    <?php if (isset($courses)): ?>
        <div class="mt-8">
            <h2 class="text-2xl font-semibold mb-4">Recommended Courses for You:</h2>
            <div class="space-y-4">
                <?php foreach ($courses as $course): ?>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold text-gray-800"><?php echo $course['title']; ?></h3>
                        <p class="text-gray-600 mb-2"><?php echo $course['description']; ?></p>
                        <a href="<?php echo $course['link']; ?>" target="_blank" class="text-blue-500 hover:underline">View Course</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    // JavaScript for updating the progress bar
    document.addEventListener('DOMContentLoaded', function () {
        const totalQuestions = <?php echo $total_questions; ?>;
        const progressBar = document.getElementById('progress-bar');
        const answerOptions = document.querySelectorAll('.answer-option');

        let answeredQuestions = 0;

        answerOptions.forEach(option => {
            option.addEventListener('change', function () {
                const answeredBlocks = document.querySelectorAll('.question-block input:checked').length;
                answeredQuestions = answeredBlocks;

                const progress = (answeredQuestions / totalQuestions) * 100;
                progressBar.style.width = progress + '%';
                progressBar.textContent = Math.round(progress) + '%';
            });
        });

        // Timer code
        const timerElement = document.getElementById('timer');
        let timeRemaining = 300; // 5 minutes in seconds

        const interval = setInterval(function () {
            let minutes = Math.floor(timeRemaining / 60);
            let seconds = timeRemaining % 60;
            if (seconds < 10) seconds = '0' + seconds;
            timerElement.textContent = minutes + ':' + seconds;

            if (timeRemaining <= 0) {
                clearInterval(interval);
                document.getElementById('quiz-form').submit(); // Automatically submit the quiz when time runs out
            }

            timeRemaining--;
        }, 1000);
    });
</script>

<?php require('layout/footer.php'); ?>
