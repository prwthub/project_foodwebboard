<!--*********************ส่ง comment ขึ้น database******************************* -->
<?php
    // ตัวอย่าง
    session_start();
    require 'dbConfig_PDO.php';

    $comment = $_POST['comment'];
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];
    
    $sql = "INSERT INTO comment(comment_content, user_id, post_id, comment_time) VALUES
                                 ('$comment', '$user_id', '$post_id', NOW())";
    $conn->exec($sql);
    header("location: post.php?id=$post_id"); 
    $conn = null;
    die();
?>