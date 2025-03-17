<?php
session_start();
session_destroy();
header("Location: index.php");
exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .message {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="message">
        <h1>You have been logged out</h1>
        <p>Redirecting to the homepage...</p>
    </div>
</body>
</html>