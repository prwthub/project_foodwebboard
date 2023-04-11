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
    <!-- Import Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@200;400;600;900&display=swap"
        rel="stylesheet">
    <title>
        <?php
        require 'dbConfig_PDO.php';

        //isset($_GET['id']) ? $id = $_GET['id'] : header("Location: index.php");
        $id = $_GET['id'];

        $data = $conn->query("SELECT p.post_title,u.user_name,p.user_id,u.user_id FROM post p , user u WHERE p.post_id = $id and p.user_id = u.user_id;");
        if ($data !== false) {
            while ($row = $data->fetch()) {
                $post_title = $row['0'];
                $user_name = $row['1'];
                $user_id = $row['2'];
                $user_id = $row['3'];

                echo "$post_title โดย $user_name";
            }
        }
        $conn = null;
        ?>

    </title>
</head>
<style>
    .card.rounder {
        padding: 15px;
        border-radius: 50px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
    }

    .card {
        padding: 10px;
        border-radius: 20px;
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
        width: 80%;
        height: 40vw;
        object-fit: cover;

    }

    .textArrange {
    overflow-wrap: break-word;
    }

    .border {
        box-shadow: 0 0px 15px rgba(0, 0, 0, .6);
    }

    .label {
        display: inline-block;
        padding: 0.5em 2em 0.5em;
        font-size: 100%;
        font-weight: normal;
        line-height: 3;
        color: #ffffff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        overflow-wrap: break-word;
        padding: 6px;


    }
</style>
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

