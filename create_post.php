<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
require_once 'database.php';

$error = ""; // Initialize $error
$success = ""; // Initialize $success

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = $_POST["content"];
    $user_id = $_SESSION["user_id"];

    $sql = "INSERT INTO posts (user_id, content) VALUES ($user_id, '$content')";

    if ($conn->query($sql) === TRUE) {
        $success = "Post created successfully!";
    } else {
        $error = "Error creating post: " . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
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
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 500px;
        }
        h2 {
            color: #555;
            margin-bottom: 20px;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .success {
            color: green;
            margin-bottom: 10px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        textarea {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
            box-sizing: border-box;
            font-size: 16px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        p a {
            color: #007bff;
            text-decoration: none;
        }
        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create a New Post</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="content">Content:</label><br>
            <textarea id="content" name="content" rows="5" cols="50" required></textarea><br><br>
            <button type="submit">Post</button>
        </form>
        <p><a href="profile.php">Go to Profile</a></p>
        <p><a href="post.php">View All Posts</a></p>
    </div>
</body>
</html>