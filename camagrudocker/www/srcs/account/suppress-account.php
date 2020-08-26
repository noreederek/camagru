<?php
session_start();
if ($_SESSION['wish-to-suppress-account'] != "SUCCESS")
{
	$_SESSION['wish-to-suppress-account'] = "SUCCESS";
	echo "<meta http-equiv='refresh' content='0,url=my-account.php'>";
	exit();
}
else {
	if ($_POST['yes'] == "Yes")
	{
		try{
			include '../../config/database.php';
			$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbpdo->query("USE camagru");

			$request = $dbpdo->prepare("DELETE FROM `comments` WHERE `id_user`= :id_user");
			$request->bindParam(':id_user', $_SESSION['id']);
			$request->execute();

			$request = $dbpdo->prepare("DELETE FROM `likes` WHERE `id_user`= :id_user");
			$request->bindParam(':id_user', $_SESSION['id']);
			$request->execute();

			$request = $dbpdo->prepare("DELETE FROM `photos` WHERE `id_user`= :id_user");
			$request->bindParam(':id_user', $_SESSION['id']);
			$request->execute();

			$request = $dbpdo->prepare("DELETE FROM `persons` WHERE `mail`= :mail");
			$request->bindParam(':mail', $_SESSION['mail']);
			$request->execute();
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
		$_SESSION['session-destroy'] = "SUCCESS";
		header('Location: my-account.php');
		exit();
	}
	else if ($_POST['no'] == "No")
	{
		$_SESSION['wish-to-suppress-account'] = NULL;
		header('Location: my-account.php');
		exit();
	}
	else {
		header('Location: my-account.php');
		exit();
	}
}
?>
