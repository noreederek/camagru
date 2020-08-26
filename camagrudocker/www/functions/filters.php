<?php
function	get_filters()
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT * FROM `filters`");
		$request->execute();
		$data = $request->fetchAll(PDO::FETCH_ASSOC);
		return ($data);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}
 ?>
