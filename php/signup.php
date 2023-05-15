<?php
include_once 'dbh.php';

$nickname=$_POST['nickname'];
$email=$_POST['email'];

$salt=random_int(1,1000000000);
$pass= md5($_POST['password'].$salt);
$conferma= md5($_POST['confirm_password'].$salt);

if($pass===$conferma){
    $sql = "INSERT INTO `utenti`(`nome`,`email`,`password`,`salt`)
    VALUES ('$nickname','$email','$pass','$salt')";
    mysqli_query($conn, $sql);
    header("Location: ../login.php?signup=riuscito");
}else{
    $error="passwords not matched!";
    session_start();
    $_SESSION['error']=$error;
    $_SESSION['s']="checked";
    header("Location: ../index.php?signup=nonriuscito");
    
}