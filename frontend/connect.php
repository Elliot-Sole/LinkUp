<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    try {

      //connects to our sql database using the username and password variables
        $kayo = new PDO("mysql:host=$servername;dbname=linkup", $username, $password);
        $kayo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "connected Successfully";
      } catch(PDOException $e) {
        //throws an error if the connection fails
        echo "Connection failed: " . $e->getMessage();
      }
?>
