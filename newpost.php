<?php
session_start();
// ต้อง login ก่อนถึงเขียน post ได้
if (!isset($_SESSION["id"])) {
    $_SESSION["add_post"] = 'error';
    header("location: index.php");
}
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
    <script src="js/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Newpost</title>

    <!-- สำหรับเพิ่ม tag -->
    <script type="text/javascript">
        $(document).ready(function() {
            var maxField = 3; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div><input type="text" name="tag[]" value=""required/><a href="javascript:void(0);" class="remove_button">  <i class="bi bi-trash3-fill"></i></a></div>'; //New input field html 
            var x = 0; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function() {
                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

    <!-- สำหรับเพิ่ม ingredient -->
    <script type="text/javascript">
        $(document).ready(function() {
            var maxField = 100; //Input fields increment limitation
            var addButton = $('.add_button1'); //Add button selector
            var wrapper = $('.field_wrapper1'); //Input field wrapper
            var fieldHTML = '<div><input type="text" name="ingredient[]" value=""required/><a href="javascript:void(0);" class="remove_button">  <i class="bi bi-trash3-fill"></i></a></div>'; //New input field html 
            var x = 0; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function() {
                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

</head>
<style>
    .responsiveImage {
        width: 100%;
        height: 35vw;
        object-fit: cover;

    }

    .responsiveImagelogo {
        width: 140pt;
        height: 80%;
        object-fit: cover;

    }
</style>

<body>
    <?php include "nav.php"; ?>
    <section class="" style="background-color: #DEB887; ">
        <div class="container">
            <section class="col-md-8 mx-auto">
                <br>
                <div class="card text-dark bg-white border-dark ">
                    <div class="p-0 pt-2 card-header bg-danger text-white" style="width: 100%;">
                        <center>
                            <h4>Create your menu</h4>
                        </center>
                    </div>
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src='food/newpost.jpg' alt='login form' class='img-fluid responsiveImage' style='border-radius: 1rem 0 0 1rem; height: 100%' />
                        </div>
                        <div class="card-body col-md-6 col-lg-7 d-none d-md-block">
                            <!-- ส่งข้อมูลไปยัง newpost_save -->
                            <form action="newpost_save.php" method="post">
                                <!-- ประเภทอาหาร -->
                                <div class="row mb-2">
                                    <label class="col-lg-6 col-form-lable">category :</label>
                                    <div class="col-lg-12">
                                        <select id="type" name="type" style='width:100%'>
                                            <?php
                                            session_start();
                                            require 'dbConfig_PDO.php';

                                            $data = $conn->query("SELECT category_id , category_tag 
                                                            FROM category ORDER BY category_id ;");
                                            if ($data !== false) {
                                                while ($row = $data->fetch()) {
                                                    $category_id = $row['0'];
                                                    $category_tag = $row['1'];

                                                    echo "<option value='$category_id'>$category_id $category_tag</option>";
                                                }
                                                $conn = null;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- เพิ่ม Tag -->
                                <div class="row mb-2">
                                    <label class="col-lg-6 col-form-lable">tag :</label>
                                    <div class="field_wrapper col-lg-12">

                                        <input type="text" name="tag[]" value="" required>
                                        <a href="javascript:void(0);" class="add_button" title="Add field"><i class="bi bi-plus-square"></i></a>

                                    </div>
                                </div>
                                <!-- เพิ่มเมนู -->
                                <div class="row mb-2">
                                    <label class="col-lg-6 col-form-lable">menu name :</label>
                                    <div class="col-lg-12">
                                        <input type="text" name="menuname" class="form-control" require>
                                    </div>
                                </div>
                                <!-- เพิ่มวัตถุดิบ -->
                                <div class="row mb-2">
                                    <label class="col-lg-6 col-form-lable">ingredient :</label>
                                    <div class="field_wrapper1 col-lg-12">

                                        <input type="text" name="ingredient[]" value="" required>
                                        <a href="javascript:void(0);" class="add_button1" title="Add field"><i class="bi bi-plus-square"></i></a>

                                    </div>
                                </div>
                                <!-- เพิ่มเนื้อหา -->
                                <div class="row mb-2">
                                    <label class="col-lg-6 col-form-lable">step :</label>
                                    <div class="col-lg-12">
                                        <textarea name="content" class="form-control" rows="8" require></textarea>
                                    </div>
                                </div>
                                <!-- เพิ่มรูปภาพ 
                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-lable">รูปภาพ :</label>
                                <div class="col-lg-9">
                                    <input type="file" name="file" class="form-control streched-link"
                                        accept="image/gif, image/jpeg, image/png">
                                    <p class="small mb-0 mt2"><b>Note</b> Olay JPG, JPEG, PMG & GIF files are allowed to
                                        upload </p>
                                </div> 
                            </div>
                            -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <center>
                                            <button type="submit" name="submit" class="btn btn-info btn-sm text-white bg-danger border-dark">
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
        <br><br><br><br><br><br>
    </section>
</body>

</html>