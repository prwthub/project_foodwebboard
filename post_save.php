<!--*********************ส่ง comment ขึ้น database******************************* -->
<?php
    // ตัวอย่าง
    session_start();
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $database = "webboard_recipes";

    $comment = $_POST['comment'];
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];
    
    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8","$username","$password");
    $sql = "INSERT INTO comment(comment_content,user_id,post_id) VALUES
                                 ('$comment', '$user_id', '$post_id')";
    $conn->exec($sql);
    header("location: post.php?id=$post_id");
    $conn = null;
    die();
?>