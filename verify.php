<?php
    session_start();

    // ถ้ามีการ login เข้ามาแล้ว จะไม่สามารถเข้าหน้า verify ได้ และให้กลับไปหน้า login 
    if(isset($_SESSION["username"]) && $_SESSION["id"]==session_id()){
        header("Location: login.php");
        die();
    }

    // ถ้ามีการรับ username เข้ามา ให้ username เท่ากับ $_POST['username']
    isset($_POST['username']) ? $u = $_POST['username'] : $u = "";
    // ถ้ามีการรับ password เข้ามา ให้ password เท่ากับ $_POST['password']
    isset($_POST['password']) ? $p = $_POST['password'] : $p = "";


    $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
    // ตรวจว่า username และ password ถูกต้อง
    $sql = "SELECT * FROM user where login='$u' and password = sha1('$p') ";
    $result = $conn->query($sql);

    if($result->rowCount()==1){
    // ข้อมูลถูกต้อง
        $data=$result->fetch(PDO::FETCH_ASSOC);
        $_SESSION["username"] = $data["login"];
        $_SESSION["role"] = $data["role"];
        $_SESSION["เผื่อ1"] = $data["เผื่อ1"];
        $_SESSION["เผื่อ2"] = $data["เผื่อ2"];
        $_SESSION["เผื่อ3"] = $data["เผื่อ3"];
        // ยังไม่แน่ใจ ความแตกต่าง
        //$_SESSION["user_id"] = $data["id"];
        //$_SESSION["id"] = session_id();
        
    }else{
    // ข้อมูลไม่ถูกต้อง

        // ต้องทำ error แจ้งเตือนออกมา เลยสร้าง session["error"]
        $_SESSION["error"] = 1;

    }
    header("Location: login.php");       
    die();
    $conn=null;

?>
    




