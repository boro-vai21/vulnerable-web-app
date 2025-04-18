<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            background-color: #007bff; /* Blue background */
            color: white; /* White text color */
            display: flex;
            flex-direction: column;
            align-items: center; /* Horizontally center items */
            justify-content: center; /* Vertically center items */
            min-height: 100vh;
            text-align: center;
        }
        h1 {
            font-size: 2.5em;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .button-container {
            display: flex;
            gap: 30px;
            /* justify-content: center; Already centered by body */
        }
        .button {
            background-color: #28a745; /* Green color for buttons */
            color: white;
            padding: 15px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #1e7e34;
        }
    </style>
</head>
<body>
    <h1>Welcome To My Web Application</h1>
    <h1>		             </h1>
    <div class="button-container">
        <a href="register.php" class="button">Register</a>
        <a href="login.php" class="button">Login</a>
    </div>
</body>
</html>