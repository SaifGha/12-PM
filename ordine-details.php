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
    <title>Order-Detail</title>
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
    <h1>Completa il tuo ordine</h1>
    <div id="form">
    <form action="ordine-details-payment.php" method="post">
        <input type="text" name="nome" placeholder="Nome" required><br>
        <input type="text" name="cognome" placeholder="Cognome" required><br>
        <input type="text" name="numero" placeholder="Numero Telefono" required><br>
        <input type="text" name="città" placeholder="Città, Provincia" required><br>
        <input type="text" name="indirizzo" placeholder="Indirizzo" required><br>
        <input type="text" name="civico" placeholder="Civico" required><br>
        <input id="btn" type="submit" value="Vai al metodo di pagemento"><br>
    </form>
    </div>
    
</body>
</html>