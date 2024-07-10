<?php
// Initialize the $employee variable to an empty array
$employee = [
    'id' => '',
    'name' => '',
    'position' => '',
    'department' => '',
    'salary' => ''
];

if (isset($_GET['id'])) {
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

    // Fetch employee record to edit
    $id = $_GET['id'];
    $sql = "SELECT * FROM employee_info WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $employee = $result->fetch_assoc();

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($_GET['id']) ? 'Edit Employee' : 'Add Employee'; ?></title>
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
            background-image: linear-gradient(to right, #000080, #ff073a);
            background-size: cover;
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
        input[type="text"], input[type="number"] {
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
            background-color: #ff073a;
        }
    </style>
</head>
<body>
    <h2><?php echo isset($_GET['id']) ? 'Edit Employee' : 'Add Employee'; ?></h2>
    <form action="save_employee.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($employee['id']); ?>">
        Name: <input type="text" name="name" value="<?php echo htmlspecialchars($employee['name']); ?>" required><br>
        Position: <input type="text" name="position" value="<?php echo htmlspecialchars($employee['position']); ?>" required><br>
        Department: <input type="text" name="department" value="<?php echo htmlspecialchars($employee['department']); ?>" required><br>
        Salary: <input type="number" name="salary" step="0.01" value="<?php echo htmlspecialchars($employee['salary']); ?>" required><br>
        <input type="submit" value="Save">
    </form>
</body>
</html>
