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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $registration_number = $_POST['rnumber'];
    $branch = $_POST['sbranch'];
    $program = $_POST['program'];
    $course = $_POST['course'];
    $regulation = $_POST['regulation'];

    // Insert student details into the database
    $sql = "INSERT INTO student_details (registration_number, branch, program, course, regulation) 
            VALUES ('$registration_number', '$branch', '$program', '$course', '$regulation')";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect to personalDetails.php to add personal details
        header("Location: personalDetails.php?registration_number=$registration_number");
        exit;
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
    <title>Student Details</title>
    <link rel="stylesheet" href="studentDetails.css">
</head>
<body>
    <form action="studentDetails.php" method="post">
        <a href="https://vignan.ac.in" target="main"><img src="https://vignan.ac.in/newvignan/assets/images/Logo%20with%20Deemed.svg"
            height="" width="100%"> </a>

            <h2>STUDENT DETAILS </h2>
            <label for="rnumber">Registration Number </label>
            <input type="text" id="rnumber" name="rnumber" required>

            <label for="sbranch">Branch</label>
            <input type="text" id="sbranch" name="sbranch" required>

            <h2>PROGRAMME DETAILS</h2>
            <label for="program">Program </label>
            <select name="program" id="program" onchange="updateProgramOptions()" required>
                <option value="">Select</option>
                <option value="UG">UG</option>
                <option value="PG">PG</option>
            </select>

            <label for="course">Course</label>
            <select name="course" id="course" required>
                <option value="">select</option>
            </select>

            <label for="branch">Branch</label>
            <select name="branch" id="branch" required>
                <option value="">Select</option>
            </select>

            <label for="regulation">Regulation</label>
            <select name="regulation" id="regulation" required>
                <option value="">Select</option>
                <option value="R19">R19</option>
                <option value="R22">R22</option>
            </select>

            <button type="submit"> SUBMIT </button> 
    </form>

    <script src="studentDetails.js"></script>
</body>
</html>