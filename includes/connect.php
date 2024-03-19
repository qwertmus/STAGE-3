<?php 
    define("DB_SERVER", "127.0.0.1");
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", "");
    define("DB_NAME", "rose_mortgage");

    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($mysqli === false) {
        die("ERROR: Mysqli could not connect. " . $mysqli->connect_error);
    }
?>