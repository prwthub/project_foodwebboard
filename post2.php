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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
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
                                    WHERE p.post_id = $id AND p.user_id = u.user_id OR p.category_id = c.category_id");
            // ดึงข้อมูลมาใช้งาน จาก DATABASE 
            if ($data !== false) {
                while ($row = $data->fetch()) {
                    echo "post_id = " . $row['0'] . " id = $id <bR>";
                    echo "p.user_id = " . $row['9'] . "u.user_id = ".$row['10'];
            ?>
                    <!--*********************ส่วนแสดง post******************************* -->
                    <div class="card text-dark bg-white border-primary mb-3">
                        <div class="card-header alert alert-primary">
                            <strong>
                                <?php
                                echo $row['1']; //แสดงหัวข้อ menuname  
                                echo "<div tyle='text-align:left>$row[2]</div>";     //แสดงวันที่ของ date
                                ?>
                            </strong>
                        </div>
                        <div class="card-body pb-1">
                            <div class="container row mb-3 justify-content-between">
                                <?php
                                echo "ประเภท : " . $row['4'] . "<BR><BR>";  //แสดง Category
                                echo "วัตถุดิบ : " . $row['5'] . "<BR><BR>";  //แสดง ingredient
                                echo "" . $row['6'] . "<BR><BR>";  //แสดง Content
                                // echo pic [7]
                                echo "เขียนโดย : " . $row['8'] . "<BR>";  //แสดง Content
                                ?>
                            </div>
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

                    <?php
                    }
                }
            }
            ?>

            <?php
            //1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111
            //<!--*********************ส่วนแสดง comment******************************* -->
            $conn = null;
            $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");

            // ข้อมูลสำหรับแสดง Comment
            $comment = $conn->query("SELECT p.post_id, u.user_username, u.user_id, c.comment_content, c.user_id, c.comment_id, c.post_id 
                FROM post p , user u , comment c 
                WHERE p.post_id = c.post_id AND c.user_id = u.user_id AND c.post_id = $id ORDER BY c.comment_id ASC");

            if ($comment !== false) {
                while ($comm = $comment->fetch()) {
                    ?>
                    <div class="card text-dark bg-white border-info mb-3">
                        <div class="card-header bg-info text-white">
                            <?php echo "ความคิดเห็นจาก " . $comm['1']; ?>
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