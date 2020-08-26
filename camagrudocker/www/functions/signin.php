<?php

function signin_check_password($mail, $password)
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT * FROM `persons` WHERE `mail` LIKE :mail");
		$request->bindParam(':mail', $mail);
		$request->execute();
		$code = $request->fetch(PDO::FETCH_ASSOC);
		if (in_array($password, $code) == TRUE)
		{
			$_SESSION['signin-good-password'] = "SUCCESS";
			return ($code);
		}
		else {
			$_SESSION['signin-good-password'] = "FAIL";
		}
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function connection_check_activationstatus($mail){
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT * FROM `persons` WHERE `mail`= :mail");
		$request->bindParam(':mail', $mail);
		$request->execute();
		$code = $request->fetch(PDO::FETCH_ASSOC);
		if ($code['activationstatus'] == 'activated')
		{
			$_SESSION['account-active'] = "SUCCESS";
			return (TRUE);
		}
		elseif ($code['activationstatus'] == 'notactivated')
		{
			$_SESSION['account-active'] = "FAIL";
			return (FALSE);
		}
		else
		{
			return (FALSE);
		}
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function send_reinit_password_mail($token, $mail, $submit)
{
	$name = "Camagru";
	$message = "Hello!" . ",\r\n\r\n" .
	"You want to restore your password?\r\n\r\n" .
	"Please go to this link : \r\n\r\n" .
	"<a href='http://". $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/srcs/reset-password/reset-my-password.php?token=".$token."'>LINK HERE</a> \r\n\r\n" .
	"Don't forget your password again please!";
	$from = 'From: Camagru';
	$to = $mail;
	$subject = mb_encode_mimeheader('Restore password camagru', "UTF-8");
	$body = "From: $name\r\nTo: $to\r\nMessage:\r\n\r\n$message";
	if ($submit)
	{
		if (mail ($to, $subject, $body, $from) == FALSE)
		{
			die();
		}
	}
}

function	get_nb_likes_user($id)
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT `photos`.`link`, `photos`.`id_user` AS `Uploader`, `likes`.`id_photo` AS `id_photo`
			FROM `likes`
			INNER JOIN `photos` ON `photos`.`id_photo` = `likes`.`id_photo`
			WHERE `photos`.`id_user` = :id
			ORDER BY `likes`.`id_photo` ASC");
			$request->bindParam(':id', $id);
			$request->execute();
			$result = $request->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	get_most_liked_picture($id)
	{
		try{
			include '../../config/database.php';
			$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbpdo->query("USE camagru");
			$request = $dbpdo->prepare("SELECT `photos`.`id_photo`, `photos`.`link`, COUNT(*) as `nb_likes`
			FROM `likes`
			INNER JOIN `photos` ON `photos`.`id_photo` = `likes`.`id_photo`
			WHERE `photos`.`id_user` = :id
			GROUP BY `photos`.`id_photo`
			ORDER BY `nb_likes` DESC");
			$request->bindParam(':id', $id);
			$request->execute();
			$result = $request->fetchAll(PDO::FETCH_ASSOC);
			return ($result);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}


	}

	function	get_nb_comments_user($id)
	{
		try{
			include '../../config/database.php';
			$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbpdo->query("USE camagru");
			$request = $dbpdo->prepare("SELECT `photos`.`link`, `photos`.`id_user` AS `Uploader`, `comments`.`id_photo` AS `id_photo`
				FROM `comments`
				INNER JOIN `photos` ON `photos`.`id_photo` = `comments`.`id_photo`
				WHERE `photos`.`id_user` = :id
				ORDER BY `comments`.`id_photo` ASC");
				$request->bindParam(':id', $id);
				$request->execute();
				$result = $request->rowCount();
				return ($result);
			}
			catch (PDOException $e) {
				print "Error : ".$e->getMessage()."<br/>";
				die();
			}
		}

		function	get_most_commented_picture($id)
		{
			try{
				include '../../config/database.php';
				$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
				$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$dbpdo->query("USE camagru");
				$request = $dbpdo->prepare("SELECT `photos`.`id_photo`, `photos`.`link`, COUNT(*) as `nb_comments`
				FROM `comments`
				INNER JOIN `photos` ON `photos`.`id_photo` = `comments`.`id_photo`
				WHERE `photos`.`id_user` = :id
				GROUP BY `photos`.`id_photo`
				ORDER BY `nb_comments` DESC");
				$request->bindParam(':id', $id);
				$request->execute();
				$result = $request->fetchAll(PDO::FETCH_ASSOC);
				return ($result);
			}
			catch (PDOException $e) {
				print "Error : ".$e->getMessage()."<br/>";
				die();
			}


		}
function	check_old_pass($old_pass, $flag)
{

	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT `mdp` FROM `persons` WHERE `id` LIKE :id");
		$request->bindParam(':id', $_SESSION['id']);
		$request->execute();
		$code = $request->fetch(PDO::FETCH_ASSOC);
		if ($old_pass == $code['mdp'])
		{
			$_SESSION[$flag] = "SUCCESS";
			return ($code);
		}
		else {
			$_SESSION[$flag] = "FAIL";
		}
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}


 ?>
