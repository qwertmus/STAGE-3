<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rose Mortgage | Home</title>
    <link rel="stylesheet" href="style/mobile.css">
    <link rel="stylesheet" media="only screen and (min-width:720px)" href="style/desktop.css"/>
    <link rel="stylesheet" media="only screen and (min-width:720px)" href="style/usermainpage.css"/>



    <link rel="stylesheet" href="yourowncssfile.css">




</head>

<body>

<!-- header starts -->
<header>

  <div class="logo">
    <h1 class="logo-text"><span>Rose</span>Mortgage</h1>
  </div>

  <ul class="navbar">
    <li><a href="UserMainPage.php">Home</a></li>

    <li>
      <a href="#">
        <i class="user"></i>
        <?php echo $_SESSION['user_name']; ?>
        <i class="dropdown"></i>
      </a>

      <ul>
        <li><a href="profile.php">My Profile</a></li>
        <li><a href="login.php" class="logout">Logout</a></li>
      </ul>

    </li>
  </ul>

</header>

<!-- header ends -->

<div class="main-container">
    <div class="inner-container">

      
      <!--code here-->
      
        <h3><?php echo $_SESSION['user_name']; ?></h3>
              
          <div class="UserMainPagefirst">      
              <h4>Create mortgage quote</h4>  
              <a href = productsearch.php>
              <img src="images\calculate-mainUserpage.jpg" alt="calculate quote image" height=250px width=800px>
              </a>
          </div>        
          <div class="UserMainPagesecond">
              <h4>View mortgage quote history</h4>  
              <a href = viewsavedquotes.php>   
              <img src="images\row-of-books.webp" class="ContainerMainUser" alt="books on shelf, view quotes" height=250px width=800px>
              </a>
          </div>   
        <h3></h3>
     

    </div>
</div>
    <!-- footer starts -->
    <footer>
    
      <div class ="footer-container">
      
          <div class="footer-logo">
              <h1 class="logo-text"><a href="home.html"><span>Rose</span>Mortgage</a></h1>
          </div>
        
          <div class="contact">
              <a href="#" class="contact-address" target="blank">
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