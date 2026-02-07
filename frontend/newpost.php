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
        <form>
            <label for = "Title">Title:</label><br>
            <input type = "text" id = "Title"><br>
            <label for = "County">County:</label><br>
            <input type = "text" id = "County"><br>
            <label for = "Date">Date:</label><br>
            <input type = "datetime-local" id = "Date"><br>
            <label for = "Information">Information:</label><br>
            <input type = "text" id = Information><br>
            <input type = "submit" value = "Submit">
        </form>
       
    </body>
</html>
