<?php
    include_once 'dbh.php';
    session_start();
    unset($_SESSION['logged_user_id']);
    $_SESSION['s']="unchecked";
    header("Location: ../login.php?logout=success");    
