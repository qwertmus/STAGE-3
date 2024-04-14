<?php

session_start();

include "includes/connect.php";

if(isset($_POST['savequote']))
{
    $userid = $_SESSION['user_id'];
    $type = $_POST['type'];
    $monthly = validate($_POST['monthly']);
    $interest = $_POST['interest'];
    $fee = validate($_POST['fee']);
    $total = validate($_POST['total']);

    $check = "SELECT user_id, mortgage_type, monthly_payment, total_payable FROM quotes 
    WHERE user_id = '$userid' AND mortgage_type = '$type' AND monthly_payment = '$monthly' 
    AND total_payable = '$total'";
    
    $result = mysqli_query($mysqli, $check);

    $returnedresults = mysqli_num_rows($result);

    if($returnedresults==0) // If there are no results, meaning the record doesn't already exist.
    {
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
    else //This would be a duplicate record, already saved to quotes. Don't save it.
    {
        echo '<script type="text/javascript">'; 
        echo 'alert("Quote is already saved. Cannot save again.");';
        echo 'window.location.href = "productsearch.php";';
        echo '</script>';
    }
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