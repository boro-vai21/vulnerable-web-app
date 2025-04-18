<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
require_once 'database.php';

$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"]; // Retrieve username from session
$sql = "SELECT email FROM users WHERE id=$user_id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $email = $row["email"];
} else {
    $email = "Unknown";
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile of <?php echo htmlspecialchars($username); ?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
            flex-direction: column; /* Arrange containers vertically */
        }
        .info-container {
            background-color: white; /* White background */
            color: #007bff; /* Blue text */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 500px;
            margin-bottom: 20px; /* Space between containers */
        }
        .info-container h2, .info-container p {
            font-weight: bold; /* Bold text */
            text-align: center; /* Center text in info box */
            margin-bottom: 10px;
            color: #007bff; /* Ensure text is blue */
        }
        .actions-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 400px; /* Slightly smaller width for actions */
        }
        .button-link {
            display: block;
            width: calc(100% - 24px); /* Adjust width for padding */
            padding: 10px 15px; /* Smaller padding */
            margin-bottom: 8px; /* Smaller margin */
            text-align: center;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px; /* Smaller font size */
            transition: background-color 0.3s ease;
            box-sizing: border-box;
        }
        .button-link:hover {
            background-color: #0056b3;
        }
        .logout-button {
            background-color: #dc3545;
        }
        .logout-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="info-container">
        <h2>Profile of <?php echo htmlspecialchars($username); ?></h2>
        <p>Username: <?php echo htmlspecialchars($username); ?></p>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>
    </div>

    <div class="actions-container">
        <a href="change_password.php" class="button-link">Change Password</a>
        <a href="upload.php" class="button-link">Upload File</a>
        <a href="gallery.php" class="button-link">My Gallery</a>
        <a href="create_post.php" class="button-link">Create New Post</a>
        <a href="post.php" class="button-link">View All Posts</a>
        <form action="logout.php" method="post">
            <button type="submit" class="button-link logout-button">Logout</button>
        </form>
    </div>
</body>
</html>