<?php

require_once 'login.php';

//set up the connection

$conn = new mysqli($host, $user, $pass, $db_name);
if($conn->connect_error) {
    die ($conn->connect_error);
} 


if (isset($_POST['delete']) && isset($_POST['isbn'])) {
    $isbn = get_post($conn, 'isbn');
    $query = "DELETE FROM classics WHERE isbn='$isbn'";
    $result = $conn->query($query);
    if (!$result) {
        echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
    }
}

if (isset($_POST['author']) && isset($_POST['title']) && isset($_POST['category']) && isset($_POST['year']) && isset($_POST['isbn'])) {
    $author = get_post($conn, 'author');
    $title = get_post($conn, 'title');
    $category = get_post($conn, 'category');
    $year = get_post($conn, 'year');
    $isbn = get_post($conn, 'isbn');
    $query = "INSERT INTO classics (author, title, category, year, isbn) VALUES ('$author', '$title', '$category', '$year', '$isbn')";
    $result = $conn->query($query);
    if (!$result) {
        echo "INSERT failed: $query<br>" .
        $conn->error . "<br><br>";

    }
}

echo '

<div style="margin-bottom:50px;"><form action="sqltest.php" method="post">
    
    <table>
        <tr><td>Author</td> <td><input type="text" name="author"></td></tr>
        <tr><td>Title</td> <td><input type="text" name="title"></td></tr>
        <tr><td>Category</td> <td><input type="text" name="category"></td></tr>
        <tr><td>Year</td> <td><input type="text" name="year"></td></tr>
        <tr><td>ISBN</td> <td><input type="text" name="isbn"></td></tr>
        <tr><td></td>   <td><input type="submit" value="ADD RECORD"></td></tr>
    </table>
        
</form></div>';


$query = "SELECT * FROM classics";
$result = $conn->query($query);
if(!$result) die ("Database access failed: " . $conn->error);

//fetching the database 

$rows = $result->num_rows;

for ($j=0; $j<$rows; ++$j) {
    $row = $result->fetch_array(MYSQLI_NUM);
    
    echo '
    
    <div style="margin-bottom:30px;">
        <table>
            <tr><td>Author</td> <td>' . $row[0] . '</td></tr>
            <tr><td>Title</td> <td>' . $row[1] . '</td></tr>
            <tr><td>Category</td> <td>' . $row[2] . '</td></tr>
            <tr><td>Year</td> <td>' . $row[3] . '</td></tr>
            <tr><td>ISBN</td> <td>' . $row[4] . '</td></tr>
            <tr><td>
                <form action="sqltest.php" method="post">
                    <input type="hidden" name="delete" value="yes">
                    <input type="hidden" name="isbn" value="'. $row[4] . '">
                    <input type="submit" value="DELETE RECORD">
                </form></td>
             </tr>
        </table>
    </div>
    
    ';
}

$result->close();
$conn->close();


function get_post($conn, $var) {
    return $conn->real_escape_string($_POST[$var]);
}



?>