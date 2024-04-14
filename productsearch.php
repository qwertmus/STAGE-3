<?php

include "includes/connect.php";

session_start();

if (isset($_SESSION['user_id']))//User is logged in, page is accessible.
{
    if (isset($_SESSION['price']))//This should fire true if the user entered the fields and was redirected here successfully.
    {
        $price = floatval($_SESSION['price']);
        $deposit = intval($_SESSION['deposit']);
        $term = $_SESSION['term'];
    
        $depositpercent = ($deposit / $price) * 100;
        $loantovalue = 100 - $depositpercent;
    
        $i = 0;

        if(isset($_SESSION['type']) && isset($_SESSION['fee']) && isset($_SESSION['duration']))
        {
            $type = $_SESSION['type'];
            $fee =  $_SESSION['fee'];
            $period = $_SESSION['duration'];

            if($type == "Unfiltered") //If product type is unfiltered.
            {
                if($period == "Unfiltered") //If product period is unfiltered.
                {
                    if($fee == "Unfiltered") //If product fee is unfiltered.
                    {
                        $findproducts = "SELECT * FROM products 
                        WHERE ltv >= '$loantovalue'";
                        $result = mysqli_query($mysqli, $findproducts);
                    }
                    else if($fee == "Product Fee") //If product fee is filtered to having a product fee.
                    {
                        $findproducts = "SELECT * FROM products 
                        WHERE ltv >= '$loantovalue' AND product_fee > 0";
                        $result = mysqli_query($mysqli, $findproducts);
                    }
                    else //If product fee is filtered to having no product fee.
                    {
                        $findproducts = "SELECT * FROM products 
                        WHERE ltv >= '$loantovalue' AND product_fee IS NULL";
                        $result = mysqli_query($mysqli, $findproducts);
                    }
                }
                else //If product type is unfiltered but product period is filtered.
                {
                    if($fee == "Unfiltered") //If product fee is unfiltered.
                    {
                        $findproducts = "SELECT * FROM products 
                        WHERE ltv >= '$loantovalue' AND initial_period = '$period'";
                        $result = mysqli_query($mysqli, $findproducts);
                    }
                    else if($fee == "Product Fee") //If product fee is filtered to having a product fee.
                    {
                        $findproducts = "SELECT * FROM products 
                        WHERE ltv >= '$loantovalue' AND initial_period = '$period' AND product_fee > 0";
                        $result = mysqli_query($mysqli, $findproducts);
                    }
                    else //If product fee is filtered to having no product fee.
                    {
                        $findproducts = "SELECT * FROM products 
                        WHERE ltv >= '$loantovalue' AND initial_period = '$period' AND product_fee IS NULL";
                        $result = mysqli_query($mysqli, $findproducts);
                    }
                }
            }
            else if($type == "Tracker" || $type == "Fixed") //If product type is filtered (to Tracker or Fixed).
            {
                if($period == "Unfiltered") //If product period is unfiltered.
                {
                    if($fee == "Unfiltered") //If product fee is unfiltered.
                    {
                        $findproducts = "SELECT * FROM products 
                        WHERE ltv >= '$loantovalue' AND product_type = '$type'";
                        $result = mysqli_query($mysqli, $findproducts);
                    }
                    else if($fee == "Product Fee") //If product fee is filtered to having a product fee.
                    {
                        $findproducts = "SELECT * FROM products 
                        WHERE ltv >= '$loantovalue' AND product_type = '$type' AND product_fee > 0";
                        $result = mysqli_query($mysqli, $findproducts);
                    }
                    else //If product fee is filtered to having no product fee.
                    {
                        $findproducts = "SELECT * FROM products 
                        WHERE ltv >= '$loantovalue' AND product_type = '$type' AND product_fee IS NULL";
                        $result = mysqli_query($mysqli, $findproducts);
                    }
                }
                else //If product type is filtered and product period is filtered.
                {
                    if($fee == "Unfiltered") //If product fee is unfiltered.
                    {
                        $findproducts = "SELECT * FROM products 
                        WHERE ltv >= '$loantovalue' AND product_type = '$type' AND initial_period = '$period'";
                        $result = mysqli_query($mysqli, $findproducts);
                    }
                    else if($fee == "Product Fee") //If product fee is filtered to having a product fee.
                    {
                        $findproducts = "SELECT * FROM products 
                        WHERE ltv >= '$loantovalue' AND product_type = '$type' AND initial_period = '$period' AND product_fee > 0";
                        $result = mysqli_query($mysqli, $findproducts);
                    }
                    else //If product fee is filtered to having no product fee.
                    {
                        $findproducts = "SELECT * FROM products 
                        WHERE ltv >= '$loantovalue' AND product_type = '$type' AND initial_period = '$period' AND product_fee IS NULL";
                        $result = mysqli_query($mysqli, $findproducts);
                    }
                }
            }

            else
            {
                $findproducts = "SELECT * FROM products 
                WHERE ltv >= '$loantovalue' AND product_type = '$type' AND initial_period = '$period'";
                $result = mysqli_query($mysqli, $findproducts);
            }
        }
        else
        {
            echo "Did not detect";
            $findproducts = "SELECT * FROM products 
            WHERE ltv >= '$loantovalue'";
            $result = mysqli_query($mysqli, $findproducts);
        }
    }
    else //The user has entered this page for the first time, without any values being entered.
    {
        $purpose = "Not Set";
        $price = "0.00";
        $deposit = "0.00";
        $term = "0";
        $depositpercent = 0;
        $loantovalue = 0;
    
        $i = 0;

        $type = "Unfiltered";
        $fee =  "Unfiltered";
        $period = "Unfiltered";
    
        $falsesearch = "SELECT * FROM products WHERE product_id = -1";
        $result = mysqli_query($mysqli, $falsesearch);
    }
}
else //User is NOT already logged in; page is inaccessible.
{
    header("Location: home.html");
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
    <script src="selectproduct.js" defer></script>
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
                            <th class="productsearch-header">Property Price</th>
                            <th class="productsearch-header">Deposit Amount</th>
                            <th class="productsearch-header">Term of Loan</th>
                            <th class="productsearch-header">Deposit %</th>
                            <th class="productsearch-header">Loan To Value %</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="productsearch-td">
                                    <input type="text" class="productsearch-field" name="price"
                                        placeholder="Value"></input>
                                </td>
                                <td class="productsearch-td">
                                    <input type="text" class="productsearch-field" name="deposit"
                                        placeholder="Deposit"></input>
                                </td>
                                <td class="productsearch-td">
                                    <input type="text" class="productsearch-field" name="term"
                                        placeholder="Term Length"></input>
                                </td>
                                <td class="productsearch-td">
                                    <span><?php echo $depositpercent ?></span>
                                </td>
                                <td class="productsearch-td">
                                    <span><?php echo $loantovalue ?></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="productsearch-forcedivide">
                        <button class="productsearch-button">View Results</button>
                    </div>
                </form>
                <p>Current search results for: Property Price: £<?php echo $price;?>, Deposit Amount: £<?php echo $deposit;?>, Mortgage Term: <?php echo $term;?> years. Calculated LTV is: <?php echo $loantovalue;?>%</p>
                <form action="filtersearch.php" method="post">
                    <table class="productsearch-filtertable">
                        <thead>
                            <th class="productsearch-header">Filter by Product Type</th>
                            <th class="productsearch-header">Filter by Product Fee</th>
                            <th class="productsearch-header">Filter by Product Period</th>
                        </thead>
                        <tbody>
                            <td>
                                <select class="productsearch-field" name="filter-type">
                                <option value="Unfiltered">Unfiltered</option>
                                <option value="Fixed">Fixed</option>
                                <option value="Tracker">Tracker</option>
                                </select>
                            </td>
                            <td>
                                <select class="productsearch-field" name="filter-fee">
                                <option value="Unfiltered">Unfiltered</option>
                                <option value="Product Fee">Includes Product Fee</option>
                                <option value="No Product Fee">No Product Fee</option>
                                </select>
                            </td>
                            <td>
                                <select class="productsearch-field" name="filter-period">
                                <option value="Unfiltered">Unfiltered</option>
                                <option value="1">1 Year</option>
                                <option value="2">2 Years</option>
                                <option value="3">3 Years</option>
                                <option value="4">4 Years</option>
                                <option value="5">5 Years</option>
                                </select>
                            </td>
                        </tbody>
                    </table>
                    <button class="productsearch-button">Filter Results</button>
                </form>
                <p>Current filter results for: Product Type: <?php echo $type;?>, Product Fee: <?php echo $fee;?>, Product Duration (Years): <?php echo $period;?>.</p>
            </div>
            <div class="productsearch-division">
                <div class="productsearch-resultarea">
                    <?php
                    while ($entry = mysqli_fetch_assoc($result)) 
                    {
                        $i = $i + 1;
                        ?>
                        <a class="productsearch-span" onclick="selectEntry(this)">
                        <form method="POST" action="saveasquote.php">
                            <div class="productsearch-result">
                                <div class ="productsearch-result-column">
                                    <p>Quote: </p>
                                    <p><?php echo $i; ?></p>
                                </div>
                                <input type="text" name="type" class="productsearch-title" value='<?php echo $entry['product_type']; ?>' readonly></input>
                                <div class ="productsearch-result-column">
                                    <p>Duration (Years):</p>
                                    <p><?php echo $entry['initial_period']; ?></p>
                                </div>
                                <div class ="productsearch-result-column">
                                    <p>Monthly Payment (£):</p>
                                    <?php
                                    $r = (($entry['interest_rate'] / 100) / 12);
                                    $p = $price - $deposit;
                                    $n = $entry['mortgage_term'] * 12;
                                    $monthly = ($p) * ($r * (pow(1 + $r, $n))) / (pow(1 + $r, $n) - 1);
                                    $monthly = number_format($monthly, 2);
                                    ?>
                                    <input type="text" name="monthly" class="productsearch-text" value='<?php echo $monthly; ?>' readonly></input>
                                </div>
                                <div class ="productsearch-result-column">
                                    <p>Initial Interest Rate (%):</p>
                                    <input type="text" name="interest" class="productsearch-text" value='<?php echo $entry['interest_rate']; ?>' readonly></input>
                                </div>
                                <div class ="productsearch-result-column">
                                    <p>Product Fee:</p>
                                    <input type="text" name="fee" class="productsearch-text" value='<?php echo $entry['product_fee']; ?>' readonly></input>
                                </div>
                                <div class ="productsearch-result-column">
                                    <p>Total Payable (£):</p>
                                    <?php
                                        $total = (($r * ($price - $deposit)) / (1 - pow(1 + $r, -$n))) * $n;
                                        $total = $total + $entry['product_fee'];
                                        $total = number_format($total, 2);
                                    ?>
                                    <input type="text" name="total" class="productsearch-text" value='<?php echo $total; ?>' readonly></input>
                                </div>
                                <div class ="productsearch-result-column">
                                    <input type="submit" name="savequote" class="productsearch-button" value="Save Quote"></input>
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