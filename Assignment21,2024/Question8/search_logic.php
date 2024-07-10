<?php
// Initialize variables
$search_term = '';
$results = [];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $search_term = $_POST['search_term'];
    
    // Prepare the SQL statement with a LIKE clause
    $stmt = $conn->prepare("SELECT * FROM users WHERE name LIKE ? OR email LIKE ?");
    $like_term = "%" . $search_term . "%";
    $stmt->bind_param("ss", $like_term, $like_term);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Fetch all records
    $results = $result->fetch_all(MYSQLI_ASSOC);

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
        }
        .results-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: left;
        }
        .results-container h2 {
            margin-top: 0;
        }
        .result-item {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }
        .result-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="results-container">
        <h2>Results</h2>
        <?php if (!empty($results)): ?>
            <?php foreach ($results as $result): ?>
                <div class="result-item">
                    <strong>Name:</strong> <?php echo htmlspecialchars($result['name']); ?><br>
                    <strong>Email:</strong> <?php echo htmlspecialchars($result['email']); ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
