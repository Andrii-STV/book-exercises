<?php 

require_once 'login.php';

$conn = new mysqli ($host, $user, $pass, $db_name);
if($conn->connect_error) die ($conn->connect_error);
/*
$query = 'CREATE TABLE users (
    firstname VARCHAR (32) NOT NULL,
    surname VARCHAR (32) NOT NULL,
    username VARCHAR (32) NOT NULL UNIQUE,
    pass VARCHAR (32) NOT NULL
)';
$result = $conn->query($query);
if (!$result) die ($conn->error);
*/
$salt1 = 'qm&h*';
$salt2 = 'pg!@';

/*
$firstname = 'Andrii';
$surname = 'Stavnichenko';
$username = 'astavni';
$pass = 'qwe456';
$token = hash('ripemd128', '$salt1$pass$salt2');

add_user($conn, $firstname, $surname, $username, $pass, $token);
*/
$firstname = 'Denis';
$surname = 'Stavnichenko';
$username = 'dstavni';
$pass = 'qwe456';
$token = hash('ripemd128', '$salt1$pass$salt2');

add_user($conn, $firstname, $surname, $username, $pass, $token);


function add_user($conn, $fn, $sn, $un, $pw) {
    $query = "INSERT INTO users VALUES ('$fn', '$sn', '$un', '$pw')";
    $result = $conn->query($query);
    if (!$result) die ($conn->error);
}
 

?>
