<?php
echo"<pre>\n";
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc','ayush','abc');
$pdo->setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
?>
