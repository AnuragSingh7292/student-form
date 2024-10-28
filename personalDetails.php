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
    $stakeholder_name = $_POST['sname'];
    $stakeholder_type = $_POST['stype'];
    $phone = $_POST['sphone'];
    $email = $_POST['semail'];
    $academic_year = $_POST['sacademic-year'];
    $gender = $_POST['sgender'];

    // Insert personal details into the database
    $sql = "INSERT INTO personal_details (registration_number, stakeholder_name, stakeholder_type, phone, email, academic_year, gender) 
            VALUES ('$registration_number', '$stakeholder_name', '$stakeholder_type', '$phone', '$email', '$academic_year', '$gender')";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect to studentQuestionnaire.php to add feedback
        header("Location: StudentQuestionnaire.php?registration_number=$registration_number");
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
    <title>personal details</title>
    <link rel="stylesheet" href="personalDetails.css">

</head>

<body>
    <form action="personalDetails.php?registration_number=<?php echo $registration_number; ?>" method="post">
        <a href="https://vignan.ac.in" target="main"><img src="https://vignan.ac.in/newvignan/assets/images/Logo%20with%20Deemed.svg"
                height="" width="100%"> </a>
        <h2>PERSONAL DETAILS</h2>
        <label for="sname">Name of the Stakeholder</label>
        <input type="text" id="sname" name="sname" placeholder="Please enter your first name *" required>

        <label for="stype">Type of the Stakeholder</label>
        <select id="stype" name="stype" required>
            <option value="">Select the type</option>
            <option value="student">Student</option>
            <option value="faculty">Faculty</option>
            <option value="alumni">Alumni</option>
        </select>

        <label for="sphone">Phone</label>
        <input type="tel" id="sphone" name="sphone" placeholder="Please enter your phone" required>

        <label for="semail">Email</label>
        <input type="email" id="semail" name="semail" placeholder="Please enter your email" required>

        <label for="sacademic-year">Feedback for Academic Year</label>
        <select id="sacademic-year" name="sacademic-year" required>
            <option value="">Select the Academic Year</option>
            <option value="2020-2021">2020-2021</option>
            <option value="2021-2022">2021-2022</option>
            <option value="2022-2023">2022-2023</option>
            <option value="2023-2024">2023-2024</option>
        </select>

        <label>Gender</label><br>
        <input type="radio" id="smale" name="sgender" value="male" required>
        <label for="smale">Male</label>

        <input type="radio" id="sfemale" name="sgender" value="female" required>
        <label for="sfemale">Female</label><br>

        <button type="submit">SUBMIT</button>
    </form>
</body>

</html>