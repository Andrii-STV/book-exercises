<?php

require_once 'login.php';

$conn = new mysqli ($host, $user, $pass, $db_name);
if ($conn->connect_error) die ($conn->connect_error);

if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
    $un_temp = mysql_entitites_fix_string($conn, $_SERVER['PHP_AUTH_USER']);
    $pw_temp = mysql_entitites_fix_string($conn, $_SERVER['PHP_AUTH_PW']);

    $query = 'SELECT * FROM users WHERE username="$un_temp"';
    $result = $conn->query($query);
    if (!$result) die ($conn->error);
    elseif ($result->num_rows) {
        $row = $result->fetch_array(MYSQLI_NUM);
        $result->close();
        $salt1 = "qm&h*";
        $salt2 = "pg!@";
        $token = hash('ripemd128', "$salt1$pw_temp$salt2");
        if ($token ==  $row[3]) echo "$row[0] $row[1]: Hi $row[0], you are now logged in as '$row[2]'";
        else die('Invalid username/paswword');
    } else {
        header('WWW-Authenticate: Basic realm="Restricted Section"');
        header('HTTP/1.0 401 Unauthorized');
        die ("Please enter your username and password");
    }
}

$conn->close();

function mysql_entitites_fix_string($conn, $string) {
    return htmlentities(mysql_fix_string($conn, $string));
}

function mysql_fix_string($conn, $string) {
    if (get_magic_quotes_gpc()) $string = stringsplashes($string);
    return $conn->real_escape_string($string);
}



?>