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

// Fetch all employee records
$sql = "SELECT * FROM employee_info";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Management</title>
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
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: darkblue;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .actions a {
            color: neonred;
            margin-right: 10px;
            text-decoration: none;
        }
        .actions a:hover {
            text-decoration: underline;
        }
        .btn {
            background-color: darkblue;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
        .btn:hover {
            background-color: #ff073a;
        }
    </style>
</head>
<body>
    <h2>Employee Management</h2>
    <a href="add_employee.php" class="btn">Add New Employee</a>
    <table>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Department</th>
            <th>Salary</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['position']) . "</td>";
                echo "<td>" . htmlspecialchars($row['department']) . "</td>";
                echo "<td>$" . number_format($row['salary'], 2) . "</td>";
                echo "<td class='actions'>";
                echo "<a href='edit_employee.php?id=" . $row['id'] . "'>Edit</a>";
                echo "<a href='delete_employee.php?id=" . $row['id'] . "'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
