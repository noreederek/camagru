<?php

function	get_nb_users()
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT * FROM `persons` WHERE `login` != 'admin'");
		$request->execute();
		$result = $request->rowCount();
		return ($result);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_nb_photos()
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT * FROM `photos`");
		$request->execute();
		$result = $request->rowCount();
		return ($result);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_nb_comments()
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT * FROM `comments`");
		$request->execute();
		$result = $request->rowCount();
		return ($result);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_nb_like()
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT * FROM `likes`");
		$request->execute();
		$result = $request->rowCount();
		return ($result);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_most_liked_user()
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT `persons`.`login`, COUNT(*) as `nb_likes`
		FROM `persons`
		INNER JOIN `photos` ON `photos`.`id_user` = `persons`.`id`
		INNER JOIN `likes` ON `likes`.`id_photo` = `photos`.`id_photo`
		GROUP BY `persons`.`id`
		ORDER BY `nb_likes` DESC");
		$request->execute();
		$result = $request->fetchAll(PDO::FETCH_ASSOC);
		return ($result);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}


function	get_most_commented_user()
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT `persons`.`login`, COUNT(*) as `nb_comments`
		FROM `persons`
		INNER JOIN `photos` ON `photos`.`id_user` = `persons`.`id`
		INNER JOIN `comments` ON `comments`.`id_photo` = `photos`.`id_photo`
		GROUP BY `persons`.`id`
		ORDER BY `nb_comments` DESC");
		$request->execute();
		$result = $request->fetchAll(PDO::FETCH_ASSOC);
		return ($result);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_most_photo_user()
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT `persons`.`login`, COUNT(*) as `nb_photos`
		FROM `persons`
		INNER JOIN `photos` ON `photos`.`id_user` = `persons`.`id`
		GROUP BY `persons`.`id`
		ORDER BY `nb_photos` DESC");
		$request->execute();
		$result = $request->fetchAll(PDO::FETCH_ASSOC);
		return ($result);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}


function	get_most_liked_photo()
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT `photos`.`id_photo`, COUNT(*) as `nb_likes_photo`
		FROM `photos`
		INNER JOIN `likes` ON `likes`.`id_photo` = `photos`.`id_photo`
		GROUP BY `photos`.`id_photo`
		ORDER BY `nb_likes_photo` DESC");
		$request->execute();
		$result = $request->fetchAll(PDO::FETCH_ASSOC);
		return ($result);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_most_commented_photo()
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT `photos`.`id_photo`, COUNT(*) as `nb_comments_photo`
		FROM `photos`
		INNER JOIN `comments` ON `comments`.`id_photo` = `photos`.`id_photo`
		GROUP BY `photos`.`id_photo`
		ORDER BY `nb_comments_photo` DESC");
		$request->execute();
		$result = $request->fetchAll(PDO::FETCH_ASSOC);
		return ($result);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

 ?>
