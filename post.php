<?php
session_start();
require_once 'database.php';

$sql = "SELECT posts.content, posts.created_at, users.username FROM posts INNER JOIN users ON posts.user_id=users.id ORDER BY posts.created_at DESC";
$result = $conn->query($sql);
$posts = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Posts</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 700px;
            margin: 20px auto;
        }
        h2 {
            color: #555;
            margin-bottom: 20px;
            text-align: center;
        }
        .post-container {
            display: flex;
            align-items: flex-start; /* Align items to the left */
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .post-number {
            width: 30px;
            margin-right: 15px;
            font-weight: bold;
            color: #555;
            text-align: right;
        }
        .post-content-area {
            flex-grow: 1;
            text-align: left;
        }
        .post-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .post-content {
            margin-bottom: 10px;
        }
        .post-date {
            font-size: 0.8em;
            color: #777;
        }
        .links {
            margin-top: 20px;
            text-align: center;
        }
        .links a {
            color: #007bff;
            text-decoration: none;
            margin: 0 10px;
        }
        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>All Posts</h2>
        <?php if (empty($posts)): ?>
            <p style="text-align: center;">No posts yet.</p>
        <?php else: ?>
            <?php $counter = 1; ?>
            <?php foreach ($posts as $post): ?>
                <div class="post-container">
                    <div class="post-number"><?php echo $counter++; ?></div>
                    <div class="post-content-area">
                        <?php
                            $title = substr(htmlspecialchars($post["content"]), 0, 50); // Extract first 50 characters as title
                            if (strlen(htmlspecialchars($post["content"])) > 50) {
                                $title .= "..."; // Add ellipsis if content is longer
                            }
                        ?>
                        <div class="post-title"><?php echo $title; ?></div>
                        <p class="post-content"><?php echo htmlspecialchars($post["content"]); ?></p>
                        <p class="post-date">Posted by <?php echo htmlspecialchars($post["username"]); ?> on <?php echo htmlspecialchars($post["created_at"]); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="links">
            <a href="profile.php">Go to Profile</a>
            <a href="create_post.php">Create New Post</a>
        </div>
    </div>
</body>
</html>