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

    <title>Register Page</title>

    <!-- ปุ่มโชว์ password -->
    <script>
        function password_show_hide() {
            let x = document.getElementById("password");
            let show_eye = document.getElementById("show_eye");
            let hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>
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
</head>

<body>
    <?php
    if (isset($_SESSION["id"])) {
        header("Location: index.php");
    }
    ?>
    <?php
    include "nav.php";
    ?><!-- เรียก navbar จากที่อื่นมาใช้ ง่ายต่อการเรียนใช้ในหลายๆไฟล์ -->

    <section class="vh-100 pb-1" style="background-color: #9A616D; ">
        <br>
        <?php
        if (isset($_SESSION["add_login"])) {
            ?>
            <div class="row mt-3">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <?php
                    // register error
                    if ($_SESSION["add_login"] == 'error') {
                        echo "<div class=\"alert alert-danger bi bi-x-circle\" role=\"alert\">";
                        echo "  ชื่อบัญชีซ้ำหรืออีเมลล์ถูกใช้ไปแล้ว";
                        echo "</div>";
                        unset($_SESSION["add_login"]);
                    }
                    // register success
                    else if ($_SESSION["add_login"] == 'success') {
                        echo "<div class=\"alert alert-success bi bi-check-circle\" role=\"alert\">";
                        echo "  เพิ่มบัญชีเรียบร้อยแล้ว";
                        echo "</div>";
                        unset($_SESSION["add_login"]);
                    }
                    ?>
                </div>
                <div class="col-md-3"></div>
            </div>
            <?php
        }
        ?>
        <?php
        // ถ้ามี session มาจะมีการแสดงผล
        if (isset($_SESSION["error"])) {
            echo "<div class='alert alert-danger'><i class='bi bi-exclamation-circle-fill'></i>  ชื่อบัญชีหรือรหัสผ่านไม่ถูกต้อง</div>";
            // unset ไว้ เมื่อแจ้งเตือนเสร็จแล้ว ก็ลบ ไม่งั้นมันจะคาไว้
            unset($_SESSION["error"]);
        }
        ?>


        <div class="container py-1 h-90">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <?php
                            $min = 1;
                            $max = 3;
                            $randomNumber = rand($min, $max);
                            //echo $randomNumber;
                            ?>

                            <div class="col-md-6 col-lg-7 d-flex align-items-center">

                                <div class="card-body p-1 p-lg-4 text-black">

                                    <form action="register_save.php" method="post">

                                        <div class="d-flex justify-content-center align-items-center mb-1 pb-1">
                                            <i class="fas fa-cubes fa-2x me-1" style="color: #ff6219;"></i>
                                            <img src="food/logo.png" alt="login form"
                                                class="img-fluid responsiveImagelogo"
                                                style="border-radius: 1rem 0 0 1rem;" />
                                        </div>



                                        <div class="form-outline mb-3">
                                            <h6 class="fw-normal mb-2 pb-1"
                                                style="letter-spacing: 1px; color: #393f81;">Register</h6>
                                            <input type="text" name="login" class="form-control"
                                                class="form-control form-control-lg" required
                                                placeholder='username or email'>
                                        </div>

                                        <div class="input-group form-outline mb-3">
                                            <input type="password" name="pwd" class="form-control" id="pwd"
                                                class="form-control form-control-lg" required placeholder='password'>
                                            <span class="input-group-text" onclick="password_show_hide();">
                                                <i class="bi bi-eye-fill" id="show_eye"></i>
                                                <i class="bi bi-eye-slash-fill d-none" id="hide_eye"></i>
                                            </span>

                                        </div>

                                        <div class="form-outline mb-3">
                                            <input type="text" name="name" class="form-control"
                                                class="form-control form-control-lg" required
                                                placeholder='username account'>
                                        </div>

                                        <div class="form-outline mb-3">
                                            <input type="text" name="email" class="form-control"
                                                class="form-control form-control-lg" required placeholder='email'>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block"
                                                type="submit">Register</button>
                                        </div>

                                        <a href="#!" class="small text-muted">Terms of use.</a>
                                        <a href="#!" class="small text-muted">Privacy policy</a>
                                    </form>

                                </div>
                            </div>
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <?php
                                echo "<img src='food/$randomNumber.png' alt='login form' class='img-fluid responsiveImage' style='border-radius: 0 1rem 1rem 0;' />"
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

</html>