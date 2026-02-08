<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href = "css/styles.css">
        <script src = "scripts/seaweed.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
</head>
<body>
    <div class = "wrapper">
    <header class = "heading">
            <section class = "heading-layer">
        <h1>LinkUp</h1>
        </section>
        </header>
    <nav>
            <a href = "signup.php">Sign Up</a>
            <a href = "login.php">Log in</a>
            <a href = "forum.php">Explore</a>
            <a href = "logout.php">Log Out</a>
        </nav>
        </div>
        <h1>Picking Up Trash In Croydon</h1>
        <p>Organising a clean up charity event at Croydon where we'll walk around cleaning up as much rubbish as we can find. Person who picks up the most trash wins £50! Email me at: emaill@email.com for more!</p>
        <form method="POST" action="singleBoard.php">
            <input type="hidden" name="submitted" value="1">
            <textarea type=text id = "CommentBox" name="CommentText" maxlength="300" placeholder="Join The Conversation"></textarea><br>
            <input type = "submit" value = "Submit">
        <div id="Comment">
            <h1>WalkingRat</h1>
            <p id="CommentBody">Where Can I Find Out about this event? I can't wait to come!</p>
            <h1>User23Sarah</h1>
            <p id="CommentBody">So exciting! I love helping out the community where I can</p>
        </div>
        </form>
</body>
</html> 
