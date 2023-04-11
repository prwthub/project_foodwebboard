<?php
session_start();

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

            // if(isset($_SESSION["mymenu"])){
            //     header("location:mymenu.php"); 
            // }else{
            //     header("location:index.php");    
            // }
            //header("location:index.php");  

        } 
        
        if(isset($_SESSION["mymenu"])){
            header("location:mymenu.php"); 
            //echo "yes";
        }else{
            header("location:index.php");    
            //echo "no";
        }
        unset($_SESSION["mymenu"]);
        $conn = null;    
