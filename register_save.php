<?php
    session_start();
   
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $database = "webboard_recipes";
    
    $login = $_POST['login'];
    $passwd = $_POST['pwd'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8","$username","$password");
    $passwd = sha1($passwd);
    
    
    $sql = "SELECT * FROM user where user_name ='$login' or user_email = '$email'";
    $result=$conn->query($sql);
    // ถ้าบัญชีเคยสมัครไว้แล้ว
    if($result->rowCount()>=1){
        $_SESSION['add_login'] = 'error';
    }
    // ถ้ายังไม่เคยสมัคร
    else{
        $sql1 = "INSERT INTO user ( user_username, user_password, user_name, user_email, user_role) VALUES
                ('$login','$passwd','$name','$email', 'm')";

        $conn -> exec($sql1);
        $_SESSION['add_login'] = 'success';
    }
    $conn = null;
    header("Location: register.php");       
    die();
?>