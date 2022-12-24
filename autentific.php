<?php 

$user = 'Andrew';
$pass = 'qwe456';

if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
    if (isset($_SERVER['PHP_AUTH_USER']) == $user && isset($_SERVER['PHP_AUTH_PW']) == $pass) {
        echo "You're now logged in!";
    } else {
        die ('Invalid username/password');
    }
} else {
    header('WWW-Authenticate: Basic realm="Restricted Section"');
    header('HTTP/1.0 401 Unauthorized');
    die ('Please enter yorur unsername and password');
}


?>