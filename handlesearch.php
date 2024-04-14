<?php 

session_start();

include "includes/connect.php";

if (!empty($_POST['price']) && !empty($_POST['deposit']) && !empty($_POST['term'])) 
{
    if($_POST['price'] < $_POST['deposit'])
    {
        echo '<script type="text/javascript">'; 
        echo 'alert("Deposit cannot be greater than Price");';
        echo 'window.location.href = "productsearch.php";';
        echo '</script>';    
    }
    else
    {
        $_SESSION['price'] = $_POST['price'];
        $_SESSION['deposit'] = $_POST['deposit'];
        $_SESSION['term'] = $_POST['term'];
        mysqli_close($mysqli);
        header("Location: productsearch.php");
    }
}
else
{
    echo '<script type="text/javascript">'; 
    echo 'alert("Please enter all required fields.");';
    echo 'window.location.href = "productsearch.php";';
    echo '</script>';    
}