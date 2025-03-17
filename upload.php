<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
    exit;
}

// Include config file
require_once "config.php";

// Increase the maximum file upload size, post size, number of file uploads, and input variables
ini_set('upload_max_filesize', '100M');
ini_set('post_max_size', '100M');
ini_set('max_file_uploads', '1000');
ini_set('max_input_vars', '2000');

if (isset($_FILES["photos"]) && isset($_POST["year"])) {
    $year = $_POST["year"];
    $target_dir = "uploads/$year/";
    $uploadSuccess = true;

    foreach ($_FILES["photos"]["name"] as $key => $name) {
        $target_file = $target_dir . basename($name);
        if (!move_uploaded_file($_FILES["photos"]["tmp_name"][$key], $target_file)) {
            $uploadSuccess = false;
            break;
        }
    }

    if ($uploadSuccess) {
        echo "Photos uploaded to $year successfully!";
    } else {
        echo "Error uploading photos.";
    }
} else {
    echo "No files or year specified.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Photo</title>
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
        form { 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            width: 100%; 
            max-width: 400px; 
        }
        input[type="file"], select, input[type="submit"] { 
            background-color: #3A3B3C; 
            color: #E4E6EB; 
            border: 1px solid #E4E6EB; 
            padding: 10px; 
            margin: 10px 0; 
            border-radius: 4px; 
            width: 100%; 
            box-sizing: border-box; 
        }
        a { 
            color: #2D88FF; 
            text-decoration: none; 
        }
        a:hover { 
            text-decoration: underline; 
        }
    </style>
</head>
<body>
    <h1>Upload Photos</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="photos[]" accept="image/*" multiple required>
        <select name="year" required>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
        </select>
        <input type="submit" value="Upload">
    </form>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>