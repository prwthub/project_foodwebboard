<!--*********************ส่ง post ขึ้น database******************************* -->
<?php
    session_start();
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $database = "webboard_recipes";

    $user_id = $_SESSION['user_id'];
    $category_id = $_POST['type'];
    $menuname = $_POST['menuname'];
    $ingre = $_POST['ingre'];
    $content = $_POST['content'];
    $picture = $_POST['picture'];
    $post_id = $_POST['post_id'];

    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8","$username","$password");
    $sql = "INSERT INTO post(user_id, category_id, post_title, post_ingredient, post_content, post_picture, post_date) 
                    VALUES  ('$user_id', '$category_id', '$menuname', '$ingre', '$content', '$picture', NOW())";
    $conn->exec($sql);
    //header("location: post.php?id=$post_id");
    // เดียวแก้ปัญหา อีก table อัพข้อมูลไม่ทัน
    // ด้วยการสร้าง newpost_verify

    header("location: index.php");
    
    $conn = null;
    die();
?>