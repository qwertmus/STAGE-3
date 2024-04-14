<?php

include "includes/connect.php";

session_start();

if (isset($_SESSION['user_id']))//User is logged in, page is accessible.
{
    $userid = $_SESSION['user_id'];

    $findquotes = "SELECT * FROM quotes WHERE user_id = '$userid'";
    $result = mysqli_query($mysqli, $findquotes);
}
else //User is NOT already logged in; page is inaccessible.
{
    header("Location: home.html");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rose Mortgage | View Saved Quotes</title>
    <link rel="stylesheet" href="style/mobile.css">
    <link rel="stylesheet" media="only screen and (min-width:720px)" href="style/desktop.css" />
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
        <div class="productsearch-container">
            <div class="productsearch-division">
                <h4>Saved Rose Mortgage quotes</h4>
                <p>Hello, <?php echo $_SESSION['user_name']; ?>, Please see the list of all of your saved mortgage quotes below:</p>
            </div>
            <div class="productsearch-division">
                <div class="productsearch-resultarea">
                    <?php
                    while ($entry = mysqli_fetch_assoc($result)) 
                    {
                        ?>
                        <a class="productsearch-span">
                        <form method="POST" action="deletequote.php">
                            <div class="productsearch-result">
                                <div class ="productsearch-result-column">
                                    <p>Quote Unique ID:</p>
                                    <input type="text" name="quoteid" class="productsearch-text" value='<?php echo $entry['quote_id']; ?>' readonly></input>
                                </div>
                                <div class ="productsearch-result-column">
                                    <p>Mortgage Type:</p>
                                    <p><?php echo $entry['mortgage_type']; ?></p>
                                </div>
                                <div class ="productsearch-result-column">
                                    <p>Monthly Payment:</p>
                                    <p><?php echo $entry['monthly_payment']; ?></p>
                                </div>
                                <div class ="productsearch-result-column">
                                    <p>Initial Interest Rate (%):</p>                                    <p><?php echo $entry['monthly_payment']; ?></p>
                                    <p><?php echo $entry['interest_rate']; ?></p>
                                </div>
                                <div class ="productsearch-result-column">
                                    <p>Product Fee:</p>
                                    <p><?php echo $entry['product_fee']; ?></p>
                                </div>
                                <div class ="productsearch-result-column">
                                    <p>Total Payable:</p>
                                    <p><?php echo $entry['total_payable']; ?></p>
                                </div>
                                <div class ="productsearch-result-column">
                                    <input type="submit" name="deletequote" class="productsearch-button" value="Delete Quote"></input>
                                </div>
                            </div>
                        </form>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- footer starts -->
    <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <h1 class="logo-text"><a href="home.html"><span>Rose</span>Mortgage</a></h1>
            </div>
            <div class="contact">
                <a href="#" class="contact-address" target="blank">
                    Adress line 1
                    <br />Adress line2
                    <br />city
                    <br />postcode
                </a>
                <div class="contact-details">
                    <br /><a href="mailto:#">Email: xyz</a>
                    <br /><a href="tel:#">Tel: xyz</a>
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