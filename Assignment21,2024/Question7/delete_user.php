<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_profiles";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Initialize message
$message = '';


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
   
    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
   
    // Execute the statement
    if ($stmt->execute()) {
        $message = "User deleted successfully!";
    } else {
        $message = "Error deleting user: " . $stmt->error;
    }
   
    // Close statement
    $stmt->close();
}


// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Delete User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .delete-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .delete-container h2 {
            margin-bottom: 20px;
        }
        .delete-container input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .delete-container input[type="submit"] {
            background-color: #d9534f;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: calc(100% - 22px);
        }
        .delete-container input[type="submit"]:hover {
            background-color: #c9302c;
        }
        .message {
            margin-top: 20px;
            color: #5cb85c;
        }
    </style>
</head>
<body>
    <div class="delete-container">
        <h2>Delete User</h2>
        <form method="post" action="delete_user.php">
            <input type="text" name="user_id" placeholder="User ID" required><br>
            <input type="submit" value="Delete">
        </form>
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
