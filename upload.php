<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$error = "";
$success = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $user_id = $_SESSION["user_id"];

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $error = "Only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $error .= " Your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            require_once 'database.php';
            $filename = basename($_FILES["image"]["name"]);
            $sql = "INSERT INTO uploads (user_id, filename) VALUES ($user_id, '$filename')";
            if ($conn->query($sql) === TRUE) {
                $success = "The file has been uploaded successfully.";
            } else {
                $error = "Error saving file information to the database: " . $conn->error;
            }
            $conn->close();
        } else {
            $error = "There was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Upload File</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <label for="image">Select image to upload:</label>
            <input type="file" name="image" id="image" required><br><br>
            <button type="submit">Upload Image</button>
        </form>
        <p><a href="profile.php">Go to Profile</a></p>
    </div>
</body>
</html>