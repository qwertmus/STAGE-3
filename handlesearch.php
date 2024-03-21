<?php 
session_start();

include "includes/connect.php";

if (isset($_POST['purpose']) && isset($_POST['price']) && isset($_POST['deposit']) && isset($_POST['term'])) 
{
    //The if statement needs re-evaluated as it always fires true; must be because of the placeholder values.
    $_SESSION['purpose'] = $_POST['purpose'];
    $_SESSION['price'] = $_POST['price'];
    $_SESSION['deposit'] = $_POST['deposit'];
    $_SESSION['term'] = $_POST['term'];
    mysqli_close($mysqli);
    header("Location: productsearch.php");
}
else
{
    header("Location: productsearch.php?Please enter all required fields");
}