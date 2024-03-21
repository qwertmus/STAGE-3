<?php

session_start();

define("DB_SERVER", "127.0.0.1");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "rose_mortgage");

$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($mysqli->connect_error) {
    die("ERROR: Mysqli could not connect. " . $mysqli->connect_error);
}

function validate_login($email, $password, $mysqli) {
    $email = $mysqli->real_escape_string($email);
    $password = $mysqli->real_escape_string($password);

    $query = "SELECT * FROM users WHERE email_address = '$email' AND password = '$password'";

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (validate_login($email, $password, $mysqli)) {
        header("Location: UserMainPage.php");
        exit();
    } else {
        echo "Invalid email or password.";
    }
}

$mysqli->close();

?>