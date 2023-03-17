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

    <title>Newpost</title>
</head>

<body>
    <?php include "nav.php"; ?>
    <div class="container">

        <?php
        // ต้อง login ก่อนถึงเขียน post ได้
        if (!isset($_SESSION["id"])) {
            $_SESSION["add_post"] = 'error';
            header("Location: index.php");
        }
        ?>

        <section class="col-md-5 mx-auto m-3">
            <div class="card text-dark bg-white border-info">
                <div class="card-header bg-info text-ehite">
                    เพิ่มรายการอาหาร
                </div>
                <div class="card-body">
                    <!-- ส่งข้อมูลไปยัง newpost_save -->
                    <form action="newpost_save.php" method="post">
                        <!-- ประเภทอาหาร -->
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-lable">ประเภท :</label>
                            <div class="col-lg-9">
                                <select id="type" name="type" style='width:100%'>
                                    <?php
                                    session_start();
                                    $server_name = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $database = "webboard_recipes";

                                    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8", "$username", "$password");
                                    $data = $conn->query("SELECT category_id , category_tag 
                                                        FROM category ORDER BY category_id ;");
                                    if ($data !== false) {
                                        while ($row = $data->fetch()) {
                                            echo "<option value='$row[0]'>$row[0] $row[1]</option>";
                                        }
                                        $conn = null;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- เพิ่มเมนู -->
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-lable">เมนุ :</label>
                            <div class="col-lg-9">
                                <input type="text" name="menuname" class="form-control" require>
                            </div>
                        </div>
                        <!-- เพิ่มวัตถุดิบ -->
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-lable">วัตถุดิบ :</label>
                            <div class="col-lg-9">
                                <textarea name="ingre" class="form-control" rows="8" require></textarea>
                            </div>
                        </div>
                        <!-- เพิ่มเนื้อหา -->
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-lable">เนื้อหา ขั้นตอน :</label>
                            <div class="col-lg-9">
                                <textarea name="content" class="form-control" rows="8" require></textarea>
                            </div>
                        </div>
                        <!-- เพิ่มรูปภาพ -->
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-lable">รูปภาพ :</label>
                            <div class="col-lg-9">
                                <input type="file" name="picture" id="img" class="form-control streches-link" accept="image/gif,image/jpeg,image/png">
                                <!-- error style="display" เลยลบ  -->
                                <p class="small mb-0 mt2"><b>Note</b> Olay JPG, JPEG, PMG & GIF files are allowed to
                                    upload
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <center>
                                    <button type="submit" class="btn btn-info btn-sm text-white">
                                        <i class="bi bi-caret-right-square me-1"></i>
                                        บันทึกเมนู
                                    </button>
                                </center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    </section>
    </div>
</body>

</html>