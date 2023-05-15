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
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/slideShow.css">
    <link rel="stylesheet" href="css/product.css">
    <script src="js/slideShow.js"></script>
    <title>HomePage</title>
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
            <a href="cart.php"><img width="30px" src="image/cart.svg" alt="Logo"></a>
           
            <a id="loginLink" onclick="VerfyLogin();" href="
            <?php
                session_start();
                $href="login.php";
                $id=$_SESSION['id_utente-logged'];
                 if (isset($id)) {
                    $href="account.php";
                 }
                 echo"$href";
            ?>
            "><img width="30px" src="image/account.svg" alt="Logo"></a>
        </div>
    </nav>
            
    <div class="banner-box" style="margin-top: 40px ;">
        <div class="banner">
            <img src="image/per_lui.jpg" alt="">
            <a href="product.php?categoria=Uomo">Vai al <br>Catalogo da Uomo</a>
        </div>
    </div> 
    
    <div class="banner-box">
        <div class="banner">
            <img  src="image/per_lei.jpg" alt="">
            <a href="product.php?categoria=Donna">Vai al <br>catalogo da Donna</a>
        </div>
    </div>
    
    <div id="titoloP"><h2>I NOSTRI PI&Ugrave; VENDUTI </h2></div>
    <div id="topSeller">
        
        <div id="product-box">
            <div class="product">
                <img src="image/imageProducts/WAT_242009_S1.jpg" alt="ImageProduct">
                <h1>Victorinox Swiss Army</h1>
                <h2>Orologio da Uomo Victorinox <br> Swiss Army 242009</h2>
                <h3><b>910,00$</b></h3>
            </div>
            <div class="product">
                <img src="image/imageProducts/WAT_242009_S1.jpg" alt="ImageProduct">
                <h1>Victorinox Swiss Army</h1>
                <h2>Orologio da Uomo Victorinox <br> Swiss Army 242009</h2>
                <h3><b>910,00$</b></h3>
            </div>
            <div class="product">
                <img src="image/imageProducts/WAT_242009_S1.jpg" alt="ImageProduct">
                <h1>Victorinox Swiss Army</h1>
                <h2>Orologio da Uomo Victorinox <br> Swiss Army 242009</h2>
                <h3><b>910,00$</b></h3>
            </div>
            <div class="product">
                <img src="image/imageProducts/WAT_242009_S1.jpg" alt="ImageProduct">
                <h1>Victorinox Swiss Army</h1>
                <h2>Orologio da Uomo Victorinox <br> Swiss Army 242009</h2>
                <h3><b>910,00$</b></h3>
            </div>
            
        </div>
    </div>
 

    <div class="offerte">

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