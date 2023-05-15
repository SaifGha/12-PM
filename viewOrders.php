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
    <title>Carrello</title>
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
    <h1>Elenco Ordini</h1>
	<table style="position:relative; bottom:100px">
		<thead>
			<tr>
				<th>Data Ordine</th>
				<th>Nome Prodotto</th>
				<th>città</th>
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
                    exit();
                }

				

				$sql = "SELECT * FROM `ordini` 
                INNER JOIN orderDetails ON `ordini`.`id_ordine`= orderDetails.fk_ordine 
                INNER JOIN prodotti ON orderDetails.fk_prodotto=prodotti.id_prodotto 
                WHERE `fk_utente`='".$idlog."'";
				$result = mysqli_query($conn, $sql);
                $numRige=mysqli_num_rows($result);
                for ($i=0; $i <$numRige ; $i++) { 
                    $riga=mysqli_fetch_assoc($result);

                    $dataOrdine=$riga['data'];
                    $nomePrdotto=$riga['descrizione'];
                    $città=$riga['città'];
                    $prezzo=$riga['prezzo'];
                    echo' 
                    <tr>
                    <td>'.$dataOrdine.'</td>
                    <td>'.$nomePrdotto.'</td>
                    <td>'.$città.'</td>
                    <td>'.$prezzo.'</td>
                    </tr>  
                    ';
                }
				

			?>
		</tbody>
	</table>

</body>
</html>
