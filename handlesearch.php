<?php 

session_start();

include "includes/connect.php";

if (!empty($_POST['purpose']) && !empty($_POST['price']) && !empty($_POST['deposit']) && !empty($_POST['term'])) 
{
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