<?php 
    include("includes/connect.php");

    function validate_register($email, $user_password, $confirm_password, $mysqli) {
        if ($user_password != $confirm_password) { return false; }

        $register_query = "SELECT email_address FROM users WHERE email_address = '{$email}';";
        $register_result = $mysqli->query($register_query);
        if ($obj = $register_result->fetch_object()) {
            if ($obj->email_address === $email) { return false; }
        }

        return true;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = $_POST['firstname'];
        $middle_name = $_POST['middlename'];
        $surname = $_POST['surname'];
        $get_email = $_POST['email'];
        $get_password = $_POST['userpassword'];
        $get_confirm_password = $_POST['cpassword'];

        if (validate_register($get_email, $get_password, $get_confirm_password, $mysqli) === true) {
            $user_id_query = "SELECT max(user_id) AS 'user_id' FROM users";
            $user_id_result = $mysqli->query($user_id_query);
            if ($obj = $user_id_result->fetch_object()) {
                $new_user_id = $obj->user_id + 1;
            }

            // Due to the fact that there isn't enough input fields for the sql statement, i'll be inserting some placeholder info, this will be changed later
            $create_user_query = "INSERT INTO users VALUES('{$new_user_id}', '{$first_name}', '{$middle_name}', '{$surname}', '{$get_email}', '1970-01-01', 'empty', '{$get_password}', '00000000000', '000', '000000', 'empty');";
            $create_user_result = $mysqli->query($create_user_query);
            if ($create_user_result === true) {
                header("Location: login.php");
                exit();
            }
        }
        else {
            echo "Invalid registration details.";
            exit();
        }
    }
?>