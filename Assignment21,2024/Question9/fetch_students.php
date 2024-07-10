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

// Fetch all student records
$sql = "SELECT * FROM student_info";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Information</title>
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
            color: limegreen;
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
            background-color: limegreen;
        }
    </style>
</head>
<body>
    <h2>Student Information</h2>
    <a href="add_student.php" class="btn">Add New Student</a>
    <table>
        <tr>
            <th>Name</th>
            <th>Roll No</th>
            <th>Locality</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['roll_no']) . "</td>";
                echo "<td>" . htmlspecialchars($row['locality']) . "</td>";
                echo "<td class='actions'>";
                echo "<a href='edit_student.php?id=" . $row['id'] . "'>Edit</a>";
                echo "<a href='delete_student.php?id=" . $row['id'] . "'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
