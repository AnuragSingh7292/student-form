<?php
// Database connection details
$host = "localhost";
$dbname = "studentfeedback";
$username = "root";  // Use your MySQL username
$password = "";      // Use your MySQL password

// Establish connection
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get registration number from URL
if (isset($_GET['registration_number'])) {
    $registration_number = $_GET['registration_number'];
} else {
    echo "No registration number provided.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_outcome_rating = $_POST['course_outcome'];
    $problem_solving_skills_rating = $_POST['problem_solving'];
    $learner_needs_rating = $_POST['learner_needs'];
    $contact_hour_satisfaction = $_POST['contact_hours'];
    $basic_sciences_mix_rating = $_POST['basic_sciences'];
    $lab_sessions_rating = $_POST['lab_sessions'];
    $mini_project_rating = $_POST['mini_project'];
    $suggestions = $_POST['suggestions'];

    $sql = "INSERT INTO feedback (registration_number, course_outcome_rating, problem_solving_skills_rating, learner_needs_rating, 
                                  contact_hour_satisfaction, basic_sciences_mix_rating, lab_sessions_rating, mini_project_rating, suggestions) 
            VALUES ('$registration_number', '$course_outcome_rating', '$problem_solving_skills_rating', '$learner_needs_rating', 
                    '$contact_hour_satisfaction', '$basic_sciences_mix_rating', '$lab_sessions_rating', '$mini_project_rating', '$suggestions')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Form submitted successfully!');</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Questionnaire </title>
    <link rel="stylesheet" href="StudentQuestionnaire.css">
</head>
<body>
    <form action="StudentQuestionnaire.php?registration_number=<?php echo $registration_number; ?>" method="post"> 
        <a href="https://vignan.ac.in" target="main"><img src="https://vignan.ac.in/newvignan/assets/images/Logo%20with%20Deemed.svg"
            height="" width="100%"> </a>

        <h1>Questionnaire for Student (IT)</h1>

        <label>Course Contents of Curriculum are in tune with the Program Outcomes</label>
        
        <input type="range" name="course_outcome"  min="1" max="5" value="3">
        <span id="Low">1 means Low</span><span id="High">5 means High</span>
        <br><br>

        <label>Course Contents are designed to enable Problem Solving Skills and Core competencies</label>
        <input type="range" name="problem_solving" min="1" max="5" value="3">
        <span id="Low">1 means Low</span><span id="High">5 means High</span>
        <br><br>

        <label>Courses placed in the curriculum serve the needs of both advanced and slow learners</label>
        <input type="range" name="learner_needs" min="1" max="5" value="3">
        <span id="Low">1 means Low</span><span id="High">5 means High</span>
        <br><br>

        <label>Contact Hour Distribution among the various Course Components (LTP) is Satisfiable</label>
        <input type="range" name="contact_hours" min="1" max="5" value="3">
        <span id="Low">1 means Low</span><span id="High">5 means High</span>
        <br><br>

        <label>Composition of Basic Sciences, Engineering, Humanities and Management Courses is a right mix and satisfiable</label>
        <input type="range" name="basic_sciences" min="1" max="5" value="3">
        <span id="Low">1 means Low</span><span id="High">5 means High</span>
        <br><br>

        <label>Laboratory sessions are sufficient to improve the technical skills of students</label>
        <input type="range" name="lab_sessions" min="1" max="5" value="3">
        <span id="Low">1 means Low</span><span id="High">5 means High</span>
        <br><br>

        <label>Inclusion of Minor Project/Mini Projects improved the technical competency and leadership skills among the students</label>
        <input type="range" name="mini_project" min="1" max="5" value="3">
        <span id="Low">1 means Low</span><span id="High">5 means High</span>
        <br><br>

        <label>Suggest any other points to improve the quality of the Curriculum</label>
        <textarea name="suggestions" rows="4" placeholder="Enter your suggestions here..."></textarea>
        <br><br>

        <button type="submit">Submit</button>

    </form>
    
</body>
</html>