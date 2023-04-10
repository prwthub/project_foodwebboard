<?php
session_start();
unset($_SESSION["mymenu"]);
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
  <!-- Import Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@200;400;600;900&display=swap"
    rel="stylesheet">
</head>

<style>
  .card {
    padding: 15px;
    border-radius: 50px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
  }

  section {
    display: block;
  }

  .food-circle {
    width: 100pt;
    height: 100pt;
    border-radius: 20%
  }

  .contain-rounder {
    width: 50%;
    height: 50%;
    border-radius: 20%
  }

  hr.solid {
    border-top: 3px solid #bbb;
  }

  .centerBlock {
    display: table;
    margin: auto;
  }

  .responsiveImage {
    width: 75%;
    height: 10vw;
    object-fit: cover;

  }
</style>

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

<body style="background-color:#7fd4d2">
  <?php
  // echo "session['id'] = ".session_id()."<BR>";
  // echo "session['id'] = ".$_SESSION['id']."<BR>";
  // echo "session['user_id'] = ".$_SESSION['user_id']."<BR>";
  // echo "session['username'] = ".$_SESSION['username'];
  ?>
  <?php include "nav.php"; ?>
  <form method="GET" action="deletePost.php">



    <div class="container-sm bg-white rounded pt-3" style="margin-top:20px" ;> <!-- Main container -->

      <?php
      if (!isset($_SESSION["search"])) {
        ?>
        <section>
          <div class="card mx-3 rounded" ;>
            <img
              src="https://www.cnet.com/a/img/resize/69256d2623afcbaa911f08edc45fb2d3f6a8e172/hub/2023/02/03/afedd3ee-671d-4189-bf39-4f312248fb27/gettyimages-1042132904.jpg?auto=webp&fit=crop&height=675&width=1200">
            <div class="d-flex card-body card-img-overlay">
              <div class="pt-5 px-5 card-footer bg-dark text-white">

                <h1 class="card-title text-white mt-auto">

                  สวัสดีครับ
                </h1>

                <p class="card-subtitle mb-2 text-white">

                  วันนี้ทำอะไรทานดี ~

                </p>
                <hr class="solid">
                <h1 class="card-title text-white mt-auto">
                  หรือ
                </h1>

                <p class="card-subtitle mb-2 text-white" style="text-decoration: underline">

                  อยากเพิ่มเมนูขึ้นมาเอง

                </p>



                <a href="newpost.php">
                  <!-- session ที่เอาไว้เตือนว่าถ้าไม่ log in ไม่สามารถ newpost ได่ -->

                  <button type="button" class="btn btn-primary">เพิ่มเมนูอาหาร</button>
                  <?php
                  if (isset($_SESSION["add_post"])) {
                    ?>

                    <div class="col-md-5">
                      <?php
                      // register error
                      if ($_SESSION["add_post"] == 'error') {
                        echo "<p class=\"alert alert-danger bi bi-x-circle\" role=\"alert\">";
                        echo "    คุณจำเป็นต้องเข้าสู่ระบบก่อนถึงจะสามารถเพิ่มโพสได้";
                        echo "</p>";
                        unset($_SESSION["add_post"]);
                      }
                      ?>
                    </div>
                    <?php
                  }
                  ?>
                </a>

              </div>
            </div>
          </div>
        </section>
        <?php
      }
      ?>

      <hr class="solid">

      <div class="container-fluid d-flex bg-info justify-content-center pt-3 pb-2">

        <h1 style="text-decoration:underline"> เมนูอาหารจากทาง Community </h1>

      </div>
      <?php
      // Include the database configuration file  
      require_once 'dbConfig_SQLi.php';
      require 'dbConfig_PDO.php';

      $conn->exec("SET CHARACTER SET utf8");


      // Get image data from database 
      if (isset($_SESSION["search"])) {
        $search = $_SESSION["search"];
        echo "<h1>ผลการค้นหา : $search</h1>";
        $data = $conn->query("SELECT * FROM post WHERE (post_title LIKE CONCAT('%', '$search', '%') OR post_tag LIKE CONCAT('%', '$search', '%'));");
      } else {
        $data = $conn->query("SELECT p.category_id,p.post_title,p.user_id,u.user_name,p.post_date,p.post_like,p.post_dislike,p.post_id,p.post_view
          FROM post p, user u WHERE p.user_id = u.user_id ORDER BY p.post_id DESC;");
      }
      unset($_SESSION['search']);

      if ($data !== false) {
        while ($row = $data->fetch()) {
          //$category_id = $row['0'];
          $post_title = $row['post_title'];
          $user_id = $row['user_id'];
          //$user_name = $row['user_name'];
          $post_date = $row['post_date'];
          $post_like = $row['post_like'];
          $post_dislike = $row['post_dislike'];
          $post_id = $row['post_id'];
          $post_view = $row['post_view'];

          $result = $db->query("SELECT image, post_id FROM images_post WHERE post_id = $post_id");

          // echo "<tr><td><a href=\"post.php?id=".$row['0'].'\" style=text-decoration:none></a>"; 
          ?>

          <section>

            <div class='container-fluid card' style='margin-top:20px'>

              <div class="row">

                <div class="col-xs-6 col-sm-4 text-center center">
                  <?php
                  while ($img = $result->fetch_assoc()) {
                    if ($img['post_id'] == $post_id) {
                      ?>
                      <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($img['image']); ?>"
                        class='card-img-top food-circle responsiveImage' />

                    <?php } else { ?>
                      <img
                        src=""
                        class='card-img-top food-circle responsiveImage' />
                    <?php }
                  } ?>
                </div>
                <?php
                $dataname = $conn->query("SELECT user_name FROM user WHERE user_id = $user_id  ;");
                if ($dataname !== false) {
                  while ($name = $dataname->fetch()) {
                    $user_name = $name['user_name'];
                  }
                }

                echo "<div class = 'col-xs-6 col-sm-4 text-end lead centerBlock'>"; //. " [ " . $post_id . " ] "; // post_id"
            
                echo "<a href=\"post.php?id=" . $post_id . "\" style=text-decoration:none class = 'red'>";
                echo $post_title . "</a>"; // post_title
                echo "<br>" . "<i class='bi bi-eye'></i>&nbsp" . $post_view . " |" . "<i class='bi bi-hand-thumbs-up'></i>&nbsp" .
                  $post_like . "&nbsp<i class='bi bi-hand-thumbs-down'></i>&nbsp" . $post_dislike . "</div>"; // post_like , post_dislike
            
                echo "<div class = 'col-xs-6 col-sm-4 centerBlock'>";
                echo "<h3>Posted by</h3>";
                echo "<h5 class = 'bold'>" . $user_name . "</h5>" . "" . $post_date . "</div>"; // user_name , post_date
            

                // If role ADMIN, Show Delete button              
                if (isset($_SESSION["role"])) {
                  if ($_SESSION["role"] == "a") {
                    echo "<div class = 'd-flex pt-2 px-5 justify-content-end'>";
                    echo "<a href=\"deletePost.php?id=" . $post_id . "\" class=\"btn btn-danger bi bi-trash\" 
                            onclick='return deletePost();'> Delete</div></a>";
                  }
                }
                ?>
              </div>
            </div>
          </section>
          <?php
        }
      }
      $conn = null;
      $db = null;

      ?>

  </form>

</body>

</html>