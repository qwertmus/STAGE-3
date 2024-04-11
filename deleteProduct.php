<?php 
    session_start();
    include("includes/connect.php");

    if (isset($_POST['confirm'])) {
        $deletionQuery = "DELETE FROM products WHERE product_id = {$_POST['product_id']};";
        
        if ($mysqli->query($deletionQuery) === true) {
            echo "Deletion done";
        }
    }

    header("Location: broker-manageproduct.php");
?>
