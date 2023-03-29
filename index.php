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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<script type="text/javascript">

  // Script for delete button (ADMIN only)
  function deletePost() {
    let areYouSure = confirm("Do you really want to delete this post?");
    if (areYouSure == true) {
      alert("Post deleted");
      return areYouSure;
    } else {
      return areYouSure;
    }
  }

</script>

<body>
  <?php
  // echo "session['id'] = ".session_id()."<BR>";
  // echo "session['id'] = ".$_SESSION['id']."<BR>";
  // echo "session['user_id'] = ".$_SESSION['user_id']."<BR>";
  // echo "session['username'] = ".$_SESSION['username'];
  ?>

  <form method="GET" action="deletePost.php">
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
      // Include the database configuration file  
      require_once 'dbConfig_SQLi.php';
      require 'dbConfig_PDO.php';

      $conn->exec("SET CHARACTER SET utf8");
      

      // Get image data from database 
      
      $data = $conn->query("SELECT p.category_id,p.post_title,p.user_id,u.user_name,p.post_date,p.post_like,p.post_dislike,p.post_id,p.post_view
                            FROM post p, user u WHERE p.user_id = u.user_id ORDER BY p.post_id DESC;");
                            
      if ($data !== false) {
        while ($row = $data->fetch()) {
          $category_id = $row['0'];
          $post_title = $row['1'];
          $user_id = $row['2'];
          $user_name = $row['3'];
          $post_date = $row['4'];
          $post_like = $row['5'];
          $post_dislike = $row['6'];
          $post_id = $row['7'];
          $post_view = $row['8'];

          $result = $db->query("SELECT image, post_id FROM images_post WHERE post_id = $post_id");
          
          // echo "<tr><td><a href=\"post.php?id=".$row['0'].'\" style=text-decoration:none></a>"; 
          echo "<tr><td><div class = 'row'>";
          ?>
            <div class="gallery">
                <?php while ($img = $result->fetch_assoc()) { 
                    if($img['post_id'] == $post_id){
                    ?>
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($img['image']); ?>" width="100" height="100" />
                    <?php 
                    }
                  } ?>
            </div>
          <?php 
          echo "<div class = 'col'>" . " [ " . $post_id . " ] "; // post_id
          echo "<a href=\"post.php?id=" . $post_id . "\" style=text-decoration:none>";
          echo $post_title . "</a></div>"; // post_title
          // If role ADMIN, Show Delete button
          if (isset($_SESSION["role"])) {
            if ($_SESSION["role"] == "a") {
              echo "<div class = 'col d-flex justify-content-end'>";
              echo "<a href=\"deletePost.php?id=" . $post_id . "\" class=\"btn btn-danger bi bi-trash\" 
              onclick='return deletePost();'></a></div>";
            }
          }
          echo "</div>";
          echo "<div class = 'row'><div class = 'col'>" . $user_name . " - " . $post_date . "</div>"; // user_name , post_date
          echo "<div class = 'col d-flex justify-content-end'>";
          echo "View - ".$post_view." Like - " . $post_like . " Dislike - " . $post_dislike . "</div>"; // post_like , post_dislike
          echo "</div></td></tr>";
        }
      }
      $conn = null;
      ?>

  </form>

</body>

</html>