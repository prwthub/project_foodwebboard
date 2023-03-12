<!--*********************ส่ง post ขึ้น database******************************* -->
<?php
    session_start();
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $database = "webboard_recipes";

    $user_id = $_SESSION['user_id'];
    $topic = $_POST['topic'];
    $comment = $_POST['comment'];
    $picture = $_POST['picture'];
    $post_id = $_POST['post_id'];

    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8","$username","$password");
    $sql = "INSERT INTO post(user_id, category_id, post_title, post_content, post_picture, post_date, post_ingredient) 
                VALUES  ('$user_id', ' ', '$topic', '$comment', '$picture', NOW(), ' ')";
    $conn->exec($sql);
    header("location: post.php?id=$post_id");
    $conn = null;
    die();
?>