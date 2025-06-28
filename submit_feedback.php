<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "feedbacksys");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Only process if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data
    $email     = $_POST['email'];
    $mobile    = $_POST['mobile'];
    $year      = $_POST['year'];
    $semester  = $_POST['semester'];

    // Encode checkboxes and JSON
    $best_teachers = isset($_POST['best_teachers']) ? json_encode($_POST['best_teachers']) : json_encode([]);
    $syllabus      = isset($_POST['syllabus_completion']) ? json_encode($_POST['syllabus_completion']) : json_encode([]);

    // Department feedback
    $quality_teaching    = $_POST['quality_teaching'];
    $technical_resources = $_POST['technical_resources'];
    $faculty_support     = $_POST['faculty_support'];

    // College feedback
    $library       = $_POST['college_library_facilities'];
    $labs          = $_POST['computer_labs'];
    $extracurricular = $_POST['extracurricular'];
    $sports        = $_POST['sports'];
    $cleanliness   = $_POST['cleanliness'];

    // Open-ended
    $suggestions       = $_POST['suggestions'] ?? '';
    $positive_comments = $_POST['positive_comments'] ?? '';
    $negative_comments = $_POST['negative_comments'] ?? '';

    // Insert using prepared statement
    $stmt = $conn->prepare("
        INSERT INTO feedback (
            email, mobile, year, semester, best_teachers, 
            quality_teaching, technical_resources, faculty_support,
            college_library_facilities, computer_labs, extracurricular, sports, cleanliness,
            suggestions, positive_comments, negative_comments, syllabus_completion
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("sssssssssssssssss",
        $email, $mobile, $year, $semester, $best_teachers,
        $quality_teaching, $technical_resources, $faculty_support,
        $library, $labs, $extracurricular, $sports, $cleanliness,
        $suggestions, $positive_comments, $negative_comments, $syllabus
    );

    if ($stmt->execute()) {
        echo "<script>
            localStorage.clear();
            alert('Feedback submitted successfully!');
            window.location='feedback.php';
        </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
