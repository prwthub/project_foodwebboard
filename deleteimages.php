<!--*********************ลบ Images post******************************* -->
<?php
session_start();
$server_name = "localhost";
$username = "root";
$password = "";
$database = "webboard_recipes";

$id = $_POST['id'];

$conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");
$sql = "DELETE FROM images WHERE post_id = $id";
$conn->exec($sql);

header("location: post.php?id=$id");
$db = null;
die();

?>