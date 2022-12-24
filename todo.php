<?php
require_once 'login.php';


//creating connection to DB
$conn = new mysqli($host, $user, $pass, $db_name);
if ($conn->connect_error) die ($conn->connect_error);

function clear_input ($conn, $var) {
    return $conn->real_escape_string($_POST[$var]);
}


if (isset($_POST['isbn']) && isset($_POST['author']) && isset($_POST['title'])) {
    $isbn = clear_input($conn, 'isbn');
    $author = clear_input($conn, 'author');
    $title = clear_input($conn, 'title');
    $query = "INSERT INTO classics (isbn, author, title) VALUES ('$isbn', '$author', '$title')";
    $result = $conn->query($query);
    if (!$result) die ($conn->error);
}

if (isset($_POST['isbn']) && isset($_POST['delete'])) {
    $isbn = clear_input($conn, 'isbn');
    $query = "DELETE FROM classics WHERE isbn = '$isbn'";
    $result = $conn->query($query);
    if (!$result) {
        echo 'Deleting error:' . $conn->error;
    } 
}

echo '<form action="todo.php" method="post">
        <input type="text" name="isbn">
        <input type="text" name="author">
        <input type="text" name="title">
        <input type="submit" value="Add Record">  

    </form>

';


$query = 'SELECT * FROM classics';
$result = $conn->query($query);
if(!$result) die ('Database acces failed: '. $conn->error);

$rows = $result->num_rows;

for ($j = 0; $j < $rows; ++$j) {
    $row = $result->fetch_array(MYSQLI_NUM);
    echo '<table>
        <tr><td>ISBN</td><td>'.$row[4].'</td></tr>
        <tr><td>Author</td><td>'.$row[0].'</td></tr>
        <tr><td>Title</td><td>'.$row[1].'</td></tr>
        <tr><td><form action="todo.php" method="post">
                    <input type="hidden" name="delete" value="yes">
                    <input type="hidden" name="isbn" value="'.$row[4].'">
                    <input type="submit" value="Delete Record">
                </form></td><td></td></tr>
    </table>';
}

$result->close();
$conn->close();





?>