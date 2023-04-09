<!--*********************ลบ Images post******************************* -->
<?php
session_start();
require 'dbConfig_PDO.php';

$user_id = $_SESSION['user_id'];

$sql = "DELETE FROM images_user WHERE user_id = $user_id";
$conn->exec($sql);

header("location: myprofile.php");
$db = null;
die();

?>