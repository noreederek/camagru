<?php
session_start();

if (isset($_GET['id-comment']) && $_GET['id-comment'] != NULL && is_numeric($_GET['id-comment']))
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT `id_comment` FROM `comments` WHERE `id_comment` LIKE :id_comment");
		$request->bindParam(':id_comment', $_GET['id-comment']);
		$request->execute();
		$result = $request->rowCount();
		if ($result == 0)
		{
			echo "<meta http-equiv='refresh' content='0,url=photo.php?id_photo=".$_SESSION['id_photo']."'>";
		}
		else {
			$request = $dbpdo->prepare("DELETE FROM `comments` WHERE `id_comment`= :id_comment");
			$request->bindParam(':id_comment', $_GET['id-comment']);
			$request->execute();
		}
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}
else {
	header('Location: photo.php?id_photo='.$_SESSION['id_photo']);
	exit();
}
	echo "<meta http-equiv='refresh' content='0,url=photo.php?id_photo=".$_SESSION['id_photo']."'>";

 ?>
