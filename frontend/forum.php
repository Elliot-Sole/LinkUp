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
        <div class = "wrapper>
        <header class = "heading">
        <h1>LinkUp</h1>
        </header>
        <nav>
            <a href = "signup.php">Sign Up</a>
            <a href = "login.php">Log in</a>
            <a href = "index.php">Home</a>
        </nav>
        </div>
        <h2>Forum</h2>
        <form method = "POST" action = "forum.php">
            <input type = "text" id = "query">
            <input type = "submit" class = "btn-1" value = "Search">
        </form>
        <?php
                                if(ISSET($_POST['query'])){
                                        $keyword = $_POST['keyword'];
                        ?>
        <p>Here you can post about and sign up to community based events in your local area.</p>
        <a href = "newpost.php">
        <button class = "btn-1">New Post</button>
        </a>
        <section class = "posts">
            <h2>Latest Posts</h2>
            <?php
                                    $safe_value = mysql_real_escape_string($_POST['query']);

                $result = mysql_query("SELECT CommentText FROM comments WHERE `BoardID` LIKE %$safe_value%");
                 while ($row = mysql_fetch_assoc($result)) {
                echo "<div id='link' onClick='addText(\"".$row['username']."\");'>" . $row['username'] . "</div>";  
 }


  ?>
            
            <div class = "post-container">

            </div>
        </section>
    </body>
</html>
