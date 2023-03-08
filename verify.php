<?php
    session_start();

    // ถ้ามีการ login เข้ามาแล้ว จะไม่สามารถเข้าหน้า verify ได้ และให้กลับไปหน้า login 
    if(isset($_SESSION["username"]) && $_SESSION["id"]==session_id()){
        header("Location: test.php");
        //header("Location: index.php");
        die();
    }

    // ถ้ามีการรับ login_or_email เข้ามา ให้ login เท่ากับ login_or_email
    isset($_POST['login_or_email']) ? $login = $_POST['login_or_email'] : $login = "";
    // ถ้ามีการรับ pwd เข้ามา ให้ passwd เท่ากับ pwd
    isset($_POST['pwd']) ? $passwd = $_POST['pwd'] : $passwd = "";


    $server_name = "localhost";
    $username = "root";
    $password = "";
    $database = "webboard_recipes";

    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8","$username","$password");
    // ตรวจว่า username และ password ถูกต้อง
    
    $sql = "SELECT * FROM user WHERE (user_username='$login' OR user_email='$login') AND user_password = sha1('$passwd')";
    
    $result = $conn->query($sql);

    if($result->rowCount()==1){
    // ข้อมูลถูกต้อง
        $data=$result->fetch(PDO::FETCH_ASSOC);
        $_SESSION["id"] = session_id();
        
        $_SESSION["user_id"] = $data["user_id"];
        $_SESSION["username"] = $data["user_name"];
        $_SESSION["role"] = $data["user_role"];

    }else{
    // ข้อมูลไม่ถูกต้อง

        // ต้องทำ error แจ้งเตือนออกมา เลยสร้าง session["error"]
        $_SESSION["error"] = 1;

    }
    header("Location: login.php");       
    die();
    $conn=null;

?>
    




