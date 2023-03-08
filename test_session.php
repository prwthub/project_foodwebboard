<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Session</title>
</head>
<body>
    <?php 
        session_start();
        echo session_id(),"<BR>";
        echo "user id = ",$_SESSION["user_id"],"<BR>";
        echo "name = ",$_SESSION['username'],"<BR>";
        echo "role = ",$_SESSION['role'],"<BR>";
        
        echo "<a href='logout.php'>log out</a>"
    ?>
</body>
</html>