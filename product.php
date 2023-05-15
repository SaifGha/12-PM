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
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/product-page.css">
    <title>Prodotti</title>
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
            <a id="loginLink" href="login.php"><img width="30px" src="image/account.svg" alt="Logo"></a>
        </div>
    </nav>
    <div id="filterbar">
        <form method="$_GET">
            <select name="ordine" id="filtri">
                <option value="" default>Ordina per&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &#8681;</option>
                <option value="ASC">Prezzo più Basso </option>
                <option value="DESC">Prezzo più Alto</option>
                <option value="">Più venduti</option>
            </select><br>
            <?php
            foreach ($_GET as $key => $value) {
                if ($key=="categoria") {
                    $key = htmlspecialchars($key);
                    $value = htmlspecialchars($value);
                    echo "<input type='hidden' name='$key' value='$value'/>";
                }
            }
            ?>
            <input type="submit" value="Ordina">
        </form>
    </div>

    <div id="product-box">
        <?php
        $ordine=$_GET["ordine"];
        if (isset($_GET["categoria"])) {
            $categoria=" WHERE categorie.nomeCategoria='".$_GET["categoria"]."' ";
        }
        $sql = "SELECT id_prodotto, nomeProdotto, prezzo, descrizione, sorgenteImmagine, nomeCategoria FROM immagini
        INNER JOIN prodotti 
        ON immagini.fk_prodotto=prodotti.id_prodotto
        INNER JOIN categorie
        ON prodotti.fk_categoria= categorie.id_categoria"
         .$categoria." ORDER BY prezzo ".$ordine
        ;

        $result = mysqli_query($conn, $sql);
        $numRighe = mysqli_num_rows($result);
        for ($i=0; $i < $numRighe; $i++) { 
            
            $riga = mysqli_fetch_assoc($result);
            $id=$riga["id_prodotto"];
            $nomeProdotto = $riga["nomeProdotto"];
            $prezzoProdotto = $riga["prezzo"];
            $descProdotto = $riga["descrizione"];
            $srcProdotto=$riga["sorgenteImmagine"];
    
            echo '  <a style="text-decoration:none; color:black;" href="product-details.php?id='.$id.'">
                        <div class="product">
                            <img src="'.$srcProdotto.'" alt="ImageProduct">
                            <h1>'.$nomeProdotto.'</h1>
                            <h2>'.$descProdotto.'</h2>
                            <h3><b>'.$prezzoProdotto.' $'.'</b></h3>
                        </div>
                    </a>';
        }
        ?>
        </div>
        
    

    <footer id="footer" style="color: beige; padding:10px;">
        <ul>
            <li>WebMaster: Saif Edin Gharsallah</li>
            <li>Developed by Saif Edin Gharsallah</li>
            <li>Website created for educational purposes not for commercial purposes</li>
        </ul>
    </footer>
</body>
</html>