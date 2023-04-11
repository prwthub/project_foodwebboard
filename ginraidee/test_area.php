<?php  
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $database = "webboard_recipes";

    $dbo = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");
    $q=" SELECT * FROM post ";
    echo "<table class='table my_table'>
    <tr class='info'> <th> Image </th><th>Name</th><th>ID</th><th>Price</th></tr>";

    foreach ($dbo->query($q) as $row) {
        echo "<tr><td><img src=images/$row[post_picture] class='rounded-circle' alt='$row[post_title]'></td><td>$row[post_id]</td></tr>";
    }
    echo "</table>";
?>