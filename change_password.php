<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
require_once 'database.php';

$error = "";
$success = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];
    $user_id = $_SESSION["user_id"];

    $sql = "SELECT password FROM users WHERE id=$user_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($old_password == $row["password"]) { // WARNING: Insecure password comparison
            if ($new_password == $confirm_password) {
                $update_sql = "UPDATE users SET password='$new_password' WHERE id=$user_id";
                if ($conn->query($update_sql) === TRUE) {
                    $success = "Password changed successfully!";
                } else {
                    $error = "Error changing password: " . $conn->error;
                }
            } else {
                $error = "New password and confirm password do not match!";
            }
        } else {
            $error = "Incorrect old password!";
        }
    } else {
        $error = "User not found!";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
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
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 400px;
            text-align: center; /* Center the heading */
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
            text-align: left; /* Align labels to the left */
        }
        input[type="password"] {
            width: calc(100% - 12px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
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
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
        }
        p {
            margin-top: 15px;
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
        <h2>Change Password</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="old_password">Old Password:</label>
            <input type="password" id="old_password" name="old_password" required><br><br>

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required><br><br>

            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required><br><br>

            <button type="submit">Change Password</button>
        </form>
        <p><a href="profile.php">Go to Profile</a></p>
    </div>
</body>
</html>