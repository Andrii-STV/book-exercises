<?php

require_once 'login.php';

$conn = new mysqli($host, $user, $pass, $db_name);
if ($conn->connect_error) die ($conn->connect_error);

$query = 'DESCRIBE cats';
$result = $conn->query($query);
if (!$result) die ($conn->error);

$rows = $result->num_rows;
echo "<table><tr><th>Column</th><th>Type</th><th>Null</th><th>Key</th></tr>";

for ($j = 0; $j < $rows; ++$j) {
    $row = $result->fetch_array(MYSQLI_NUM);
    echo '<tr>';
    for ($k = 0; $k < 4; ++$k) {
        echo '<td>'.$row[$k].'</td>';
    }
    echo '</tr>';

}

echo "</table>";





function clear_input($conn, $var) {
    return $conn->real_escape_string($_POST[$var]);
}

if (isset($_POST['family']) && isset($_POST['name']) && isset($_POST['age'])) {
    $family = clear_input($conn, 'family');
    $name = clear_input($conn, 'name');
    $age = clear_input($conn, 'age');
    $query = "INSERT INTO cats (family, name, age) VALUES ('$family', '$name', '$age')";
    $result = $conn->query($query);
    if (!$result) die ($conn->error);
}


echo '

<div style="margin-bottom:50px;"><form action="cats.php" method="post">
    
    <table>
        <tr><td>Family</td> <td><input type="text" name="family"></td></tr>
        <tr><td>Name</td> <td><input type="text" name="name"></td></tr>
        <tr><td>Age</td> <td><input type="text" name="age"></td></tr>
        <tr><td></td>   <td><input type="submit" value="ADD ANIMAL"></td></tr>
    </table>
        
</form></div>';

if (isset($_POST['delete']) && isset($_POST['id'])) {
    $id = clear_input($conn, 'id');
    $query = "DELETE FROM cats WHERE id='$id'";
    $result = $conn->query($query);
    if (!$result) {
        echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
    }
}

$query = "SELECT * FROM cats";
$result = $conn->query($query);
if(!$result) die ("Database access failed: " . $conn->error);

$rows = $result->num_rows;

for ($j=0; $j<$rows; ++$j) {
    $row = $result->fetch_array(MYSQLI_NUM);
    
    echo '
    
    <div style="margin:30px 0;">
        <table>
            <tr><td>ID</td> <td>' . $row[0] . '</td></tr>
            <tr><td>Family</td> <td>' . $row[1] . '</td></tr>
            <tr><td>Name</td> <td>' . $row[2] . '</td></tr>
            <tr><td>Age</td> <td>' . $row[3] . '</td></tr>
            <tr><td>
                <form action="cats.php" method="post">
                    <input type="hidden" name="delete" value="yes">
                    <input type="hidden" name="id" value="'. $row[0] . '">
                    <input type="submit" value="DELETE RECORD">
                </form></td>
                
             </tr>
            </table>
    </div>
    
    ';
}



$query = "SELECT * FROM cats";
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
    $rows = $result->num_rows;
    echo "<table><tr> <th>Id</th> <th>Family</th><th>Name</th><th>Age</th></tr>";
    for ($j = 0 ; $j < $rows; ++$j) {
        $row = $result->fetch_array(MYSQLI_NUM);
        echo "<tr>";
        for ($k = 0 ; $k < 4 ; ++$k) echo "<td>$row[$k]</td>";
        echo "</tr>";
    }
    echo "</table>";

$result->close();
$conn->close();

?>