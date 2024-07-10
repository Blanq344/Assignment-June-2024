<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employees";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted and required fields are present
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['position']) && isset($_POST['department']) && isset($_POST['salary'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $name = $_POST['name'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];

    if ($id) {
        // Update existing employee
        $stmt = $conn->prepare("UPDATE employee_info SET name=?, position=?, department=?, salary=? WHERE id=?");
        $stmt->bind_param("sssdi", $name, $position, $department, $salary, $id);
    } else {
        // Add new employee
        $stmt = $conn->prepare("INSERT INTO employee_info (name, position, department, salary) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssd", $name, $position, $department, $salary);
    }

    if ($stmt->execute()) {
        echo "Record saved successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: fetch_employees.php");
    exit;
} else {
    echo "Required fields are missing.";
    exit;
}
?>