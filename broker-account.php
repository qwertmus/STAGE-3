<?php 
    session_start();
    include("includes/connect.php");

    $profileQuery = "SELECT * FROM brokers WHERE broker_id = {$_SESSION['user_id']};";
    $profileResult = $mysqli->query($profileQuery);

    $profileArray = null;

    while ($obj = $profileResult->fetch_object()) {
        $profileArray = array(
            "first_name" => $obj->first_name,
            "middle_name" => $obj->middle_name,
            "surname" => $obj->surname,
            "email_address" => $obj->email_address,
            "date_of_birth" => $obj->dob
        );
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rose Mortgage | Home</title>
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
    <li><a href="broker-createproduct.html">Create product</a></li>
    <li><a href="broker-manageproduct.php">Manage Product</a></li>
    <li>
      <a href="#">
        <i class="user"></i>
        <?php echo $_SESSION['user_name']; ?>
        <i class="dropdown"></i>
      </a>

      <ul>
        <li><a href="#">My Profile</a></li>
        <li><a href="login.php" class="logout">Logout</a></li>
      </ul>

    </li>
  </ul>
      <!--menu icon -->
      <div class="hamburger">
          <span></span>
          <span></span>
          <span></span>
  </div>

</header>

<!-- header ends -->

<h4>My Profile</h4>
      <div class = "affordability-container">
        <div class="input-group">
    <form action="profilechanges.php" class="form" method="post">
          <div class="input-box">
              <label>First Name</label>
              <?php echo "<input type='text' value={$profileArray['first_name']} name='firstname' placeholder='Enter your first name' maxlength='30'>"; ?>
          </div>

          <div class="input-box">
              <label>Middle Name</label>
              <?php echo "<input type='text' value={$profileArray['middle_name']} name='middlename' placeholder='Enter your middle name' maxlength='30'>"; ?>
          </div>

          <div class="input-box">
              <label>Surname</label>
              <?php echo "<input type='text' value={$profileArray['surname']} name='surname' placeholder='Enter your surname' maxlength='30'>"; ?>
          </div>
      </div>

      <div class="input-box">
          <label>Your Email</label>
          <?php echo "<input type='text' value={$profileArray['email_address']} name='email' placeholder='Enter your email'>"; ?>
      </div>

      <div class="input-box">
          <label>DOB</label>
          <?php echo "<input type='text' value={$profileArray['date_of_birth']} name='dateofbirth' placeholder='Enter your date of birth'>"; ?>
      </div>

      <button name="changebrokerdetails">Change Details</button>
    </form>


     








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
