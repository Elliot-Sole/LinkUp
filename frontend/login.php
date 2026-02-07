<?php
    require 'connect.php';
    session_start();
    $message = "";
    if (isset($_SESSION['user'])) {
        header("Location: forum.php");
        exit();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitted'])) {
        //connects to the database
        
        //grabs and stores the inputted username and password from the form and stores them in local variables
        $username = $_POST['username'];
        $password = $_POST['password'];
        //prepares an sql statement to select the username and password that matches the unspecified username
        $stmt = $kayo-> prepare('SELECT UserID, username, password FROM users WHERE username = ?');
        //executes the sql statement to select the username and password that matches the username from the form
        $stmt->execute([$username]); 
        //if any results($stmt->fetch) were returned from the table, then...
        if ($row = $stmt->fetch()) {
            //if the hashed password in the database matches the hashed version of password submitted in the login form
            if (password_verify($password, $row['password'])) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $row['UserID'];
                $_SESSION['user'] = $row['username'];
                header("Location: forum.php");
                exit();
                //this executes if the password didnt match
            } else {
                $message = "Username or Password is incorrect";
            }
        } else {
            $message = "Username or Password is incorrect";
        }
    }
 ?>

<!DOCTYPE HTML>
<html>
    <head>
        <link rel = "stylesheet" href = "style.css">
    </head>
    <body>
        <h1>Linkup</h1>
        <nav>
            <a href = "index.php">Home</a>
            <a href = "login.php">Log in</a>
            <a href = "forum.php">Explore</a>
        </nav>
        <h2>Log In</h2>
            
            <form method="POST" action="login.php">
                <input type="hidden" name="submitted" value="1">
                <label for = "username">Username:</label>
                <input type = "text" id = "username" name="username">
                <label for = "password">Password:</label>
                <input type = "password" id = "password" name="password">
                <input type = "submit" value = "Submit">
        </form>
        
        <?php if (!empty($message)): ?>
            <p class="form-message"><?php echo $message; ?></p>
        <?php endif; ?>
        <a href="signup.php"><p id="logInLink">No Account? Click here to create one!</p></a>
    </body>
</html>
