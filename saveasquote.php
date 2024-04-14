<?php

session_start();

include "includes/connect.php";

if(isset($_POST['savequote']))
{
    $userid = $_SESSION['user_id'];
    $type = $_POST['type'];
    $monthly = $_POST['monthly'];
    $interest = $_POST['interest'];
    $fee = $_POST['fee'];
    $total = validate($_POST['total']);

    $insertquote = "INSERT INTO quotes 
    (`user_id`, `mortgage_type`, `monthly_payment`, `interest_rate`, `product_fee`, `total_payable`) 
    VALUES ('$userid', '$type', '$monthly', '$interest', '$fee', '$total')";
    
    mysqli_query($mysqli, $insertquote);
    mysqli_close($mysqli);

    echo '<script type="text/javascript">'; 
    echo 'alert("Quote Saved");';
    echo 'window.location.href = "productsearch.php";';
    echo '</script>';
}
else 
{
    header("Location: productsearch.php?error=not all fields have been entered");
    exit();
}

function validate($data) //Strip out unwanted characters from input fields.
{
    $data = str_replace(',', '', $data);
    return $data;
}