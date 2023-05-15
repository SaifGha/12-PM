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
    <link rel="stylesheet" href="css/product-details.css">
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
            <a href=""><img width="30px" src="image/cart.svg" alt="Logo"></a>
            <a id="loginLink"  href="login.php"><img width="30px" src="image/account.svg" alt="Logo"></a>
        </div>
    </nav>


    <div class="product-details">
        <?php
        $idSelezionato=$_GET['id'];
            session_start();
            $id=$_SESSION['id_utente-logged'];
            
            if (isset($id)) {
                $href="cart.php?id=".$idSelezionato;
            }
            else{
                $href="login.php";
            }

            $sql = "SELECT id_prodotto, nomeProdotto, prezzo, descrizione, sorgenteImmagine, nomeCategoria,unita FROM immagini
            INNER JOIN prodotti 
            ON immagini.fk_prodotto=prodotti.id_prodotto
            INNER JOIN categorie
            ON prodotti.fk_categoria= categorie.id_categoria
            WHERE id_prodotto=".$idSelezionato;
            $result = mysqli_query($conn, $sql);
                $riga = mysqli_fetch_assoc($result);
                $id=$riga["id_prodotto"];
                $nomeProdotto = $riga["nomeProdotto"];
                $prezzoProdotto = $riga["prezzo"];
                $descProdotto = $riga["descrizione"];
                $srcProdotto=$riga["sorgenteImmagine"];
                $categoriaProdotto=$riga["nomeCategoria"];
                if ($riga["unita"]>=100) {
                    $unitaProdotto=" Immediata";
                    $colore="green";
                }else{
                    $unitaProdotto=$riga["unita"]." disponibili";
                    $colore="red";
                }

                echo'
                    <div class="product-img">
                            <img src="'.$srcProdotto.'" alt="ImageProduct">
                    </div>
                    <div class="product-text">
                            <h1>'.$nomeProdotto.'</h1><br>
                            <h2>'.$descProdotto.'</h2><br>
                            <h3>'.$prezzoProdotto.' $'.' - '.$categoriaProdotto.''.'</h3><br>
                            <a href="'.$href.'" >Aggiungi al carrello</a><br><br>
                            <h4>Disponibilità:  <span style="color:'.$colore.';">'.$unitaProdotto.'</span></h4>
                    </div>';
        ?>
    </div>

    
    <footer id="footer" style="color: beige; padding:10px;">
        <ul >
            <li>WebMaster: Saif Edin Gharsallah</li>
            <li>Developed by Saif Edin Gharsallah</li>
            <li>Website created for educational purposes not for commercial purposes</li>
        </ul>
    </footer>
</body>
</html>