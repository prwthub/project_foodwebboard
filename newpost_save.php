<!--*********************ส่ง post ขึ้น database******************************* -->
<?php
session_start();
require 'dbConfig_PDO.php';
require 'dbConfig_SQLi.php';

$user_id = $_SESSION['user_id'];
$category_id = $_POST['type'];
$menuname = $_POST['menuname'];
$content = $_POST['content'];

$tag = $_POST['tag'];
$ingredient = $_POST['ingredient'];

$sql = "INSERT INTO post(user_id, category_id, post_title, post_content, post_date) 
                    VALUES  ('$user_id', '$category_id', '$menuname', '$content', NOW())";
$conn->exec($sql);

$conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");
$data = $conn->query("SELECT post_id FROM post ORDER BY post_id DESC;");
while ($row = $data->fetch()) {
    $id = $row["post_id"];
    break;
}
$stmt1 = $db->prepare("UPDATE post SET post_ingredient = (?) WHERE post_id = $id");
$stmt1->bind_param("s", json_encode($ingredient));
$stmt1->execute();
$stmt1->close();
$stmt2 = $db->prepare("UPDATE post SET post_tag = (?) WHERE post_id = $id");
$stmt2->bind_param("s", json_encode($tag));
$stmt2->execute();
$stmt2->close();

header("location: post.php?id=$id");
$conn = null;
?>