<?php
include_once 'dbh.php';
session_start();
$idlog = $_SESSION['id_utente-logged'];
$date = date("Y-m-d"); 
$sql = "SELECT `id_ordine`, `fk_utente`, `data` 
        FROM `ordini` 
        WHERE `fk_utente`='" . $idlog . "' AND `data`='" . $date . "'";
        
             $result=mysqli_query($conn, $sql);
             $numRighe = mysqli_num_rows($result);
              for ($i=0; $i < $numRighe; $i++) { 
                
                  $riga = mysqli_fetch_assoc($result);
                 
              }
             
             $idOrdine=$riga['id_ordine'];
             

             $sql="SELECT carrello.id_carrello, prodotti.id_prodotto, carrello.fk_utente, carrello.fk_prodotto
              FROM carrello 
              INNER JOIN prodotti ON prodotti.id_prodotto = carrello.fk_prodotto 
              INNER JOIN utenti ON carrello.fk_utente=utenti.id_utente 
              INNER JOIN ordini ON ordini.fk_utente=utenti.id_utente 
              WHERE carrello.fk_utente = '".$idlog."' 
             GROUP BY carrello.id_carrello;";
              
              $result = mysqli_query($conn, $sql);
              $numRighe = mysqli_num_rows($result);
              for ($i=0; $i < $numRighe; $i++) { 
                
                  $riga = mysqli_fetch_assoc($result);
                  $idProdotto=$riga["id_prodotto"];
                  
                   $sql="INSERT INTO `orderDetails`( `fk_prodotto`, `fk_ordine`) 
                  VALUES ('".$idProdotto."','".$idOrdine."')";
                  
                   mysqli_query($conn, $sql); 
                   $sql="DELETE FROM `carrello` WHERE `fk_prodotto`='".$idProdotto."' AND `fk_utente`='".$idlog."'";        
                   mysqli_query($conn, $sql); 
              }
              header("Location: ../cart.php");