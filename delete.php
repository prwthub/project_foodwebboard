<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>...</title>
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container-fluid">
        <?php include "nav.php" ?>
        <br>
        
        <?php
            // ถ้า ไม่ใช่ role a (admin) ให้กลับไป index
            if(!isset($_SESSION["role"]) == "a"){
                header("location:index.php");
            }
            else{
                $id_post = $_GET["id"];
                echo "<center>Delete post number $id_post</center>" ;
                
                $server_name = "localhost";
                $username = "root";
                $password = "";
                $database = "webboard_recipes";
          
                $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");
                $conn->exec("SET CHARACTER SET utf8");

                $sql_post = "DELETE FROM post WHERE post_id = $id_post";
                $query = $conn->query($sql_post);

                //DELETE FROM comment WHERE post_id = 9;
                $sql_comment = "DELETE FROM comment WHERE post_id = $id_post";
                $query = $conn->query($sql_comment);
                $conn = null;
                
            }
                
        ?>
    </div>
</body>
</html>