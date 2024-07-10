<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Form</title>
</head>
<body>
    <h2>Enter Your Name</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Name:</label>
        <input type="text" id="username" name="username" required>
        <button type="submit">Submit</button>
    </form>


    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect value of input field
        $username = htmlspecialchars($_POST['username']);
        if (!empty($username)) {
            echo "<h3>Hello, " . $username . "!</h3>";
        } else {
            echo "<h3>Please enter your name.</h3>";
        }
    }
    ?>
</body>
</html>