<body style="background-color:#6B8E23">
    <?php
    include "nav.php";
    ?>

    <?php
    isset($_GET['id']) ? $id = $_GET['id'] : header("Location: index.php");
    //echo "<center>ต้องการดูกระทู้หมายเลข $id <br>";
    //View Count
    require 'dbConfig_PDO.php';
    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");
    $sql = $conn->query("SELECT * FROM post WHERE post_id = $id");
    if ($sql != false) {
        while ($row = $sql->fetch()) {
            $view = $row['post_view'];
        }
        $view++;
    }
    $conn = null;
    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");
    $update = ("UPDATE post SET post_view = $view WHERE post_id = $id");
    $conn->exec($update);
    // ******************connect database****************************
    $conn = null;
    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");

    $sql = "SELECT * FROM post p , user u , category c 
                    WHERE p.post_id = $id AND p.user_id = u.user_id OR p.category_id = c.category_id";
    $query = $conn->query($sql);
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // ดึงข้อมูลมาใช้งานแสดงPost
    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");
    $data = $conn->query("SELECT p.post_id, p.post_title, p.post_date, p.category_id, p.post_ingredient, p.post_content, u.user_username, p.user_id, u.user_id, c.category_tag, c.category_id,
                                        p.post_like, p.post_dislike, p.post_view 
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
    <div class="container col-xs-6 bg-white rounded pt-3" style="margin-top:20px" ;>
        <!-- Main container -->

        <section>
            <div class='container-fluid card' style='margin-top:20px'>
                <div class="row">
                    <?php
                    echo "<div class = 'col-xs-6 col-sm-12 text-end p-3'>";
                    echo "<h1 class = 'bold'> $post_title </h1>";
                    echo "<p><div class='d-flex col-xs-6 col-sm-12 justify-content-sm-end lighter'>";
                    echo "<i class='bi bi-eye'></i>&nbsp" . $post_view . "<i class='bi bi-hand-thumbs-up'></i>&nbsp" . $post_like . "<i class='bi bi-hand-thumbs-down'></i>&nbsp"
                        . $post_dislike . " | Date posted " . $post_date . "</p></div>"; //Post_view, Like, Dislike,Post_date
                    echo "</div>"; //Post_title
                    

                    ?>
                    <?php
                    // Include the database configuration file  
                    require_once 'dbConfig_SQLi.php';

                    // Get image data from database 
                    $result = $db->query("SELECT image FROM images_post WHERE post_id = $id");
                    ?>
                    <?php
                    //******************************** เรียกรูปจาก database *********************************************** */ 
                    if ($result->num_rows > 0) { ?>
                        <div class="col-xs-6 col-sm-6 text-center center">
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>"
                                    width='500' height='500' class="responsiveImage border" />
                                <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && $user_id == $_SESSION['user_id']) { ?>
                                    <form action="deleteimages.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $id; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm text-white mt-3" name="rmPhoto">
                                            <i class="bi bi-x-square"></i>
                                            Remove Photo
                                        </button>
                                    </form>
                                <?php } ?>
                            <?php } ?>

                        </div>
                    <?php } else if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && $user_id == $_SESSION['user_id']) { ?>
                        <div class="col-xs-6 col-sm-6 text-center center">
                        <img src="https://play-lh.googleusercontent.com/3jQbTB6TR95ZSUuunhZF-1Uk-fAkGpem2Nh19plzaHq4aYaxYoLgr6BH5jZ-mu9ls7w=w526-h296-rw"
                                width='500' height='500' class="responsiveImage border" />
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                <label>Select Image File:</label>
                                <input type="hidden" name="id" value="<?= $id; ?>">
                                <input type="file" name="image">
                                <input type="submit" name="submit" value="Upload">
                            </form>
                            </div>
                    <?php } else { ?>
                        <div class="col-xs-6 col-sm-6 text-center center">
                            <img src="https://play-lh.googleusercontent.com/3jQbTB6TR95ZSUuunhZF-1Uk-fAkGpem2Nh19plzaHq4aYaxYoLgr6BH5jZ-mu9ls7w=w526-h296-rw"
                                width='500' height='500' class="responsiveImage border" />
                        </div>
                <?php } ?>
                <?php
                // แสดงข้อมูล
                
                echo "<div class = 'col-xs-6 col-sm-6'>";
                echo "<span class = 'regular text-secondary mt-3 '>" . " ประเภท : </span>
                              <span class = 'h4'>" . $category_tag . "</span><BR>";

                require_once 'dbConfig_SQLi.php';
                $tag_count = 0;
                $sql_tag = "SELECT post_tag FROM post WHERE post_id = $id";
                $result = $db->query($sql_tag);
                if ($result->num_rows > 0) {
                    echo "<span class = 'regular text-secondary mt-3'>แท็ก : </span>";
                    while ($row = $result->fetch_assoc()) {
                        $data = json_decode($row['post_tag']);
                        while (true) {
                            if (!empty($data[$tag_count])) {
                                echo "<span class='label bg-success rounded'>$data[$tag_count]</span>";
                                echo " ";
                            } else {
                                break;
                            }
                            $tag_count++;
                        }
                    }
                    echo "<BR>";
                }

                $ingredient_count = 0;
                $sql_ingredient = "SELECT post_ingredient FROM post WHERE post_id = $id";
                $result = $db->query($sql_ingredient);
                if ($result->num_rows > 0) {
                    echo "<span class = 'regular text-secondary'>วัตถุดิบ </span>";
                    while ($row = $result->fetch_assoc()) {
                        $data = json_decode($row['post_ingredient']);
                        while (true) {
                            if (!empty($data[$ingredient_count])) {
                                echo "<BR>";
                                echo "<span class='label bg-warning text-dark rounded d-inline-block text-truncate' style='width: 100%;'>$data[$ingredient_count]</span>";

                                //echo " '" . $data[$ingredient_count] . "' ";
                            } else {
                                break;
                            }
                            $ingredient_count++;
                        }
                    }
                    echo "<BR><BR>";
                }
                $db = null;
                echo "<span class = 'regular text-secondary mt-3'>วิธีทำ <BR> </span>";
                echo "$post_content <BR><BR>";
                echo "<span class = 'h5 bold d-inline-block d-flex justify-content-center'>เขียนโดย</span>";
                ?>
                <div class="row ">
                    <div class="col-sm-12 center text-center">
                        <form action="profile_view.php" method="get">
                            <input type="hidden" name="profile_id" value="<?= $user_id; ?>">

                            <?php echo $user_name ?> &nbsp;
                            <button type="submit" class="btn btn-secondary btn-sm text-white ">
                                <i class="bi bi-person-circle"></i>
                                ดูโปรไฟล์
                            </button>
                    </div>
                </div>
                </form>

                <?php
                // เรียกข้อมูลเช็ค Rating
                $conn = null;
                $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");
                if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
                    $session_user_id = $_SESSION['user_id'];
                    $rating_info = $conn->query("SELECT * FROM rating_post WHERE user_id = $session_user_id AND post_id = $post_id");
                } else {
                    $rating_info = $conn->query("SELECT * FROM rating_post WHERE post_id = $post_id");
                }
                $rating_uid = 0;
                $rating_status = 0;
                if ($rating_info != false) {
                    while ($rating = $rating_info->fetch()) {
                        //echo 'POST_FETCH = '.$rating['post_id'].'<BR>';
                        //echo 'UID_FETCH = '.$rating['user_id'].'<BR>';
                        //echo 'RATING_FETCH = '.$rating['rating'].'<BR>';
                        $rating_uid = $rating['user_id'];
                        $rating_status = $rating['rating'];
                    }
                }
                //echo 'CURRENT_STATUS_FETCH = '.$rating_status.'<BR>';
                //echo 'CURRENT_UID_FETCH = '.$rating_uid.'<BR>';
                //echo 'SESSION_UID = '.$_SESSION['user_id'].'<BR>';
                //echo 'CURRENT_POST_ID = '.$post_id .'<BR>';
                echo "<div class = 'd-flex justify-content-center pt-3'>";
                if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) { ?>
                    <form action="rating_post.php" name="" method="post">
                        <input type="hidden" name="post_id" value="<?= $id; ?>">
                        <?php if (($_SESSION['user_id'] == $rating_uid || $rating_uid == '0') && $rating_status != '1') { ?>
                            <button type="submit" name="rating" class="btn btn-secondary" value="1">LIKE
                                <?php echo $post_like ?>
                            </button>
                        <?php } else { ?>
                            <button type="submit" name="rating" class="btn btn-success" value="2">UNLIKE
                                <?php echo $post_like ?>
                            </button>
                        <?php } ?>
                        &nbsp;&nbsp;&nbsp;
                        <?php if (($_SESSION['user_id'] == $rating_uid || $rating_uid == '0') && $rating_status != '-1') { ?>
                            <button type="submit" name="rating" class="btn btn-secondary" value="-1">DISLIKE
                                <?php echo $post_dislike ?>
                            </button>
                        <?php } else { ?>
                            <button type="submit" name="rating" class="btn btn-danger" value="-2">UNDISLIKE
                                <?php echo $post_dislike ?>
                            </button>
                        <?php } ?>
                    </form>
                <?php } else {
                    //แสดงอย่างเดียว Action ไม่ได้ ?>
                    <form action="" name="" method="post">
                        <button type="submit" name="rating" class="btn btn-secondary" value="">LIKE
                            <?php echo $post_like ?>
                        </button>
                        &nbsp;&nbsp;&nbsp;
                        <button type="submit" name="rating" class="btn btn-secondary" value="">DISLIKE
                            <?php echo $post_like ?>
                        </button>
                    <?php } ?>
                </form>
                </div>
            </div>

    </div>
    </section>
    </div>

    <hr class = "solid ">
    <!-- ตัวเลือกการเรียงลำดับการแสดง Comment -->
    <div class="d-flex">
        <div class="input-group">
            <label class = "regular whiter">&nbsp;&nbsp;&nbsp;เรียงคอมเมนต์โดย &nbsp;</label>
            <form name="" method="post">
                <button type="submit" name="sort" class="btn btn-secondary" value="1">เก่า-ใหม่</button>
                <button type="submit" name="sort" class="btn btn-secondary" value="0">ใหม่-เก่า</button>
            </form>
        </div>
    </div>
    <!--*********************ส่วนแสดง comment (input)******************************* -->
    <?php
    // ต้อง login ก่อนถึงคอมเม้นได้
    if (isset($_SESSION["id"])) {
        ?>
        <div class="card text-dark bg-white border-success mt-3">
            <div class="card-header bg-success whiter">แสดงความคิดเห็น</div>
            <div class="card-body">
                <!-- ส่งข้อมูล comment ไปยัง post_save -->
                <form action="post_save.php" method="post">
                    <input type="hidden" name="post_id" value="<?= $id; ?>">
                    <div class="row mb-3 justify-content-center">
                        <div class="col-lg-10">
                            <textarea name="comment" class="form-control" rows="8" required></textarea>
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
            $post_id = $comm['0'];
            $user_name = $comm['1'];
            $user_id = $comm['2'];
            $comment_content = $comm['3'];
            $user_id = $comm['4'];
            $comment_id = $comm['5'];
            $post_id = $comm['6'];
            ?>
            <div class="card text-dark bg-white border-info mb-3">
                <div class="card-header bg-info text-white" style ="background-color: #827a73 !important;">

                    <?php echo "ความคิดเห็นจาก " . $user_name;
                    // คนเขียนสามารถลบ comment 
                    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && $_SESSION["user_id"] == $user_id) {
                        $_SESSION["comment_id"] = $comment_id;
                        $_SESSION["post_id"] = $post_id;
                        //echo "comment_id = " . $_SESSION['comment_id'];
                        //echo "post_id = " . $_SESSION['post_id'];
            
                        echo '<form method = "GET" action="delete_comment.php">';
                        echo "<a href=\"delete_comment.php?id=$_SESSION[comment_id]\" onclick='return deleteComment()'>
                                                <button type='button' class='btn btn-danger'>Delete Comment</button>
                                            </a>";
                        echo '</form>';
                    }
                    ?>

                </div>
                <div class="card-body pb-1">
                    <div class="container row mb-3 justify-content-between">
                        <?php
                        echo $comment_content;
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        $conn = null;
        $db = null;
    }
    ?>

    </div>
</body>

</html>