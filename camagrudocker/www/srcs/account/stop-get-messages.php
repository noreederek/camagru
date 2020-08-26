<?php
session_start();
if ($_POST['stopsend'] == "Stop Send Messages")
	{
		try{
			include '../../config/database.php';
			$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbpdo->query("USE camagru");
            $request = $dbpdo->prepare("UPDATE `persons` SET `comgetflag`='stopsend' WHERE `login`= :login");
            $request->bindParam(':login', $_SESSION['login']);
            $request->execute();
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
		$_SESSION['comgetflag'] = "stopsend";
		header('Location: my-account.php');
		exit();
	}
	else {
		header('Location: my-account.php');
		exit();
	}
?>