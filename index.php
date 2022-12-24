<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php


//connecting files here//

require_once 'login.php';

// ----- ------//


// Old exercises go here

/*$products = array(
    'paper' => array(
    'copier' => "Copier & Multipurpose",
    'inkjet' => "Inkjet Printer",
    'laser' => "Laser Printer",
    'photo' => "Photographic Paper"),
    'pens' => array(
    'ball' => "Ball Point",
    'hilite' => "Highlighters",
    'marker' => "Markers"),
    'misc' => array(
    'tape' => "Sticky Tape",
    'glue' => "Adhesives",
    'clips' => "Paperclips"
    )
    );
    echo "<pre>";
    foreach($products as $section => $items)
    foreach($items as $key => $value)
    echo "$section:\t$key\t($value)<br>";
    echo "</pre>";

//DONT DELETE THIS - It shows how to covert RGB color to #AA5567 
    printf("<span style='color:#%X%X%X'>Hello</span>", 65, 127, 245);


 $cmd = "dir";
 exec(escapeshellcmd($cmd), $output, $status);

 if($status) {
    echo "Exec command failed";
 } else {
    echo "<pre>";
    foreach($output as $line) {
        echo htmlspecialchars("$line\n");
    }
    echo "</pre>";  
 }
*/
// /////// //

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) die($conn->connect_error);

$query = "SELECT * FROM classics";
$result = $conn->query($query);
if (!$result) die($conn->error);

$rows = $result->num_rows;

for ($j=0; $j<$rows; ++$j) {

    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    
    echo 'Author: ' . $row['author'] . '<br>';
    echo 'Title: ' . $row['title'] . '<br>';
    echo 'Category: ' . $row['category'] . '<br>';
    echo 'ISBN: ' . $row['isbn'] . '<br><br>';
}


?>

    
</body>
</html>

