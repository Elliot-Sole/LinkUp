<?php
    require 'connect.php';
    $sql = "SELECT BoardName, BoardDescription, Region, image, BoardID, users.username
    FROM Board
    INNER JOIN users ON Board.UserID = users.UserID
    /*organises recipes ina ascending order */
    ORDER BY Board.BoardName ASC";
    //executes query, using query function to avoid potential sql injection
    $Boards = $kayo->query($sql);
    //stores the details in a associative array
    $BoardDetails = $Boards->fetchAll(PDO::FETCH_ASSOC);

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
            <a href = "signup.php">Sign Up</a>
            <a href = "login.php">Log in</a>
            <a href = "index.php">Home</a>
            <form>
            <input type = "text" id = "query">
            <input type = "submit" class = "btn-1" value = "Search">
        </form>
        </nav>
        </div>
        <h2>Forum</h2>
        <p id="intro">Here you can post about and sign up to community based events in your local area.</p>
        <a href = "newpost.php">
        <button class = "btn-1">New Post</button>
        </a>
        <section class = "posts">
            <h2>Latest Posts</h2>
            <div class="post-container">
    <?php foreach($BoardDetails as $Board): ?>
        <div class="Board-card">
           
            <h2 id="header"><u><?php echo htmlspecialchars($Board['BoardName']); ?></u></h2>
            <h3>By: <?php echo htmlspecialchars($Board['username']) ?></h3>
            <h3>Region: <?php echo htmlspecialchars($Board['Region']) ?></h3>
            <a href="singleBoard.php?id=<?php echo $Board['BoardID']; ?>">
            <img src="<?php echo htmlspecialchars($Board['image']);?>" alt="Image for the Board" class="BoardImg">
            </a>
            <p id="description"><?php echo htmlspecialchars($Board['BoardDescription']); ?></p>
        </div>
    <?php endforeach; ?>
    </div>
        </section>
    </body>
</html>
