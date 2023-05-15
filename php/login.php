<?php
include_once 'dbh.php';

$email=$_POST['Logemail'];
$pass= $_POST['Logpassword'];
$usrRiconosciuto=false;
$sql="SELECT * FROM `utenti`";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
session_start();

if($resultCheck > 0 ){
    while ($riga=mysqli_fetch_assoc($result)) {
        $passSalt= md5($pass.$riga["salt"]);
        if($email==$riga["email"] && $passSalt==$riga["password"])
        {
            $usrRiconosciuto=true;
            $id=$riga['id_utente'];
            $_SESSION['id_utente-logged']=$id;
            header("Location: ../index.php?login=riuscito");
            exit();
        }
    }
}
if($usrRiconosciuto==false)
{
    $error="Account non esistente o password/email errata!";
    $_SESSION['error']=$error;
    $_SESSION['s']="checked";
    header("Location: ../login.php?login=nonriuscito");
    exit();
}
