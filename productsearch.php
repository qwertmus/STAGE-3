<?php

include "includes/connect.php";

session_start();

if (isset($_SESSION['purpose']))//This should fire true if the user entered the fields and was redirected here successfully.
{
    $purpose = validate($_SESSION['purpose']);
    $price = floatval($_SESSION['price']);
    $deposit = intval($_SESSION['deposit']);
    $term = $_SESSION['term'];

    /*$depositpercent = number_format($deposit / $price, 2);*/
    $depositpercent = ($deposit / $price * 100);
    $loantovalue = 100 - $depositpercent;

    $findproducts = "SELECT * FROM products WHERE product_type = '$purpose' AND ltv <= '$loantovalue'";
    $result = mysqli_query($mysqli, $findproducts);
}
else //The user has entered this page for the first time, without any values being entered.
{
    $purpose = "Not Set";
    $price = "0.00";
    $deposit = "0.00";
    $term = "0";
    $depositpercent = 0;
    $loantovalue = 0;
}

function validate($input)
{
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rose Mortgage | Home</title>
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
            <li><a href="login.html">Login</a></li>
            <li>
                <a href="#">
                    <i class="user"></i>
                    Name
                    <i class="dropdown"></i>
                </a>

                <ul>
                    <li><a href="#">My Profile</a></li>
                    <li><a href="#" class="logout">Logout</a></li>
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
                <h4>Find Rose Mortgage products</h4>
                <p>Please use the below mortgage rate finder to view all of our deals.</p>
                <form action="handlesearch.php" method="post">
                    <table class="productsearch-table">
                        <thead>
                            <th class="productsearch-header">Mortgage Purpose</th>
                            <th class="productsearch-header">Property Price</th>
                            <th class="productsearch-header">Deposit Amount</th>
                            <th class="productsearch-header">Term of Loan</th>
                            <th class="productsearch-header">Deposit %</th>
                            <th class="productsearch-header">Loan To Value %</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="productsearch-td">
                                    <select class="productsearch-field" name="purpose" required>
                                        <option value="">Select Mortgage Purpose</option>
                                        <option value="FTB">FTB</option>
                                        <option value="Remortgage">Remortgage</option>
                                        <option value="Moving House">Moving House</option>
                                    </select>
                                </td>
                                <td class="productsearch-td">
                                    <input type="text" class="productsearch-field" name="price" placeholder="Value"></input>
                                </td>
                                <td class="productsearch-td">
                                    <input type="text" class="productsearch-field" name="deposit" placeholder="Deposit"></input>
                                </td>
                                <td class="productsearch-td">
                                    <input type="text" class="productsearch-field" name="term" placeholder="Term Length"></input>
                                </td>
                                <td class="productsearch-td">
                                    <span><?php echo $depositpercent?></span>
                                </td>
                                <td class="productsearch-td">
                                    <span><?php echo $loantovalue?></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="productsearch-button">View Results</button>
                </form>
            </div>
            <div class="productsearch-division">
                <div class="productsearch-resultarea">
                    <?php
                    while ($entry = mysqli_fetch_assoc($result))
                    {
                        ?>
                        <div class="productsearch-result">
                        <p class="productsearch-title"><?php echo $entry['product_type']?></p>
                        <input type="checkbox"></input>
                            <div>
                                <p>Monthly Fee:</p>
                                <?php 
                                
                                ($price-$deposit) * (($entry['interest_rate'] / 100) / 12) * (pow(1 + (($entry['interest_rate'] / 100) / 12), ($entry['mortgage_term'] * 12))) / (pow(1 + (($entry['interest_rate'] / 100) / 12), ($entry['mortgage_term'] * 12)) - 1)
                                
                                ?>                               
                            </div>
                            <div>
                                <p>Interest Rate:</p>
                                <p><?php echo $entry['interest_rate']?></p>
                            </div>
                            <div>
                                <p>Product Fee:</p>
                                <p>
                                <? if(!is_null($entry['product_fee']))
                                {
                                    echo $entry['product_fee'];
                                }
                                else
                                {
                                    echo 'N/A';
                                }
                                ?>
                                </p>
                            </div>
                            <div>
                                <p>Mortage Term:</p>
                                <p><?php echo $entry['mortgage_term']?> years</p>
                            </div>
                        </div>
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