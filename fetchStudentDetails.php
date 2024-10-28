<?php
// Database connection details
$host = "localhost";
$dbname = "studentfeedback";
$username = "root";  // Use your MySQL username
$password = "";      // Use your MySQL password

// Establish the database connection
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registration_number'])) {
    $registration_number = $_POST['registration_number'];

    // Query to fetch data from all related tables
    $sql = "SELECT sd.*, pd.*, fb.*
            FROM student_details sd
            LEFT JOIN personal_details pd ON sd.registration_number = pd.registration_number
            LEFT JOIN feedback fb ON sd.registration_number = fb.registration_number
            WHERE sd.registration_number = ?";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $registration_number);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if data was found
    if ($result->num_rows > 0) {
        // Fetch and display data
        echo "<table border='1'>";
        echo "<caption>Student Details</caption>";
        while ($row = $result->fetch_assoc()) {
            foreach ($row as $field => $value) {
                echo "<tr><td><strong>" . ucfirst(str_replace("_", " ", $field)) . ":</strong></td><td>" . htmlspecialchars($value) . "</td></tr>";
            }
        }
        echo "</table>";
    } else {
        echo "No data found for registration number: " . htmlspecialchars($registration_number);
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Retrieve Student Data</title>
    <link rel="stylesheet" href="fetchStudentDetails.css">
</head>
<body>
    
    <form action="fetchStudentDetails.php" method="post">
        <h1>Retrieve Student Data</h1>
        <label for="registration_number">Enter Registration Number:</label>
        <input type="text" id="registration_number" name="registration_number" required>
        <button type="submit">Submit</button>
    </form>

</body>
</html>
