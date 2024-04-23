<?php
ini_set('display_errors', 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mortgage System | Login</title>
    <link rel="stylesheet" href="style/mobile.css">
    <link rel="stylesheet" media="only screen and (min-width:720px)" href="style/desktop.css"/>
</head>

<body>

<!-- header starts -->
<header>
  <div class="logo">
    <h1 class="logo-text"><span>Rose</span>Mortgage</h1>
  </div>
    <ul class="navbar">
     <li><a href="home.html">Home</a></li>
     <li><a href="register.html">Sign Up</a></li>
      <li><a href="login.php">Login</a></li>
      <li>
       <a href="#">
          <i class="user"></i>
        
           <i class="dropdown"></i>
        </a>



     </li>
    </ul>
      <!--menu icon -->
      <div class="hamburger">
          <span></span>
          <span></span>
          <span></span>
  </div>

</header>
<!--header ends-->



<div class="main-container">
    <form class = "user-form" action="loginconfig.php" method="post">
 <?php
                    //in case of any errors, it should diplay this php code begin
                    if($loginerror)
                    {
                        echo '<div style="color:red;"> *Invalid email or password.</div>';
                    }
                   
                    ?>
    <h3>Login</h3>
          <input type="email" name="email" required placeholder="Email">
          <input type="password" name="password" required placeholder="Password">
          <input type="submit" name="submit" value="Login" class="form-btn">
          <p>or <a href="register.html">Sign up</a></p>
     </form>
</div>


<!-- footer starts -->
<footer>

  <div class ="footer-container">
  
      <div class="footer-logo">
          <h1 class="logo-text"><a href="home.html"><span>Rose</span>Mortgage</a></h1>
      </div>
      <div class="contact">
          <a href="#" class="contact-address" target="_blank">
                   Adress line 1
              <br/>Adress line2
              <br/>city
              <br/>postcode
          </a>
          <div class="contact-details">
              <br/><a href="mailto:#">Email: xyz</a>
              <br/><a href="tel:#">Tel: xyz</a>
          </div>
      </div>
      <div class="footer-bottom">
          <div class="copyright">Rose Mortgage
          <span></span> 2024 All Rights Reserved
          </div>
      </div>
  </div>
  </footer> 
<!-- footer ends -->
</body>
</html>
