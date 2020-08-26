<?php
session_start();

if ($_SESSION['click-like'] != "SUCCESS")
{
	echo "<meta http-equiv='refresh' content='0,url=../../index.php'>";
	exit();
}
else {
	include '../../functions/page-photo.php';
	$_SESSION['liked'] = check_if_already_liked($_SESSION['id_photo'], $_SESSION['id']);
	if ($_SESSION['liked'] == 0)
	{
		try{
			include '../../config/database.php';
			$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbpdo->query("USE camagru");
			$request = $dbpdo->prepare("INSERT INTO `likes` (`id_user`, `id_photo`)
			VALUES (:id_user, :id_photo);");
			$request->bindParam(':id_photo', $_SESSION['id_photo']);
			$request->bindParam(':id_user', $_SESSION['id']);
			$request->execute();
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}
}
?>
