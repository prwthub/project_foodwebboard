<?php 
// Database configuration
$server_name = "localhost";
$username = "root";
$password = "";
$database = "webboard_recipes";
       
// Create database connection
try {
    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");
    } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
    }
?>