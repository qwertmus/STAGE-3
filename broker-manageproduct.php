<?php 
  session_start();
  include("includes/connect.php");

  $hasSearched = false;
  $searchType = "None";
  $searchText = null;
  if (isset($_POST['search'])) {
    $hasSearched = true;
    $searchType = $_POST['type'];
    $searchText = $_POST['searchproduct'];
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
    <script src="productDeleteConfirmation.js"></script>
</head>

<body>

<!-- header starts -->
<header>

  <div class="logo">
    <h1 class="logo-text"><span>Rose</span>Mortgage</h1>
  </div>

  <ul class="navbar">
    <li><a href="broker-account.php">Account</a></li>
    <li><a href="broker-createproduct.html">Create Product</a></li>
    <li>
      <a href="#">
        <i class="user"></i>
        <?php echo $_SESSION['user_name']; ?>
        <i class="dropdown"></i>
      </a>

      <ul>
        <li><a href="broker-account.php">My Profile</a></li>
        <li><a href="login.php" class="logout">Logout</a></li>
      </ul>

    </li>
  </ul>

</header>

<!-- header ends -->

<div class="main-container">

<div class="inner-container">
<div class="banner">
  <div class="banner-text">
      <h5>Welcome To</h5>
      <h1>Rose Mortgage</h1>
  </div>
</div>

<form class="homeform" action="broker-manageproduct.php" method="post">
<h4>Mortgage Products</h4>
<div class="input-group">
  <label for="sortby">Sort by interest rate:</label>
    <select class="control" name="type">
      <option value="None">None</option>
      <option value="High-Low">High-Low</option>
      <option value="Low-High">Low-High</option>
    </select>
  </div>
<div class="affordability-container">
  <div class="input-group">
    <label for="searchproduct">Lender: </label>
    <input class="control" type="text" name="searchproduct" placeholder="Lender">
    <button name="search">Search</button>
  </div>
</div>
</form>

<div class="productTable">
  <?php 
    if ($hasSearched === true) {
      $searchQuery = "SELECT * FROM products";
      $countQuery = "SELECT count(product_id) AS 'results' FROM products";

      if ($searchText != null) { 
        $searchQuery = $searchQuery . " WHERE lender LIKE '%{$searchText}%'";
        $countQuery = $countQuery . " WHERE lender LIKE '%{$searchText}%'";
      }

      if ($searchType == "High-Low") { 
        $searchQuery = $searchQuery . " ORDER BY interest_rate DESC";
        $countQuery = $countQuery . " ORDER BY interest_rate DESC";
      } elseif ($searchType == "Low-High") { 
        $searchQuery = $searchQuery . " ORDER BY interest_rate ASC";
        $countQuery = $countQuery . " ORDER BY interest_rate ASC";
      }

      $searchQuery = $searchQuery . ";";
      $countQuery = $countQuery . ";";
      $countResult = $mysqli->query($countQuery);

      $count = 0;
      while ($obj = $countResult->fetch_object()) {
        $count = $obj->results;
      }

      if ($count != 0) {
        $searchResult = $mysqli->query($searchQuery);

        echo "<table>";
        echo "<tr>";
        echo "<th>Interest rate</th>";
        echo "<th>Mortgage term</th>";
        echo "<th>Lender</th>";
        echo "<th>Employment Status</th>";
        echo "<th>LTV</th>";
        echo "<th>Product Type</th>";
        echo "<th>Product Fee</th>";
        echo "<th>Initial Period</th>"; // Changed column header
        echo "<th>Mininum Age</th>";
        echo "<th>Maximum Age</th>";
        echo "<th>Mininum Credit Score</th>";
        echo "</tr>";
        while ($obj = $searchResult->fetch_object()) {
            echo "<tr>";
            echo "<td>{$obj->interest_rate}</td>";
            echo "<td>{$obj->mortgage_term}</td>";
            echo "<td>{$obj->lender}</td>";
            echo "<td>{$obj->employment_status}</td>";
            echo "<td>{$obj->ltv}</td>";
            echo "<td>{$obj->product_type}</td>";
            echo "<td>{$obj->product_fee}</td>";
            echo "<td>{$obj->initial_period}</td>"; // Changed column data
            echo "<td>{$obj->min_age}</td>";
            echo "<td>{$obj->max_age}</td>";
            echo "<td>{$obj->min_credit_score}</td>";
            echo "<td id='{$obj->product_id}' style='cursor: pointer; color: #CC0000;' onclick='ConfirmDeletion(this);'>Delete</td>";
            echo "</tr>";
        }
        echo "</table>";
        } else {
        echo "<p>No results found</p>";
        }
        }
        ?>
</div>

<form id="confirmation" action="deleteProduct.php" method="post" hidden>
  <h3>Are you sure?</h3>
  <input type="number" name="product_id" hidden>

  <button name="confirm">Yes</button>
  <button>No</button>
</form>
</div>
