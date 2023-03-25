<!--*********************ลบ Images post******************************* -->
<?php
session_start();
require 'dbConfig_PDO.php';

$id = $_POST['id'];

$sql = "DELETE FROM images_post WHERE post_id = $id";
$conn->exec($sql);

header("location: post.php?id=$id");
$db = null;
die();

?>