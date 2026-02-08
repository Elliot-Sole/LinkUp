<?php
require 'connect.php';
session_start();

/* ---- Auth guard ---- */
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submitted'])) {

    $user_id = $_SESSION['user_id'];

    $BoardName        = trim($_POST['BoardName'] ?? '');
    $Region           = $_POST['Region'] ?? '';
    $BoardDescription = trim($_POST['BoardDescription'] ?? '');

    /* ---- Basic validation ---- */
    if ($BoardName === '' || $Region === '' || $BoardDescription === '') {
        $message = "All fields are required.";
    } elseif (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $message = "Image upload failed.";
    } else {

        /* ---- Check for duplicate board name ---- */
        $stmt = $kayo->prepare(
            "SELECT 1 FROM board WHERE BoardName = ?"
        );
        $stmt->execute([$BoardName]);

        if ($stmt->fetch()) {
            $message = "That Board Name is already taken.";
        } else {

            /* ---- Image validation ---- */
            $imageName    = $_FILES['image']['name'];
            $imageTmpPath = $_FILES['image']['tmp_name'];

            $ext = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($ext, $allowed, true)) {
                $message = "Only JPG, PNG, and WEBP images are allowed.";
            } else {

                /* ---- Ensure upload directory exists ---- */
                $uploadDir = 'images/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $newFileName = uniqid('img_', true) . '.' . $ext;
                $destPath    = $uploadDir . $newFileName;

                /* ---- Move file first ---- */
                if (!move_uploaded_file($imageTmpPath, $destPath)) {
                    $message = "Failed to save uploaded image.";
                } else {

                    /* ---- Insert into database ---- */
                    $stmt = $kayo->prepare(
                        "INSERT INTO board
                         (UserID, BoardName, BoardDescription, Region, image)
                         VALUES (?, ?, ?, ?, ?)"
                    );

                    $stmt->execute([
                        $user_id,
                        $BoardName,
                        $BoardDescription,
                        $Region,
                        $destPath
                    ]);

                    header("Location: forum.php");
                    exit();
                }
            }
        }
    }
}
?>



<!DOCTYPE HTML>
<html>
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href = "css/styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class = "wrapper">
        <header class = "heading">
        <h1>LinkUp</h1>
        </header>
        <nav>
            <a href = "logout.php">Log Out</a>
            <a href = "forum.php">Explore</a>
            <a href = "index.php">Home</a>
        </nav>
        </div>
        <h2>New Post</h2>
       <form method="POST" action="newpost.php" enctype="multipart/form-data">
            <input type="hidden" name="submitted" value="1">
            <label for = "Title">Title:</label><br>
            <input type = "text" id = "Title" name="BoardName"><br>
            <label for = "County">County:</label><br>
            <select id = "County" name="Region" required>
    <option value="">-- Select a county --</option>
    <option value="Bedfordshire">Bedfordshire</option>
    <option value="Berkshire">Berkshire</option>
    <option value="Bristol">Bristol</option>
    <option value="Buckinghamshire">Buckinghamshire</option>
    <option value="Cambridgeshire">Cambridgeshire</option>
    <option value="Cheshire">Cheshire</option>
    <option value="City of London">City of London</option>
    <option value="Cornwall">Cornwall</option>
    <option value="Cumbria">Cumbria</option>
    <option value="Derbyshire">Derbyshire</option>
    <option value="Devon">Devon</option>
    <option value="Dorset">Dorset</option>
    <option value="East Riding of Yorkshire">East Riding of Yorkshire</option>
    <option value="East Sussex">East Sussex</option>
    <option value="Essex">Essex</option>
    <option value="Gloucestershire">Gloucestershire</option>
    <option value="Greater London">Greater London</option>
    <option value="Greater Manchester">Greater Manchester</option>
    <option value="Hampshire">Hampshire</option>
    <option value="Herefordshire">Herefordshire</option>
    <option value="Hertfordshire">Hertfordshire</option>
    <option value="Isle of Wight">Isle of Wight</option>
    <option value="Kent">Kent</option>
    <option value="Lancashire">Lancashire</option>
    <option value="Leicestershire">Leicestershire</option>
    <option value="Lincolnshire">Lincolnshire</option>
    <option value="Merseyside">Merseyside</option>
    <option value="Norfolk">Norfolk</option>
    <option value="North Yorkshire">North Yorkshire</option>
    <option value="Northamptonshire">Northamptonshire</option>
    <option value="Northumberland">Northumberland</option>
    <option value="Nottinghamshire">Nottinghamshire</option>
    <option value="Oxfordshire">Oxfordshire</option>
    <option value="Rutland">Rutland</option>
    <option value="Shropshire">Shropshire</option>
    <option value="Somerset">Somerset</option>
    <option value="South Yorkshire">South Yorkshire</option>
    <option value="Staffordshire">Staffordshire</option>
    <option value="Suffolk">Suffolk</option>
    <option value="Surrey">Surrey</option>
    <option value="Tyne and Wear">Tyne and Wear</option>
    <option value="Warwickshire">Warwickshire</option>
    <option value="West Midlands">West Midlands</option>
    <option value="West Sussex">West Sussex</option>
    <option value="West Yorkshire">West Yorkshire</option>
    <option value="Wiltshire">Wiltshire</option>
    <option value="Worcestershire">Worcestershire</option>
    <option value="County Durham">County Durham</option>
                </select><br>
            <label for = "Information">Information:</label><br>
            <textarea type=text id = Information name="BoardDescription" maxlength="300"></textarea><br>
            <label for="image">Provide an image for this Board: </label><br>
        <input name="image" type="file" accept="image/*" required id="image"><br>
            <input type = "submit" value = "Submit">
        </form>
       
    </body>
</html>
