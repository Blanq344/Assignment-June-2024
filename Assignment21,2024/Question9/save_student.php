<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted and required fields are present
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['roll_no']) && isset($_POST['locality'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $name = $_POST['name'];
    $roll_no = $_POST['roll_no'];
    $locality = $_POST['locality'];

    if ($id) {
        // Update existing student
        $stmt = $conn->prepare("UPDATE student_info SET name=?, roll_no=?, locality=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $roll_no, $locality, $id);
    } else {
        // Add new student
        $stmt = $conn->prepare("INSERT INTO student_info (name, roll_no, locality) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $roll_no, $locality);
    }

    if ($stmt->execute()) {
        echo "Record saved successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: fetch_students.php");
    exit;
} else {
    echo "Required fields are missing.";
    exit;
}
?>