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
    
    <title>Register Page</title>

    <!-- ปุ่มโชว์ password -->
    <script >
        function password_show_hide(){
            let x = document.getElementById("password");
            let show_eye = document.getElementById("show_eye");
            let hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if(x.type ==="password"){
                x.type="text";
                show_eye.style.display="none";
                hide_eye.style.display="block";
            }else{
                x.type="password";
                show_eye.style.display="block";
                hide_eye.style.display="none";
            }
        }
    </script>
</head>
<body>
    <?php
        if(isset($_SESSION["id"])){
            header("Location: index.php");
        }
    ?>

    <div class="container">
        <h1 style="text-align:center">Register</h1>
        <?php
            include "nav.php";
            echo "<BR>"
        ?><!-- เรียก navbar จากที่อื่นมาใช้ ง่ายต่อการเรียนใช้ในหลายๆไฟล์ --> 

        <form action="register_save.php" method="post" >
            
            <!--------------------------------------------------------------------------------------------->
            <!-- session ที่เอาไว้เตือนว่า register สำเร็จหรือไม่สำเร็จ -->
            <?php
                if(isset($_SESSION["add_login"])){
            ?>
            <div class="row mt-3">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <?php   
                        // register error
                        if($_SESSION["add_login"] == 'error'){
                                echo "<div class=\"alert alert-danger bi bi-x-circle\" role=\"alert\">";
                                echo "  ชื่อบัญชีซ้ำหรืออีเมลล์ถูกใช้ไปแล้ว";
                                echo "</div>";
                                unset($_SESSION["add_login"]);
                        }
                        // register success
                        else if($_SESSION["add_login"] == 'success'){   
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
            <!--------------------------------------------------------------------------------------------->
            <div class="row">
                <div class="col-md-3"> </div>
                
                <div class="col-md-6">
                    <div class="card text-dark bg-white border-primary" >
                        <div class="card-header bg-primary text-white ">กรอกข้อมูล</div>
                        <div class="card-body">
                            <div class="row mb-3 ">
                                <label class="col-md-3 col-form-label">username :</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="login" required>
                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <label class="col-md-3 col-form-label">password :</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="password" class="form-control"  name="pwd" required id="password">
                                        <span class="input-group-text " onclick="password_show_hide();">
                                            <i class="bi bi-eye-fill" id="show_eye"></i>
                                            <i class="bi bi-eye-slash-fill d-none" id="hide_eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-form-label">account name :</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control"  name="name" require>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-form-label">email :</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control"  name="email" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-9">
                                    <button type="submit"  class="btn btn-primary btn-sm bi bi-save"> สมัครสมาชิก </button>
                                </div>
                            </div>    
                        </div>    
                        </div>
                    </div>
                </div>

                <div class="col-md-3"> </div>
            </div>
        </form>
            
    </div>
</body>
</html>