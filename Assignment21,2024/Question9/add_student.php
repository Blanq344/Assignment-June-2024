<?php
// Initialize the $student variable to an empty array
$student = [
    'id' => '',
    'name' => '',
    'roll_no' => '',
    'locality' => ''
];

if (isset($_GET['id'])) {
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

    // Fetch student record to edit
    $id = $_GET['id'];
    $sql = "SELECT * FROM student_info WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($_GET['id']) ? 'Edit Student' : 'Add Student'; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h2 {
            color: darkblue;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: darkblue;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: calc(100% - 22px);
        }
        input[type="submit"]:hover {
            background-color: limegreen;
        }
    </style>
</head>
<body>
    <h2><?php echo isset($_GET['id']) ? 'Edit Student' : 'Add Student'; ?></h2>
    <form action="save_student.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($student['id']); ?>">
        Name: <input type="text" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required><br>
        Roll No: <input type="text" name="roll_no" value="<?php echo htmlspecialchars($student['roll_no']); ?>" required><br>
        Locality: <input type="text" name="locality" value="<?php echo htmlspecialchars($student['locality']); ?>" required><br>
        <input type="submit" value="Save">
    </form>
</body>
</html>