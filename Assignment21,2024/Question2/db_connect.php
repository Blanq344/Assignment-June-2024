<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "connector"; // Change this to your database name

// Create connection to MySQL server
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created or already exists: $dbname<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Select the database
if ($conn->select_db($dbname)) {
    echo "Connected successfully to the database: " . $dbname;
} else {
    die("Error selecting database: " . $conn->error);
}

// Close the connection
$conn->close();
?>