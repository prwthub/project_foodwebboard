<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Home Page</title>
  <link rel="stylesheet" href="style.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>

  <form method="GET" action="search.php">
    <?php include "nav.php"; ?>
    <div class="justify-content-center my-5">
      <a href="newpost.php">
        <!-- session ที่เอาไว้เตือนว่าถ้าไม่ log in ไม่สามารถ newpost ได่ -->
        <?php
        if (isset($_SESSION["add_post"])) {
        ?>
          <div class="row mt-3">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <?php
              // register error
              if ($_SESSION["add_post"] == 'error') {
                echo "<center><div class=\"alert alert-danger bi bi-x-circle\" role=\"alert\" style='width:60%'>";
                echo "  คุณจำเป็นต้องเข้าสู่ระบบก่อนถึงจะสามารถเพิ่มโพสได้";
                echo "</div></center>";
                unset($_SESSION["add_post"]);
              }
              ?>
            </div>
            <div class="col-md-3"></div>
          </div>
        <?php
        }
        ?>
        <center><button type="button" class="btn btn-primary">ADD FOOD MENU</button></center>
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

      $data = $conn->query("SELECT p.category_id,p.post_title,p.user_id,u.user_name,p.post_date,p.post_like,p.post_dislike,p.post_id 
                            FROM post p , user u WHERE p.user_id = u.user_id ORDER BY p.post_id DESC;");
      if ($data !== false) {
        while ($row = $data->fetch()) {
          // echo "<tr><td><a href=\"post.php?id=".$row['0'].'\" style=text-decoration:none></a>"; 
          echo "<tr><td>";
          echo "[ " . $row['7'] . " ] "; // post_id
          echo "<a href=\"post.php?id=" . $row['7'] . "\" style=text-decoration:none>";
          echo $row['1'] . "</a>"; // post_title
          echo "<br>";
          echo " " . $row['3'] . " - " . $row['4']; // user_name , post_date
          echo "<br>";
          echo "<div style='text-align:right'> Like - " . $row['5'] . " Dislike - " . $row['6']; // post_like , post_dislike
          echo "</td></tr>";
        }
      }
      $conn = null;
      ?>

  </form>

</body>

</html>