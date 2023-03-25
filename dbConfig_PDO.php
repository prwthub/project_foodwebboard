<?php 
// Database configuration
$server_name = "localhost";
$username = "root";
$password = "";
$database = "webboard_recipes";
       
// Create database connection
try {
    $dbo = new PDO('mysql:host='.$host_name.';dbname='.$database, $username, $password);
    } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
    }
?>
?>