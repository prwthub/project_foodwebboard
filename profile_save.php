<?php
    session_start();
   
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $database = "webboard_recipes";
    
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $exp = $_POST['exp'];
    $des = $_POST['des'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    // รอ
    $pic = $_POST['pic'];


    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8","$username","$password");
    
    $sql = "INSERT INTO user ( user_fname, user_lname, user_phone, user_exp, user_des, user_country, user_state) 
            VALUES('$fname','$lname','$phone','$exp','$des','$country','$state')";

    $conn -> exec($sql);
    $_SESSION['edit'] = 'success';
    
    
    $conn = null;
    header("Location: profile.php");       
    die();
?>