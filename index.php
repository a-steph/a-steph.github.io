<?php
session_start();
require_once "config.php";

$password = "secret123"; // Hardcoded for now

if (isset($_POST['password'])) {
    if ($_POST['password'] == $password) {
        $_SESSION['loggedin'] = true;
    } else {
        echo "<p style='color: red;'>Wrong password!</p>";
    }
}

if (!isset($_SESSION['loggedin'])) {
    // Show login form
    echo '<!DOCTYPE html>
          <html>
          <head>
              <title>Login</title>
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <style>
                  body { 
                      background-color: #18191A; 
                      color: #E4E6EB; 
                      font-family: "Helvetica Neue", Arial, sans-serif; 
                      display: flex; 
                      flex-direction: column; 
                      align-items: center; 
                      justify-content: center; 
                      height: 100vh; 
                      margin: 0; 
                      padding: 20px; 
                  }
                  form { 
                      display: flex; 
                      flex-direction: column; 
                      align-items: center; 
                      width: 100%; 
                      max-width: 400px; 
                  }
                  input[type="password"], input[type="submit"] { 
                      background-color: #3A3B3C; 
                      color: #E4E6EB; 
                      border: 1px solid #E4E6EB; 
                      padding: 10px; 
                      margin: 10px 0; 
                      border-radius: 4px; 
                      width: 100%; 
                      box-sizing: border-box; 
                  }
              </style>
          </head>
          <body>
              <form method="post">
                  <input type="password" name="password" placeholder="Enter password" required>
                  <input type="submit" value="Login">
              </form>
          </body>
          </html>';
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Photo Site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { 
            background-color: #18191A; 
            color: #E4E6EB; 
            font-family: 'Helvetica Neue', Arial, sans-serif; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            margin: 0; 
            padding: 20px; 
        }
        h1 { 
            text-align: center; 
        }
        a { 
            color: #2D88FF; 
            text-decoration: none; 
        }
        a:hover { 
            text-decoration: underline; 
        }
        .links { 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            width: 100%; 
            max-width: 400px; 
        }
        .links a { 
            margin: 10px 0; 
            width: 100%; 
            text-align: center; 
            padding: 10px; 
            background-color: #3A3B3C; 
            border-radius: 4px; 
            box-sizing: border-box; 
        }
    </style>
</head>
<body>
    <h1>Welcome!</h1>
    <div class="links">
        <a href="upload.php">Upload a Photo</a>
        <a href="gallery.php">View Gallery</a>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>