<?php
    session_start();
    session_destroy();
    header("location:login.php"); // test_session
    //header("Location: index.php");
    die();
?>