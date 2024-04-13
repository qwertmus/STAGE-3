<?php
    include("includes/connect.php");



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $interest_rate = $_POST['interestrate'];
        $mortgage_term = $_POST['mortgageterm'];
        $lender = $_POST['lender'];
        $employement_status = $_POST['employmentstatuseligibility'];
        $itv = $_POST['ltv'];
        $product_type = $_POST['type'];
        $product_fee = $_POST['fee'];
        $initial_period = $_POST['monthlyrate'];
        $min_credit_score = $_POST['creditscore'];
        $min_age = $_POST['minage'];
        $max_age = $_POST['maxage'];

        $product_id_query = "SELECT max(product_id) AS 'product_id' FROM products";
            $product_id_result = $mysqli->query($product_id_query);
            if ($obj = $product_id_result->fetch_object()) {
                $new_product_id = $obj->product_id + 1;
            }

            $create_product_query = "INSERT INTO products VALUES('{$new_product_id}', '{$interest_rate}', '{$mortgage_term}', '{$lender}', '{$employement_status}', '{$itv}', '{$product_type}', '{$initial_period}','{$product_fee}',  '{$min_age}', '{$max_age}', '{$min_credit_score}');";
            $create_product_result = $mysqli->query($create_product_query);
            if ($create_product_result === true) {
                header("Location: broker-manageproduct.php");
                exit();
            }

    }
 

?>