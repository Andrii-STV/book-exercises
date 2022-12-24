<?php


//variables fro connection

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'publications';


//creating connection


$conn = new mysqli($host, $user, $pass, $db_name);
if ($conn->connect_error) die ($conn->connect_error);


//querying

$query = 'SELECT * FROM classics';
$result = $conn->query($query);

if(!$result) die ($conn->error);


//fetching data using assoc array

$rows = $result->num_rows;

for ($j=0; $j<$rows; ++$j) {
    $row = $result->fetch_array(MYSQLI_ASSOC);

    echo 'Author: ' . $row['author'] . '<br>';
    echo 'Title: ' . $row['title'] . '<br>';
    echo 'And so on...' . '<br><br>';
}

$result->close();
$conn->close();


?>