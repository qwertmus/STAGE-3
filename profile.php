<?php 
    session_start();
    include("includes/connect.php");

    $profileQuery = "SELECT * FROM users WHERE user_id = {$_SESSION['user_id']};";
    $profileResult = $mysqli->query($profileQuery);

    $profileArray = null;

    while ($obj = $profileResult->fetch_object()) {
        $profileArray = array(
            "first_name" => $obj->first_name,
            "middle_name" => $obj->middle_name,
            "surname" => $obj->surname,
            "email_address" => $obj->email_address,
            "date_of_birth" => $obj->dob,
            "postcode" => $obj->postcode,
            "password" => $obj->password,
            "contact_number" => $obj->contact_number,
            "credit_score" => $obj->credit_score,
            "income" => $obj->income,
            "employment_status" => $obj->employment_status
        );
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rose Mortgage | profile</title>
    <link rel="stylesheet" href="style/mobile.css">
    <link rel="stylesheet" media="only screen and (min-width:720px)" href="style/desktop.css"/>



    <link rel="stylesheet" href="style/profile.css">




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
      <!--menu icon -->
      <div class="hamburger">
          <span></span>
          <span></span>
          <span></span>
  </div>

</header>

<!-- header ends -->

<div class="main-container">
  <div class="inner-container">

    <header class="a-header">My Profile</header>
    <form action="profilechanges.php" class="form" method="post">
        <div class="column">
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

      <div class="column">
          <div class="input-box">
              <label>Contact Number</label>
              <?php echo "<input type='number' value={$profileArray['contact_number']} name='contactnumber' placeholder='Enter your number' maxlength='11'>"; ?>
          </div>

          <div class="input-box">
              <label>Confirm Number</label>
              <input type="number" name="confirmnumber" placeholder="Enter your number again" maxlength="11">
          </div>
      </div>

      <div class="input-box">
          <label>Your Email</label>
          <?php echo "<input type='email' value={$profileArray['email_address']} name='email' placeholder='Enter your email'>"; ?>
      </div>

      <div class="input-box">
          <label>postcode</label>
          <?php echo "<input type='text' value={$profileArray['postcode']} name='postcode' placeholder='Enter your postcode' maxlength='6'>"; ?>
      </div>

      <div class="input-box">
          <label>Income</label>
          <?php echo "<input type='number' value={$profileArray['income']} name='income' placeholder='Enter your annual income' min='0' max='999999'>"; ?>
          
          <div class="select-box Income">

              <select name="employment">
                  <?php 
                    $employArray = array(
                         1 => "Employment type",
                         2 => "Full time",
                         3 => "Part time",
                         4 => "Self employed",
                    );

                    function OptionHTMLAddition($number, $status, $profileArray)
                    {
                        $addition = "";
                        if ($number === 1) {
                            $addition = $addition . " hidden";
                        }

                        if ($status === $profileArray['employment_status']) {
                            $addition = $addition . " selected='seleceted'";
                        }

                        return $addition;
                    }

                    foreach ($employArray as $number => $status) {
                        echo "<option" . OptionHTMLAddition($number, $status, $profileArray) . ">";
                        echo $status;
                        echo "</option>";
                    }
                  ?>
              </select>
          </div>
      </div>

      <div class="column">
          <div class="input-box">
              <label>DOB</label>
              <?php echo "<input type='date' value={$profileArray['date_of_birth']} name='dateofbirth' placeholder='Enter your DOB'>"; ?>
          </div>

          <div class="input-box">
              <label>Credit Score</label>
              <?php echo "<input type='text' value={$profileArray['credit_score']} name='creditscore' placeholder='Enter your credit score' maxlength='3'>"; ?>
          </div>
      </div>

      <button name="changedetails">Change Details</button>
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
