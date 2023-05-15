
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login</title>
      
      <link rel="stylesheet" href="css/login.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
         <div class="title-text">
            <div class="title login">
               Login Form
            </div>
            <div class="title signup">
               Signup Form
            </div>
         </div>
         <div class="form-container">
            <div class="slide-controls">
               <input type="radio" name="slide" id="login" checked>
               <input type="radio" name="slide" id="signup">
               <label for="login" class="slide login">Login</label>
               <label for="signup" class="slide signup">Signup</label>
               <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
               <form action="php/login.php" method="post" class="login">
                  <?php 
                     session_start();
                     $error=$_SESSION['error'];
                     $_SESSION['error']="";
                     echo '<span style="color:red; font-size:12px; text-align:center;">'.$error.'</span>';
                  ?>
                  <div class="field">
                     <input name="Logemail" type="text" placeholder="Email Address" required>
                  </div>
                  <div class="field">
                     <input name="Logpassword" type="password" placeholder="Password" required>
                  </div>
                  <div class="pass-link">
                     <a href="#">Forgot password?</a>
                  </div>
                  <div class="field btn">
                     <div class="btn-layer"></div>
                     <input type="submit" value="Login">
                  </div>
                  <div class="signup-link">
                     Not a member? <a href="">Signup now</a>
                  </div>
               </form >
               <!--========================================================-->
               <form action="php/signup.php" method="post" class="signup"> 
                  <div class="field">
                     <input name="nickname" type="text" placeholder="Nick Name" required>
                  </div> 
                  <div class="field">
                     <input name="email" type="text" placeholder="Email Address" required>
                  </div>
                  <div class="field">
                     <input  name="password" type="password" placeholder="Password" required minlength="8" maxlength="20">
                  </div>
                  <div class="field">
                     <input name="confirm_password" type="password" placeholder="Confirm password" required>
                  </div>
                  <div class="field btn">
                     <div class="btn-layer"></div>
                     <input type="submit" value="Signup">
                  </div>
               </form>
            </div>
         </div>
      </div>
     <script src="js/login.js"></script>
   </body>
</html>