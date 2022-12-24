<?php

$var = $_POST['name'];

function sinitizeString() {
    $var = stripslashes($var);
    $var = strip_tags($var);
    $var =  htmlentities($var);
    return $var;
}

function sinitizeMySQL($conn, $var) {
    $var = $conn->real_escape_string($var);
    $var = sinitizeString($var);
    return $var;
}


?>