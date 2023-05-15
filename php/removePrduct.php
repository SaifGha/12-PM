<?php
include_once "dbh.php";
session_start();
$idProduct = $_GET['id'];
$idCart=$_GET['idCart'];
$id = $_SESSION['id_utente-logged'];
if (!isset($id)) {
    $_SESSION['error'] = "Per usare il carrello devi essere loggato";
    header("Location: ../login.php");
    exit();
}

if (isset($idProduct)) {
    $sql = "DELETE FROM `carrello` WHERE fk_prodotto='".$idProduct."' AND fk_utente='".$id."' AND id_carrello='".$idCart."'";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../cart.php");
        exit();
    } else {
        $_SESSION['error'] = "Errore durante l'eliminazione dal carrello";
        header("Location: ../cart.php");
        exit();
    }
}
