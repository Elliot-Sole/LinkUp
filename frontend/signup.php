<?php 
    require 'connect.php';
    $message = ""; // <-- message variable

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitted'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
        if ($username == null || $_POST['password'] == null || $email == null) {
            $message = "Email, username or password is missing  ";
        } else {
            // Check if user already exists
            $stmt = $kayo->prepare('SELECT username, email FROM users WHERE username = ? OR email = ?');
            $stmt->execute([$username, $email]);
    
            if ($row = $stmt->fetch()) {
                $message = "Account already exists";
        } else { 
            $stmt = $kayo->prepare("INSERT INTO users (email, username, password) VALUES (:email, :username, :password)");
            $stmt -> bindParam(':email', $email);
            $stmt -> bindParam(':username', $username);
            $stmt -> bindParam(':password', $password);
            $stmt->execute();
        //    header("Location: index.php");
        }
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
        <h2>Sign Up</h2>
        <form method="POST" action="signup.php">
            <input type="hidden" name="submitted" value="1">
            <label for = "email">Email:</label>
            <input type = "email" id = "email" name="email">
            <label for = "username">Username:</label>
            <input type = "text" id = "username" name="username">
            <label for = "password">Password:</label>
            <input type = "password" id = "password" name="password">
            <input type = "submit" value = "Submit">
            <?php if (!empty($message)): ?>
                    <p class="form-message"><?php echo $message; ?></p>
            <?php endif; ?>
        </form>
    </body>
</html>
