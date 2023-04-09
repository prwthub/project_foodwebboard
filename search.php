<?php
    session_start();
    require 'dbConfig_PDO.php';
    
    $search = $_GET["search"];

    $_SESSION["search"] = "$search";
    header("location: index.php"); 

    // echo $search;

    // $sql = "SELECT * FROM post WHERE (post_title LIKE CONCAT('%', '$search', '%') OR post_tag LIKE CONCAT('%', '$search', '%'));";
    // $data = $conn->query($sql);
    // if ($data != false) {
    //     while ($row = $data->fetch()) {
    //         echo "<br>";
    //         echo "$row[post_title] and $row[post_tag]";
    //     }
    // }
?>