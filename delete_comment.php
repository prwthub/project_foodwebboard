<?php 
    session_start();
    
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $database = "webboard_recipes";

    $uid = $_SESSION['user_id'];
    $cid = $_SESSION['comment_id'];
    $pid = $_SESSION['post_id'];


    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");
    $sql_comment = "DELETE FROM comment WHERE post_id = $pid and comment_id = $cid";
    $conn->query($sql_comment);

    unset($_SESSION['comment_id']);
    header("location:post.php?id=".$pid);
    die();
    

?>
