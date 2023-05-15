<?php
include_once 'php/dbh.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/order-details.css">
    <title>Order-Detail-Payment</title>
</head>

<body>
    <nav id="navbar">
        <h2>LOGO.</h2>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="product.php">Product</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        
        <div id="icons">
        <h4 id="User"><?php 
        session_start();
        $id=$_SESSION['id_utente-logged'];
         if (isset($id)) {
 
             $sql="SELECT `nome` FROM `utenti` WHERE `id_utente`= ".$id;
             $result=mysqli_query($conn, $sql);
             $riga=mysqli_fetch_assoc($result);
             $nomeUtente=$riga['nome'];
             echo"Bentornato ".$nomeUtente;
            
         }?></h4>
            <a href=""><img width="30px" src="image/cart.svg" alt="Logo"></a>
            <a href="login.php"><img width="30px" src="image/account.svg" alt="Logo"></a>
        </div>
    </nav>
    <h1>Metodo Pagamento</h1>
  <form action="php/completeOrder.php" method="POST">
    <label for="numero_carta">Numero Carta di Credito:</label>
    <input type="text" id="numero_carta" pattern="[0-9]{13,16}" name="numero_carta" placeholder="xxxx-xxxx-xxxx-xxxx" required>

    <label for="data_scadenza">Data di Scadenza:</label>
    <input type="text" id="data_scadenza" name="data_scadenza" pattern="[0-9-/]{5}" placeholder="mm/yy" required>

    <label for="cvv">CVV:</label>
    <input type="text" id="cvv" name="cvv" maxlength="3" placeholder="xxx" required>

    <input id="btn" type="submit" value="Paga Ora">
  </form>
         <?php
            $nome=$_POST['nome'];
            $cognome=$_POST['cognome'];
            $numero=$_POST['numero'];
            $città=$_POST['città'];
            $indirizzo=$_POST['indirizzo'];
            $civico=$_POST['civico'];
            $numero_carta=$_POST['numero_carta'];
            $data_scadenza=$_POST['data_scadenza'];
            $cvv=$_POST['cvv'];
            $date = date("Y-m-d"); 
          
            session_start();
            $idlog=$_SESSION['id_utente-logged'];

             if (!isset($idlog)) {
                 header("Location: login.php");
                 $_SESSION['error']="Devi accedere per ordinare prodotti";
                 exit();
             }
             $sql="INSERT INTO `ordini`( `fk_utente`, `nome`, `cognome`, `numero`, `città`, `indirizzo`, `civico`,`data`) 
             VALUES ('".$idlog."','".$nome."','".$cognome."','".$numero."','".$città."','".$indirizzo."','".$civico."','".$date."')
             ";
             
             mysqli_query($conn, $sql);
            
            
         ?>
</body>
</html>