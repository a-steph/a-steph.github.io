<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
    exit;
}

// Include config file
require_once "config.php";

$years = [2023, 2024, 2025];
$photos = [];
$currentYear = max($years);

$year = isset($_GET['year']) && in_array($_GET['year'], $years) ? $_GET['year'] : $currentYear;
$files = scandir("uploads/$year/");
foreach ($files as $file) {
    if ($file != "." && $file != "..") {
        $photos[] = "uploads/$year/$file";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gallery</title>
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
        h1, h2 { 
            text-align: center; 
        }
        .thumbnail { 
            max-width: 100%; 
            margin: 10px; 
            cursor: pointer; 
            border-radius: 8px; 
            transition: transform 0.2s; 
        }
        .thumbnail:hover { 
            transform: scale(1.05); 
        }
        #lightbox { 
            display: none; 
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%; 
            background: rgba(0,0,0,0.9); 
            justify-content: center; 
            align-items: center; 
        }
        #lightbox img { 
            max-width: 80%; 
            max-height: 80%; 
            border-radius: 8px; 
        }
        .nav-button { 
            position: absolute; 
            top: 50%; 
            font-size: 30px; 
            color: #E4E6EB; 
            background: none; 
            border: none; 
            cursor: pointer; 
        }
        #prev { left: 10px; }
        #next { right: 10px; }
        select, input[type="submit"] { 
            background-color: #3A3B3C; 
            color: #E4E6EB; 
            border: 1px solid #E4E6EB; 
            padding: 5px; 
            margin: 10px 0; 
            border-radius: 4px; 
        }
        a { 
            color: #2D88FF; 
            text-decoration: none; 
        }
        a:hover { 
            text-decoration: underline; 
        }
        .photo-container { 
            display: flex; 
            flex-wrap: wrap; 
            justify-content: center; 
        }
    </style>
</head>
<body>
    <h1>Photo Gallery</h1>
    <h2><?php echo $year; ?></h2>
    <form method="get" action="gallery.php" style="margin-bottom: 20px;">
        <label for="year">Select Year:</label>
        <select name="year" id="year" onchange="this.form.submit()">
            <?php foreach ($years as $y): ?>
                <option value="<?php echo $y; ?>" <?php echo $y == $year ? 'selected' : ''; ?>><?php echo $y; ?></option>
            <?php endforeach; ?>
        </select>
    </form>
    <div class="photo-container">
        <?php
        foreach ($photos as $index => $photo) {
            echo "<img src='$photo' class='thumbnail' onclick='showLightbox($index)'>";
        }
        ?>
    </div>
    <div id="lightbox">
        <button id="prev" class="nav-button" onclick="changePhoto(-1)">&lt;</button>
        <img id="lightbox-img">
        <button id="next" class="nav-button" onclick="changePhoto(1)">&gt;</button>
        <br>
        <a id="download-btn" href="#" download style="color: #E4E6EB; text-decoration: none;">Download</a>
    </div>
    <p><a href="index.php">Back to Home</a></p>

    <script>
        const photos = <?php echo json_encode($photos); ?>;
        let currentIndex = 0;

        function showLightbox(index) {
            currentIndex = index;
            updateLightbox();
            document.getElementById("lightbox").style.display = "flex";
        }

        function updateLightbox() {
            const img = document.getElementById("lightbox-img");
            img.src = photos[currentIndex];
            document.getElementById("prev").style.display = currentIndex === 0 ? "none" : "block";
            document.getElementById("next").style.display = currentIndex === photos.length - 1 ? "none" : "block";
            document.getElementById("download-btn").href = photos[currentIndex];
            document.getElementById("download-btn").download = photos[currentIndex].split('/').pop();
        }

        function changePhoto(direction) {
            const newIndex = currentIndex + direction;
            if (newIndex >= 0 && newIndex < photos.length) {
                currentIndex = newIndex;
                updateLightbox();
            }
        }

        // Arrow key support
        document.addEventListener("keydown", function(event) {
            if (document.getElementById("lightbox").style.display === "flex") {
                if (event.key === "ArrowLeft") changePhoto(-1);
                if (event.key === "ArrowRight") changePhoto(1);
                if (event.key === "Escape") document.getElementById("lightbox").style.display = "none";
            }
        });

        // Close lightbox on click outside image
        document.getElementById("lightbox").addEventListener("click", function(event) {
            if (event.target.tagName !== "IMG" && event.target.tagName !== "BUTTON") {
                this.style.display = "none";
            }
        });
    </script>
</body>
</html>