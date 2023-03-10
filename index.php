<?php
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Home page</title>
  <link rel="stylesheet" href="style.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PhanTripDotCom</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>

  <form method="GET" action="search.php">
    <?php include "nav.php"; ?>
    <div class="d-flex justify-content-center my-5">
      <a href="newpost.php">
        <button type="button" class="btn btn-primary">ADD FOOD MENU</button>
      </a>
    </div>

    <table class="table table-striped">
      <?php
      $server_name = "localhost";
      $username = "root";
      $password = "";
      $database = "webboard_recipes";

      $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");
      $conn->exec("SET CHARACTER SET utf8");

      $data = $conn->query("SELECT p.category_id,p.post_title,p.user_id,p.user_name,p.post_date,p.post_like,p.post_dislike,p.post_id FROM post p , category c order by p.post_id DESC;");
      if($data !== false){
          while($row = $data->fetch()){
          // echo "<tr><td><a href=\"post.php?id=".$row['0'].'\" style=text-decoration:none></a>"; 
          echo "<tr><td>";
          echo "[ ".$row['0']." ] ";   
          echo "<a href=\"post.php?id=".$row['6']."\" style=text-decoration:none>";            
          echo $row['1']."</a>";
          echo "<br>";
          echo $row['2']." - " . $row['3']." - " . $row['4'];
          echo "<br>";
          echo "<div style='text-align:right'> Like - " . $row['5'] . " Dislike - " . $row['6'];
          echo "</td></tr>";   

          }
      }
      $conn = null;
      ?>

  </form>

</body>

</html>