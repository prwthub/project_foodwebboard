<?php
// connect to database
session_start();
require 'dbConfig_PDO.php';

$like = 0;
$dislike = 0;
// lets assume a user is logged in with id $user_id
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];
    $rating = $_POST['rating'];

    echo $rating . '<BR>';
    echo $post_id . '<BR>';
    echo $user_id . '<BR>';
} else {
    $user_id = 0;
    $post_id = $_POST['post_id'];
    $rating = $_POST['rating'];

    echo $rating . '<BR>';
    echo $post_id . '<BR>';
    echo $user_id . '<BR>';
}

if (isset($_POST['rating'])) {
    switch ($rating) {
        case '1':
            echo 'LIKE';
            $sql = "INSERT INTO rating_post (user_id, post_id, rating) 
         	   VALUES ($user_id, $post_id, '1') 
         	   ON DUPLICATE KEY UPDATE rating='1'";
            break;
        case '2':
            echo 'UNLIKE';
            $sql = "DELETE FROM rating_post WHERE user_id = $user_id AND post_id = $post_id";
            break;
        case '-1':
            echo 'DISLIKE';
            $sql = "INSERT INTO rating_post (user_id, post_id, rating) 
         	   VALUES ($user_id, $post_id, '-1') 
         	   ON DUPLICATE KEY UPDATE rating='-1'";
            break;
        case '-2':
            echo 'UNDISLIKE';
            $sql = "DELETE FROM rating_post WHERE user_id = $user_id AND post_id = $post_id";
            break;
        default:
            break;
    }
    $conn->exec($sql);
    $conn = null;
    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8","$username","$password");
    $sql = $conn->query("SELECT * FROM rating_post WHERE post_id = $post_id");
    if ($sql != false) {
        while ($row = $sql->fetch()) {
            if($row['rating'] == 1){
                $like++;
            }else{
                $dislike++;
            }
        }
    }
    echo '<BR>LIKE:'.$like.'<BR>';
    echo 'DISLIKE:'.$dislike;
    $conn = null;
    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8","$username","$password");
    $update = ("UPDATE post SET post_like = '$like', post_dislike = '$dislike' WHERE post_id = $post_id");
    $conn->exec($update);
    header("location: post.php?id=$post_id");
    $conn = null;
    die();
}