<?php 
    session_start();
    
    require 'dbConfig_PDO.php';
    
    $id = $_GET["id"];
    $uid = $_SESSION['user_id'];
    $cid = $_SESSION['comment_id'];
    $pid = $_SESSION['post_id'];

    // echo "id = ".$id;
    // echo "<BR>user_id = ".$uid;
    // echo "<BR>comment_id = ".$cid;
    // echo "<BR>post_id = ".$pid;

    $sql_comment = "DELETE FROM comment WHERE comment_id = $id";
    $conn->query($sql_comment);

    unset($_SESSION['comment_id']);
    header("location:post.php?id=".$pid);
    die();
    

?>
