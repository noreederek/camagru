<?php
require("database.php");

$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

$sql = file_get_contents('dump.sql');

$qr = $dbpdo->exec($sql);

header("Location:../index.php");
?>