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
    <link rel="stylesheet" href="css/cart.css">
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
    <div id="confermBuy">
        <a href="ordine.php" >Procedi al ordine</a>
        <a href="viewOrders.php">visualizza ordini </a>
    </div>

    <div id="allProduct">

        <?php
            $idProduct=$_GET['id'];
            
            session_start();
            $idlog=$_SESSION['id_utente-logged'];
            
            
            if (!isset($idlog)) {
                header("Location: login.php");
                $_SESSION['error']="devi accedere per usare il carrello";
            }
            else{
                $href="login.php";
            }
            if(isset($idProduct)){
                
                $sql="INSERT INTO `carrello`( `fk_prodotto`, `fk_utente`) VALUES ('".$idProduct."','$idlog')";
                mysqli_query($conn,$sql);
                header("Location: cart.php");
            }
            $sql="SELECT carrello.id_carrello, prodotti.id_prodotto, carrello.fk_utente, prodotti.nomeProdotto, prodotti.prezzo, prodotti.descrizione, immagini.sorgenteImmagine, categorie.nomeCategoria
             FROM `carrello` INNER JOIN prodotti 
             ON prodotti.id_prodotto=carrello.fk_prodotto INNER JOIN immagini 
             ON immagini.fk_prodotto=prodotti.id_prodotto INNER JOIN categorie 
             ON categorie.id_categoria=prodotti.fk_categoria WHERE carrello.fk_utente='".$idlog."';";
             
             $result = mysqli_query($conn, $sql);
             $numRighe = mysqli_num_rows($result);
             for ($i=0; $i < $numRighe; $i++) { 
                
                 $riga = mysqli_fetch_assoc($result);
                 $idCart=$riga["id_carrello"];
                 $id=$riga["id_prodotto"];
                 $nomeProdotto = $riga["nomeProdotto"];
                 $nomeCategoria=$riga["nomeCategoria"];
                 $prezzoProdotto = $riga["prezzo"];
                 $descProdotto = $riga["descrizione"];
                 $srcProdotto=$riga["sorgenteImmagine"]; 
                 $hrefR="php/removePrduct.php?id=".$id."&idCart=".$idCart."";
                
                 echo'
                 <div class="product">
                    <img class="img" src="'.$srcProdotto.'" alt="Image Product">
                        <div class="product-text">
                            <h2>'.$nomeProdotto.'</h2>
                            <h3>'.$descProdotto.'</h3>
                        </div>
                        <div class="product-prezzo">
                            <h3>'.$nomeCategoria.'-'.$prezzoProdotto.'$</h3>
                        </div>
                    
                    <a href="'.$hrefR.'"; class="remove-link">Rimuovi</a>
                </div> 
                 ';
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