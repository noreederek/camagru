<?php
session_start();

if (isset($_GET['id-photo']) && $_GET['id-photo'] != NULL && is_numeric($_GET['id-photo']))
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		if ($_SESSION['roles'] == 'admin')
		{
			$request = $dbpdo->prepare("SELECT `id_photo` FROM `photos` WHERE `id_photo` LIKE :id_photo");
			$request->bindParam(':id_photo', $_GET['id-photo']);
		}
		else {
			$request = $dbpdo->prepare("SELECT `id_photo` FROM `photos` WHERE `id_photo` LIKE :id_photo AND `id_user` = :id_user");
			$request->bindParam(':id_photo', $_GET['id-photo']);
			$request->bindParam(':id_user', $_SESSION['id']);
		}
		$request->execute();
		$result = $request->rowCount();
		if ($result == 0)
		{
			echo "<meta http-equiv='refresh' content='0,url=photo.php?id_photo=".$_SESSION['id_photo']."'>";
		}
		else {
			$request = $dbpdo->prepare("DELETE FROM `photos` WHERE `id_photo`= :id_photo");
			$request->bindParam(':id_photo', $_GET['id-photo']);
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
if ($_SESSION['roles'] == 'admin')
{
	echo "<meta http-equiv='refresh' content='0,url=../gallery/gallery.php'>";
}
else {
	echo "<meta http-equiv='refresh' content='0,url=../montage/montages-users.php?login=".$_SESSION['login']."'>";
}

 ?>
