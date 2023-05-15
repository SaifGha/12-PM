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
    <link rel="stylesheet" href="css/ordine.css">
    <title>Ordine</title>
</head>
<body>
<nav id="navbar">
        <h2>12-PM.</h2>
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

    <h1>Il tuo ordine</h1>
	<table>
		<thead>
			<tr>
                <th>Numero Prodotto</th>
				<th>Prodotto</th>
				<th>Prezzo</th>
			</tr>
		</thead>
		<tbody>
    <?php

    session_start();
    $idlog=$_SESSION['id_utente-logged'];

    if (!isset($idlog)) {
        header("Location: login.php");
        $_SESSION['error']="Devi accedere per ordinare prodotti";
    }
    $sql="  SELECT carrello.id_carrello, prodotti.id_prodotto, carrello.fk_utente, prodotti.nomeProdotto, prodotti.prezzo 
            FROM carrello INNER JOIN prodotti 
            ON prodotti.id_prodotto = carrello.fk_prodotto 
            WHERE carrello.fk_utente ='".$idlog."';";
             
             $result = mysqli_query($conn, $sql);
             $numRighe = mysqli_num_rows($result);
             for ($i=0; $i < $numRighe; $i++) { 
                
                 $riga = mysqli_fetch_assoc($result);
                 $idCart=$riga["id_carrello"];
                 $id=$riga["id_prodotto"];
                 $nomeProdotto = $riga["nomeProdotto"];
                 $prezzoProdotto = $riga["prezzo"];
                 $numProd=$i+1;                 
                
                 echo'
                 <tr>
                    <td>N° '.$numProd.' 
                    <td> '.$nomeProdotto.'</td>
                    <td>'.$prezzoProdotto.'$</td>
			    </tr>
                 ';
                }
        $sql="  SELECT SUM(prodotti.prezzo) AS totale, carrello.id_carrello, prodotti.id_prodotto, carrello.fk_utente, prodotti.nomeProdotto, prodotti.prezzo 
                FROM carrello INNER JOIN prodotti 
                ON prodotti.id_prodotto = carrello.fk_prodotto 
                WHERE carrello.fk_utente ='".$idlog."';";
             
                $result = mysqli_query($conn, $sql);
                $riga = mysqli_fetch_assoc($result);
                $totale = $riga["totale"];
                echo '
                <tr>
                    <td><strong>Totale</strong></td>
                    <td></td>
                    <td><strong>'.$totale.'$</strong></td>
			    </tr>
                ';
    ?>
	
		</tbody>
	</table>

	<a id="conferma" href="ordine-details.php">Procedi</a>
	


</body>
</html>