<?php 

session_start();

if (!empty($_POST['filter-type']) && !empty($_POST['filter-fee']) && !empty($_POST['filter-period'])) 
{
    $_SESSION['type'] = $_POST['filter-type'];
    $_SESSION['fee'] = $_POST['filter-fee'];
    $_SESSION['duration'] = $_POST['filter-period'];

    header("Location: productsearch.php");
}
else
{
    header("Location: productsearch.php?Please enter all required filters");
}