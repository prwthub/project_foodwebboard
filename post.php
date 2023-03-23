<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
    <!--Icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>
        <?php
        $server_name = "localhost";
        $username = "root";
        $password = "";
        $database = "webboard_recipes";

        $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");
        //isset($_GET['id']) ? $id = $_GET['id'] : header("Location: index.php");
        $id = $_GET['id'];

        $data = $conn->query("SELECT p.post_title,u.user_name,p.user_id,u.user_id FROM post p , user u WHERE p.post_id = $id and p.user_id = u.user_id;");
        if ($data !== false) {
            while ($row = $data->fetch()) {
                echo "$row[0] โดย $row[1]";
            }
        }
        $conn = null;
        ?>

    </title>
</head>

<script type="text/javascript">

  // Script for delete button (ADMIN only)
  function deleteComment() {
    let areYouSure = confirm("Do you really want to delete this comment?");
    if (areYouSure == true) {
      alert("Comment deleted");
      return areYouSure;
    } else {
      return areYouSure;
    }
  }

</script>

<body>
    <?php
    include "nav.php";
    ?>
    <div class="container-xxl">
        <section class="col-md-8 mx-auto m-3">
            <?php
            isset($_GET['id']) ? $id = $_GET['id'] : header("Location: index.php");
            //echo "<center>ต้องการดูกระทู้หมายเลข $id <br>";
            
            // ******************connect database****************************
            $server_name = "localhost";
            $username = "root";
            $password = "";
            $database = "webboard_recipes";

            $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");
            // ข้อมูลที่ดึงขึ้นแสดงที่ Post
            $data = $conn->query("SELECT p.post_id, p.post_title, p.post_date, p.category_id, c.category_tag, p.post_ingredient, p.post_content, p.post_picture, u.user_username , p.user_id , u.user_id 
                                    FROM post p , user u , category c 
                                    WHERE p.post_id = $id and p.category_id = c.category_id and u.user_id = p.user_id");

            $sql = "SELECT * FROM post p , user u , category c 
            WHERE p.post_id = $id AND p.user_id = u.user_id OR p.category_id = c.category_id";
            $query = $conn->query($sql);
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // ดึงข้อมูลมาใช้งาน จาก DATABASE 
            $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");
            $data = $conn->query("SELECT p.post_id, p.post_title, p.post_date, p.category_id, p.post_ingredient, p.post_content, u.user_username, p.user_id, u.user_id, c.category_tag, c.category_id,
                                        p.post_like, p.post_dislike, p.post_view ,p.post_picture/* ******************************* เรียกรูปจาก database *********************************************** */ 
                                    FROM post p , user u , category c 
                                    WHERE p.post_id = $id and p.category_id = c.category_id and u.user_id = p.user_id");

            $post_id;
            $post_title;
            $post_date;
            $category_id;
            $post_ingredient;
            $post_content;
            $user_username;
            $user_id;
            $category_tag;

            $post_like;
            $post_dislike;
            $post_view;

            // ดึงข้อมูลมาใช้งาน จาก DATABASE 
            if ($data !== false) {
                while ($row = $data->fetch()) {
                    // echo "p.post_id = $row[0]                  id = $id <bR>";
                    // echo "p.user_id = $row[7]           u.user_id = $row[8] <bR>";
                    // echo "p.category_id = $row[3]   c.category_id = $row[9] <bR>";
                    // echo "<BR><BR>";
            
                    $post_id = $row[0];
                    $post_title = $row[1];
                    $post_date = $row[2];
                    $category_id = $row[3];
                    $post_ingredient = $row[4];
                    $post_content = $row[5];
                    $user_username = $row[6];
                    $user_id = $row[7];
                    //$user_id = $row[8];
                    $category_tag = $row[9];
                    $category_id = $row[10];

                    $post_like = $row[11];
                    $post_dislike = $row[12];
                    $post_view = $row[13];
                    $post_picture = $row[14];

                    // echo "<BR><BR><BR>";
                    // echo $post_id . "<BR>";
                    // echo $post_title . "<BR>";
                    // echo $post_date . "<BR>";
                    // echo $category_id . "<BR>";
                    // echo $post_ingredient . "<BR>";
                    // echo $post_content . "<BR>";
                    // echo $user_username . "<BR>";
                    // echo $user_id . "<BR>";
                    // echo $user_id . "<BR>";
                    // echo $category_id . "<BR>";
                }
            }
            ?>

            <!--*********************ส่วนแสดง post******************************* -->
            <div class="card text-dark bg-white border-primary mb-3">
                <div class="card-header alert alert-primary">
                    <strong>
                        <?php
                        echo "<div class = 'd-flex justify-content-between'>
                            <div> $post_title </div>
                            <div style='text-align:right'> view : $post_view </div>
                            </div>";
                        echo "<div class = 'd-flex justify-content-between'>
                            <div> $post_date </div>
                            <div style='text-align:right'> like : $post_like  dislike : $post_dislike </div>
                            </div>";
                        ?>
                    </strong>
                </div>
                <div class="card-body pb-1">
                    <div class="container row mb-3 justify-content-between">

                        <?php
                        echo "รูป :";
                        // Include the database configuration file  
                        require_once 'dbConfig.php';

                        // Get image data from database 
                        $result = $db->query("SELECT image FROM images WHERE post_id = $id");
                        ?>

                        <?php if ($result->num_rows > 0) { ?>
                            <div class="gallery">
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" />
                                    <?php if ($user_id == $_SESSION['user_id']) { ?>
                                        <form action="deleteimages.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?= $id; ?>">
                                            <input type="submit" name="photo" value="deleted photo">
                                        </form>
                                    <?php } ?>
                                <?php } ?>

                            </div>
                        <?php } else if ($user_id == $_SESSION['user_id']) { ?>
                                <form action="upload.php" method="post" enctype="multipart/form-data">
                                    <label>Select Image File:</label>
                                    <input type="hidden" name="id" value="<?= $id; ?>">
                                    <input type="file" name="image">
                                    <input type="submit" name="submit" value="Upload">
                                </form>
                        <?php } else { ?>
                                <label>No Image Here</label>
                        <?php } ?>

                        <?php
                        //******************************** เรียกรูปจาก database *********************************************** */ 
                        echo "ประเภท : $category_tag <BR>";
                        echo "วัตถุดิบ : $post_ingredient <BR><BR>";
                        echo "$post_content <BR><BR>";
                        echo "เขียนโดย - $user_username <BR>";
                        ?>
                    </div>
                </div>
            </div>
            <!-- เรียงคอมเมนต์ในโพส  -->
            <div class="d-flex pb-2">
                <div class="input-group">
                    <label>เรียงโดย: </label>
                    <form method="Post">
                        <button type="submit" name="sort" class="button" value="1">เก่า-ใหม่</button>
                        <button type="submit" name="sort" class="button" value="0">ใหม่-เก่า</button>
                    </form>
                </div>
            </div>

            <!--*********************ส่วนแสดง comment (input)******************************* -->
            <?php
            // ต้อง login ก่อนถึงคอมเม้นได้
            if (isset($_SESSION["id"])) {
                ?>
                <div class="card text-dark bg-white border-success">
                    <div class="card-header bg-success text-white">แสดงความคิดเห็น</div>
                    <div class="card-body">
                        <!-- ส่งข้อมูล comment ไปยัง post_save -->
                        <form action="post_save.php" method="post">
                            <input type="hidden" name="post_id" value="<?= $id; ?>">
                            <div class="row mb-3 justify-content-center">
                                <div class="col-lg-10">
                                    <textarea name="comment" class="form-control" rows="8"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <center>
                                        <button type="submit" class="btn btn-success btn-sm text-white">
                                            <i class="bi bi-box-arrow-up-right me-1"></i>
                                            ส่งข้อความ
                                        </button>
                                    </center>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br><br>
                <?php
            }
            ?>

            <?php
            //<!--*********************ส่วนแสดง comment******************************* -->
            
            // Sort By Date
            $conn = null;
            $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");
            if (isset($_POST['sort']) && !empty($_POST['sort']) && $_POST['sort'] == 1) {
                $comment = $conn->query("SELECT p.post_id, u.user_name, u.user_id, c.comment_content, c.user_id, c.comment_id, c.post_id 
                    FROM post p , user u , comment c 
                    WHERE p.post_id = c.post_id AND c.user_id = u.user_id AND c.post_id = $id ORDER BY c.comment_id ASC");
            } else {
                $comment = $conn->query("SELECT p.post_id, u.user_name, u.user_id, c.comment_content, c.user_id, c.comment_id, c.post_id 
                    FROM post p , user u , comment c 
                    WHERE p.post_id = c.post_id AND c.user_id = u.user_id AND c.post_id = $id ORDER BY c.comment_id DESC");
            }

            // ข้อมูลสำหรับแสดง Comment
            if ($comment !== false) {
                while ($comm = $comment->fetch()) {
                    ?>
                    <div class="card text-dark bg-white border-info mb-3">
                        <div class="card-header bg-info text-white">
                            <?php echo "ความคิดเห็นจาก " . $comm['1'];
                            // คนเขียนสามารถลบ comment 
                            if ($_SESSION["user_id"] == $comm['2']) {
                                $_SESSION["comment_id"] = $comm['5'];
                                $_SESSION["post_id"] = $comm['0'];
                                echo "comment_id = ".$_SESSION['comment_id'];
                                echo "post_id = ".$_SESSION['post_id'];
                                echo "<a href='delete_comment.php'>;
                                            <button type='button' class='btn btn-danger' onclick='return deleteComment()'>delete comment</button>
                                        </a>";
                            }
                            ?>


                        </div>
                        <div class="card-body pb-1">
                            <div class="container row mb-3 justify-content-between">
                                <?php
                                echo $comm['3'];
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                $conn = null;
            }
            ?>

        </section>
    </div>

</body>

</html>