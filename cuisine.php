<?php // convert.php
 $ml = $tableSpoon = $teaSpoon = '';
 if (isset($_POST['ml'])) $ml = sanitizeString($_POST['ml']);
 if (isset($_POST['tableSpoon'])) $tableSpoon = sanitizeString($_POST['tableSpoon']);
 if (isset($_POST['teaSpoon'])) $teaSpoon = sanitizeString($_POST['teaSpoon']);
 if ($ml != '')
 {
 $tableSpoon = $ml/18;
 $teaSpoon = $ml/12;
 $out = "В $ml мл $tableSpoon столовых ложек<br>В $ml мл $teaSpoon чайных ложек";
 }
 elseif($tableSpoon != '')
 {
$ml = $tableSpoon*18;
$teaSpoon = 18*$tableSpoon/12;
 $out = "В $tableSpoon столовых ложках $ml мл<br> В $tableSpoon столовых ложках $teaSpoon чайных ложек";
 }
 elseif($teaSpoon != '')
 {
$ml = $teaSpoon*12;
$tableSpoon = 12*$teaSpoon/18;
 $out = "В $teaSpoon чайных ложках $ml мл<br> В $teaSpoon чайных ложках $tableSpoon столовых ложек";
 }
 else $out = "";
 echo <<<_END
<html>
 <head>
 <title>Кухонный конвертер</title>
 </head>
 <body>
 <pre>
 Введи милиллитры, столовые или чайные ложки
 <b>$out</b>
 <form method="post" action="cuisine.php">
 Миллилитры <input type="text" name="ml" size="7">
 Столовые ложки <input type="text" name="tableSpoon" size="7">
 Чайные ложки <input type="text" name="teaSpoon" size="7">
 <input type="submit" value="Convert">
 </form>
 </pre>
 </body>
</html>
_END;
 function sanitizeString($var)
 {
 $var = stripslashes($var);
 $var = strip_tags($var);
 $var = htmlentities($var);
 return $var;
 }
?>