<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>

    <link rel="stylesheet" href="mystyle.css">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
    <!--Icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<style>
    .card.rounder {
        padding: 15px;
        border-radius: 50px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
    }

    .card {
        padding: 20px;
        border-radius: 20px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
    }

    section {
        display: block;
    }

    .profile-circle {
        width: 100%;
        height: 100%;
        border-radius: 50%
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

    .responsiveBox {
        width: 100%;
        object-fit: cover;
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
        color: #000;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
    }

    hr.solid {
        border-top: 3px solid #bbb;
    }

    .hrVertical {
        border-left: 3px solid #bbb;
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


<body style="background-color:#6B8E23">
    <?php
    include "nav.php";
    echo "<BR>";
    $user_id = $_GET['profile_id'];

    $server_name = "localhost";
    $username = "root";
    $password = "";
    $database = "webboard_recipes";

    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");
    $sql = $conn->query("SELECT user_name, user_email, user_fname, 
                                user_lname, user_phone, user_exp, user_des, 
                                user_country, user_state 
                                FROM user WHERE user_id = $user_id");
    if ($sql !== false) {
        while ($row = $sql->fetch()) {
            $uname = $row[0];
            $email = $row[1];
            $fname = $row[2];
            $lname = $row[3];
            $phone = $row[4];
            $exp = $row[5];
            $des = $row[6];
            $country = $row[7];
            $state = $row[8];
        }
    }
    ?>

    <div class="container rounded bg-white mb-1">
        <div></div>
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-1">
                    <?php
                    // Include the database configuration file  
                    require_once 'dbConfig_SQLi.php';
                    // Get image data from database 
                    $result = $db->query("SELECT image FROM images_user WHERE user_id = $user_id");
                    ?>

                    <?php
                    //******************************** เรียกรูปจาก database *********************************************** */ 
                    if ($result->num_rows > 0) { ?>
                        <div class="gallery">
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <img class="profile-circle mt-5" width="150px"
                                    src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>"><BR>
                                <span class="font-weight-bold">
                                    <?php echo $uname ?>
                                </span><BR>
                                <span class="text-black-50">
                                    <?php echo $email ?>
                                </span>
                                <span> </span>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <img class="profile-circle mt-5" width="150px"
                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                        <span class="font-weight-bold">
                            <h3><?php echo $uname ?></h3>
                        </span>
                        <span class="text-black-50">
                            <?php echo $email ?>
                        </span>
                        <span> </span>
                    <?php } ?>
                </div>
            </div>

            <div class="col-md-7 border-right">
                <div class="py-3 container-fluid rounded">
                    <h1 class="bold text-secondary centerBlock center d-flex justify-content-center pt-3">Profile
                        Information</h1>
                </div>

                <BR>

                <div class="row hrVertical">
                    <div class="col-md-6"><span class="lighter text-secondary mt-3 ">Name </span><BR>
                        <h4>
                            <?php echo $fname ?>
                        </h4>
                    </div>
                    <div class="col-md-6 "><span class="lighter text-secondary mt-3 ">Surname</span><BR>
                        <h4>
                            <?php echo $lname ?>
                            <h4>
                    </div>
                </div>

                <div class="row hrVertical">
                    <div class="col-sm-6 ">
                        <span class="lighter text-secondary mt-3">Mobile Number</span><BR>
                        <h4>
                            <?php echo $phone ?>
                        </h4>
                    </div>
                </div>

                <div class="row hrVertical">
                    <div class="col-xs-6 col-sm-12 ">
                        <span class="h4 bold text-secondary mt-3 d-flex justify-content-start">
                            Reward / Experience </span>
                        <div class="card lighter text-dark mt-3 rounded responsiveBox">
                            <?php echo $exp ?>
                        </div>
                    </div>
                </div>

                <div class="row hrVertical">
                    <div class="col-xs-6 col-sm-12">
                        <span class="h4 bold text-secondary mt-3 d-flex justify-content-start">
                            Description</span>
                        <div class="card lighter text-dark mt-3 rounded responsiveBox">
                            <?php echo $des ?>
                        </div>
                    </div>
                </div>

                <BR>

                <div class="row hrVertical">
                    <div class="col-xs-6 col-sm-6"><span class="lighter text-secondary mt-3 ">Country<BR>
                        </span>
                        <h4>
                            <?php
                            if ($country > 0) {
                                echo $country;
                            } else {
                                echo "Not assigned";
                            } ?>

                        </h4>
                    </div>

                    <div class="col-xs-6 col-sm-6"><span class="lighter text-secondary mt-3 ">State/Region<BR>
                        </span>
                        <h4>
                            <?php
                            if ($state > 0) {
                                echo $state;
                            } else {
                                echo "Not assigned";
                            } ?>
                        </h4>
                    </div>

                </div>
            </div>
        </div>

        <h1 class="bold text-secondary centerBlock center d-flex justify-content-center pt-5">User's Menu</h1>
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
          FROM post p, user u WHERE $user_id = u.user_id AND p.user_id = u.user_id ORDER BY p.post_id DESC;");
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
                                    <img src="" class='card-img-top food-circle responsiveImage' />
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
    </div>

    </div>



</body>

</html>