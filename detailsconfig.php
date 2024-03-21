<?php
    include("includes/connect.php");

    function validate_changes($email, $contact_number, $confirm_number, $mysqli) {
        $query = "SELECT * FROM users WHERE email_address = '{$email}' AND password = '';";

        $result = $mysqli->query($query);

        if ($result->num_rows == 1) {     
            $row = $result->fetch_assoc();
            $full_name = $row['first_name'] . " " . $row['middle_name'] . " " . $row['surname'];
            $_SESSION['user_name'] = $full_name;
            return true;
        } else {
            return false;
        }
    }

    if(isset($_POST['changedetails'])) {
        $first_name = $_POST['firstname'];
        $middle_name = $_POST['middlename'];
        $surname = $_POST['surname'];
        $contact_number = $_POST['contactnumber'];
        $confirm_contact_number = $_POST['confirmnumber'];
        $email = $_POST['email'];
        $postcode = $_POST['postcode'];
        $income = $_POST['income'];
        $date_of_birth = $_POST['dateofbirth'];
        $credit_score = $_POST['creditscore'];
    }
?>