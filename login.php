<?php
    session_start();
    if(isset($_SESSION["id"])){
        header("location:test_session.php"); //test_session
        //header("location:index.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
        function password_show_hide(){
            let x = document.getElementById("pwd");
            let show_eye = document.getElementById("show_eye"); //Icon
            let hide_eye = document.getElementById("hide_eye"); //Icon
            hide_eye.classList.remove("d-none");
            // check data check type better than ==
            // password -> text
            //Start-ToggleToSeePassword
            if(x.type === "password"){ 
                x.type = "text";
                show_eye.style.display="none";
                hide_eye.style.display="block";
            }
            // text -> password
            else{ 
                x.type = "password";
                show_eye.style.display="block";
                hide_eye.style.display="none";
            } 
            //Stop-ToggleToSeePassword
        }
    </script>
</head>

<body>
    <div class="container">
        <h1><center>Login</center></h1>
        <?php 
            include "nav.php"; 
            echo "<BR>";
        ?>

        
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                
                <form action="verify.php" method="POST">
                    <?php
                        // ถ้ามี session มาจะมีการแสดงผล
                        if(isset($_SESSION["error"])){
                            echo "<div class='alert alert-danger'><i class='bi bi-exclamation-circle-fill'></i>  ชื่อบัญชีหรือรหัสผ่านไม่ถูกต้อง</div>";
                            // unset ไว้ เมื่อแจ้งเตือนเสร็จแล้ว ก็ลบ ไม่งั้นมันจะคาไว้
                            unset($_SESSION["error"]);
                        }
                    ?>
                    <div class="card text-dark bg-light border-info">
                        <div class="card-header bg-info">เข้าสู่ระบบ</div>
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label class="form-label">username/email</label>
                                <input type="text" name="login_or_email" class="form-control" required>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">password</label>
                                <div class="input-group">
                                    <input type="password" name="pwd" class="form-control" id="pwd" required>
                                    <span class="input-group-text" onclick="password_show_hide();">
                                        <i class="bi bi-eye-fill" id="show_eye"></i>
                                        <i class="bi bi-eye-slash-fill d-none" id="hide_eye"></i>
                                    </span>
                                </div>
                            </div>
                            <center><button type="submit" class="btn btn-secondary btn-sm mt-3">Login</button></center>
                        </div>
                    </div>
                </form>
            
            </div>
            
            <div class="col-md-4"></div>
            
            <center><div class="mt-3">ถ้ายังไม่ได้สมัคร <a href="register.php">กรุณาสมัครสมาชิก</a></div></center>
        </div>
    </div>
</body>
</html>