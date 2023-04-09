<?php
    session_start();
    $user_id = $_SESSION['user_id'];
   
    require 'dbConfig_PDO.php';
    
    //NewData
    $uname = $_POST['uname'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $exp = $_POST['exp'];
    $des = $_POST['des'];
    $country = $_POST['country'];
    $state = $_POST['state'];

    echo $uname.'<BR>';
    echo $fname.'<BR>';
    echo $lname.'<BR>';
    echo $phone.'<BR>';
    echo $exp.'<BR>';
    echo $des.'<BR>';
    echo $country.'<BR>';
    echo $state.'<BR>';
    echo $user_id.'<BR>';

    $conn = new PDO("mysql:host=$server_name;dbname=$database;charset=utf8","$username","$password");
    $update = ("UPDATE user SET user_name = '$uname', user_fname = '$fname', user_lname = '$lname', 
                                user_phone = '$phone', user_exp = '$exp', user_des = '$des', 
                                user_country = '$country', user_state = '$state'
                WHERE user_id = '$user_id'");
    $conn->exec($update);
    header("location: myprofile.php");
    $conn = null;
    die();
?>