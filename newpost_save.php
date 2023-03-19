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

    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8","$username","$password");
    $sql = "INSERT INTO post(user_id, category_id, post_title, post_ingredient, post_content, post_date) 
                    VALUES  ('$user_id', '$category_id', '$menuname', '$ingre', '$content', NOW())";
    $conn->exec($sql);
    
    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8","$username","$password");
    $data = $conn->query("SELECT post_id FROM post ORDER BY post_id DESC;");
    while ($row = $data->fetch()) {
        $id = $row["post_id"];
        break;
    }
    header("location: post.php?id=$id");
    $conn = null;
?>