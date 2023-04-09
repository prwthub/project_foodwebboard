<?php
session_start();
$user_id = $_SESSION['user_id'];
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
    <!-- Import Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@200;400;600;900&display=swap"
        rel="stylesheet">
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

    .responsiveImage {
        width: 80%;
        height: 40vw;
        object-fit: cover;

    }

    .border {
        box-shadow: 0 0px 15px rgba(0, 0, 0, .6);
    }
</style>

    <body style="background-color:#D3D3D3">
    <?php
    include "nav.php";
    echo "<BR>";

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

<div class="container-sm bg-white rounded pt-3" style="margin-top:20px" ;> <!-- Main container -->
        <div class="row">
            <div class="col-md-6 ">
                <div class="d-flex flex-column align-items-center text-center p-3">
                    <div class = "card">
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
                                <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && $user_id == $_SESSION['user_id']) { ?>
                                    <form action="deleteimagesUser.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $user_id; ?>">
                                        <input type="submit" name="photo" value="deleted photo">
                                    </form>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } else if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && $user_id == $_SESSION['user_id']) { ?>
                            <img class="profile-circle mt-5"
                                src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                            <span class="font-weight-bold profile-circle">
                            <?php echo $uname ?>
                            </span>
                            <span class="text-black-50">
                            <?php echo $email ?>
                            </span>
                            <span> </span>
                            <h3>เพิ่มรูป</h3>
                            <form action="profile_uploadImages.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $user_id; ?>">
                                <input type="file" name="image">
                                <button type="submit" name="submit" class = "btn btn-info" value="Upload">
                                    UPLOAD
                    </button>
                            </form>
                    <?php } ?>
                </div>
                    </div>
            </div>
            <div class="col-md-7 border-right">
                <div class="p-1 py-1">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="text-right bold">Profile</h2>
                    </div>

                    <div class="row mt-1">
                        <div class="col-md-6"><label class="labels mb-1">Name :
                                <?php echo $fname ?>
                            </label></div>
                        <div class="col-md-6"><label class="labels mb-1">Lastname :
                                <?php echo $lname ?>
                            </label></div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels mb-1">Mobile Number :
                                <?php echo $phone ?>
                            </label></div>
                        <div class="col-md-12"><label class="labels mb-1">Reward / Experience :
                                <?php echo $exp ?>
                            </label></div>
                        <div class="col-md-12"><label class="labels mb-1">Description :
                                <?php echo $des ?>
                            </label></div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels mb-1">Country :
                                <?php echo $country ?>
                            </label></div>
                        <div class="col-md-6"><label class="labels mb-1">State/Region :
                                <?php echo $state ?>
                            </label></div>
                    </div>

                    <div class="mt-4 text-center">
                        <form action="profile_edit.php" method="post">
                            <button class="btn btn-primary profile-button" type="submit">Edit</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>