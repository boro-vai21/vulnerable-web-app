<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
require_once 'database.php';

$user_id = $_SESSION["user_id"];
$sql = "SELECT filename FROM uploads WHERE user_id=$user_id";
$result = $conn->query($sql);
$images = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $images[] = $row["filename"];
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Gallery</title>
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
            max-width: 960px;
            margin: 20px auto;
            text-align: center;
        }
        h2 {
            color: #555;
            margin-bottom: 20px;
        }
        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }
        .gallery-image {
            width: 150px;
            height: 150px;
            border: 1px solid #eee;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
        p {
            margin-top: 20px;
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
        <h2>My Gallery</h2>
        <div class="gallery">
            <?php if (empty($images)): ?>
                <p>No images uploaded yet.</p>
            <?php else: ?>
                <?php foreach ($images as $image): ?>
                    <img src="uploads/<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($image); ?>" class="gallery-image">
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <p><a href="profile.php">Go to Profile</a></p>
    </div>
</body>
</html>