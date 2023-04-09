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
    <?php include "nav.php" ?>
    <div class="container-fluid">

        <br>

        <?php
        // ถ้า ไม่ใช่ role a (admin) ให้กลับไป index
        if (!isset($_SESSION["role"]) == "a") {
            header("location:index.php");
        } else {
            $id = $_GET["id"];
            require 'dbConfig_PDO.php';
            
            $conn->exec("SET CHARACTER SET utf8");
            $sql_comment = "DELETE FROM comment WHERE post_id = $id";
            $query = $conn->query($sql_comment);
            $sql_images = "DELETE FROM images_post WHERE post_id = $id";
            $conn->exec($sql_images);
            $sql_rating = "DELETE FROM rating_post WHERE post_id = $id";
            $query = $conn->query($sql_rating);
            $sql_post = "DELETE FROM post WHERE post_id = $id";
            $query = $conn->query($sql_post);

            if(isset($_SESSION["mymenu"])){
                header("location:mymenu.php"); 
            }else{
                header("location:index.php");    
            }
           

        }

        $conn = null;
        ?>
    </div>
</body>

</html>