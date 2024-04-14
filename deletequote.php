<?php

session_start();

include "includes/connect.php";

if(isset($_POST['deletequote']))
{
    $userid = $_SESSION['user_id'];
    $quoteid = $_POST['quoteid'];
    
    $deletequote = "DELETE FROM quotes WHERE quote_id = '$quoteid'";
        
    mysqli_query($mysqli, $deletequote);
    mysqli_close($mysqli);
    
    echo '<script type="text/javascript">'; 
    echo 'alert("Quote Deleted");';
    echo 'window.location.href = "viewsavedquotes.php";';
    echo '</script>';
}
else 
{
    header("Location: viewsavedquotes.php");
    exit();
}