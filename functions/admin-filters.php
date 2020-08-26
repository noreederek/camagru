<?php
session_start();

function	get_list_filters()
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT `id_filter`, `path_filter` FROM `filters`");
		$request->execute();
		$code = $request->fetchAll(PDO::FETCH_ASSOC);
		return ($code);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	suppress_filter($id)
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");

		$request = $dbpdo->prepare("SELECT `id_filter`, `path_filter` FROM `filters`");
		$request->execute();
		$result = $request->rowCount();

		if ($result > 5)
		{
			$request = $dbpdo->prepare("DELETE FROM `filters` WHERE `id_filter`= :id_filter");
			$request->bindParam(':id_filter', $id);
			$request->execute();
		}
		else {
			$_SESSION['error-delete-filter'] = "FAIL";
		}
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	add_filter($filter)
{
	$path = "img/filtres/".$filter.".png";
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("INSERT INTO `filters` (`path_filter`)
		VALUES(:path_filter)");
		$request->bindParam(':path_filter', $path);
		$request->execute();

	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	check_if_filter_exists($filter)
{
	try{
		$name = "img/filtres/".$filter.".png";
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT * FROM `filters` WHERE `path_filter` LIKE :name");
		$request->bindParam(':name', $name);
		$request->execute();
		$result = $request->rowCount();
		return ($result);

	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	check_if_id_filter_exists($filter)
{
	try{
		$name = "img/filtres/".$filter.".png";
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT * FROM `filters` WHERE `id_filter` LIKE :filter");
		$request->bindParam(':filter', $filter);
		$request->execute();
		$result = $request->rowCount();
		return ($result);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

?>
