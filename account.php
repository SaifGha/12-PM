<?php
include_once 'php/dbh.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/account.css">
    <title>My Account</title>
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
             <a href=""><img width="30px" src="image/cart.svg" alt="Logo"></a>
             <a href="login.php"><img width="30px" src="image/account.svg" alt="Logo"></a>
         </div>
     </nav>
      <div class="wrapper">
            <div class="title">
               My account
            </div>
            <div class="info">
                
                <?php
                    session_start();
                    $logged_user_id=$_SESSION['logged_user_id'];
                    $sql=" SELECT * FROM `login` WHERE `id` = '$logged_user_id' ;";
                    $result = mysqli_query($conn, $sql);
                    $row=mysqli_fetch_assoc($result);
                    echo "benvenuto"."<br>";                 
                    echo "E-mail: ".$row['email'];
                ?>
                <div class="form_container">
                    <form action="php/logout.php">
                        <input  type="submit" name="Logout">
                    </form>
                </div>
            </div>
      </div>
</body>
</html>