<?php 
    session_start();
    
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $database = "webboard_recipes";

    $id = $_GET["id"];
    $uid = $_SESSION['user_id'];
    $cid = $_SESSION['comment_id'];
    $pid = $_SESSION['post_id'];

    // echo "id = ".$id;
    // echo "<BR>user_id = ".$uid;
    // echo "<BR>comment_id = ".$cid;
    // echo "<BR>post_id = ".$pid;

    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");
    $sql_comment = "DELETE FROM comment WHERE post_id = $pid and comment_id = $id";
    $conn->query($sql_comment);

    unset($_SESSION['comment_id']);
    header("location:post.php?id=".$pid);
    die();
    

?>
