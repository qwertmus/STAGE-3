<?php 
    session_start();
    include("includes/connect.php");

    if (isset($_POST['changedetails'])) {
        if ($_POST['contactnumber'] === $_POST['confirmnumber']) {
            $detailsQuery = "UPDATE users SET first_name = '{$_POST['firstname']}', middle_name = '{$_POST['middlename']}', surname = '{$_POST['surname']}', contact_number = {$_POST['contactnumber']}, email_address = '{$_POST['email']}', postcode = '{$_POST['postcode']}', income = {$_POST['income']}, employment_status = '{$_POST['employment']}', dob = '{$_POST['dateofbirth']}', credit_score = {$_POST['creditscore']} WHERE user_id = {$_SESSION['user_id']};";
            
            if ($mysqli->query($detailsQuery) === true) {
                echo "QUERY UPDATE SUCCESS!";
                header("Location: profile.php");

                $_SESSION['user_name'] = $_POST['firstname'] . " " . $_POST['middlename'] . " " . $_POST['surname'];
            }
        }
    } elseif (isset($_POST['changebrokerdetails'])) {
        $detailsQuery = "UPDATE brokers SET first_name = '{$_POST['firstname']}', middle_name = '{$_POST['middlename']}', surname = '{$_POST['surname']}', email_address = '{$_POST['email']}', dob = '{$_POST['dateofbirth']}' WHERE broker_id = {$_SESSION['user_id']};";
            
        if ($mysqli->query($detailsQuery) === true) {
            echo "QUERY UPDATE SUCCESS!";
            header("Location: broker-account.php");

            $_SESSION['user_name'] = $_POST['firstname'] . " " . $_POST['middlename'] . " " . $_POST['surname'];
        }
    }
?>
