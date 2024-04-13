<?php

include "includes/connect.php";

session_start();

if (isset($_SESSION['purpose']))//This should fire true if the user entered the fields and was redirected here successfully.
{

    $purpose = validate($_SESSION['purpose']);
    $price = floatval($_SESSION['price']);
    $deposit = intval($_SESSION['deposit']);
    $term = $_SESSION['term'];

    $depositpercent = ($deposit / $price) * 100;
    $loantovalue = 100 - $depositpercent;

    $i = 0;

    if(isset($_POST['filter-type']) && $_POST['filter-type'] != "Filter by Product Type" 
    && isset($_POST['filter-fee']) && $_POST['filter-fee'] != "Includes Product Fee"
    && isset($_POST['filter-period']) && $_POST['filter-period'] != "Filter by Initial Period" )
    {
        $type = $_POST['filter-type'];
        $fee = $_POST['filter-fee'];
        $period = $_POST['filter-period'];

        $findproducts = "SELECT * FROM products 
        WHERE ltv >= '$loantovalue' AND product_type = '$type'";
        $result = mysqli_query($mysqli, $findproducts);
    }
    else
    {
        $findproducts = "SELECT * FROM products 
        WHERE ltv >= '$loantovalue'";
        $result = mysqli_query($mysqli, $findproducts);
    }
} else //The user has entered this page for the first time, without any values being entered.
{

    $purpose = "Not Set";
    $price = "0.00";
    $deposit = "0.00";
    $term = "0";
    $depositpercent = 0;
    $loantovalue = 0;

    $i = 0;

    $falsesearch = "SELECT * FROM products WHERE product_id = -1";
    $result = mysqli_query($mysqli, $falsesearch);
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
                    <div>
                        <button class="productsearch-button">View Results</button>
                    </div>
                </form>
                <form action="handlesearch.php" method="post">
                    <div>
                        <select class="productsearch-field" name="filter-type">
                            <option value="">Filter by Product Type</option>
                            <option value="Fixed">Fixed</option>
                            <option value="Tracker">Tracker</option>
                        </select>
                        <select class="productsearch-field" name="filter-fee">
                            <option value="">Filter by Product Fee</option>
                            <option value="Product Fee">Includes Product Fee</option>
                            <option value="No Product Fee">No Product Fee</option>
                        </select>
                        <select class="productsearch-field" name="filter-period">
                            <option value="">Filter by Initial Period</option>
                            <option value="1">1 Year</option>
                            <option value="2">2 Years</option>
                            <option value="3">3 Years</option>
                            <option value="4">4 Years</option>
                            <option value="5">5 Years</option>
                        </select>
                        <button class="productsearch-button">Filter Results</button>
                    </div>
                </form>
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
                                <div>
                                    <p>Quote: </p>
                                    <p><?php echo $i; ?></p>
                                </div>
                                <input type="text" name="type" class="productsearch-title" value='<?php echo $entry['product_type']; ?>' readonly></input>
                                <div>
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
                                <div>
                                    <p>Initial Interest Rate (%):</p>
                                    <input type="text" name="interest" class="productsearch-text" value='<?php echo $entry['interest_rate']; ?>' readonly></input>
                                </div>
                                <div>
                                    <p>Product Fee:</p>
                                    <input type="text" name="fee" class="productsearch-text" value='<?php echo $entry['product_fee']; ?>' readonly></input>
                                </div>
                                <div>
                                    <p>Total Payable (£):</p>
                                    <?php
                                        $total = (($r * ($price - $deposit)) / (1 - pow(1 + $r, -$n))) * $n;
                                        $total = $total + $entry['product_fee'];
                                        $total = number_format($total, 2);
                                    ?>
                                    <input type="text" name="total" class="productsearch-text" value='<?php echo $total; ?>' readonly></input>
                                </div>
                                <div>
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