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

<body>
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
                                <img class="rounded-circle mt-5" width="150px"
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
                            <img class="rounded-circle mt-5" width="150px"
                                src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                            <span class="font-weight-bold">
                            <?php echo $uname ?>
                            </span>
                            <span class="text-black-50">
                            <?php echo $email ?>
                            </span>
                            <span> </span>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-7 border-right">
                <div class="p-1 py-1">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="text-right">Profile</h2>
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
                        <div class="col-md-12"><lasbel class="labels mb-1">Description :
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
                </div>
            </div>
        </div>
    </div>
</body>

</html>