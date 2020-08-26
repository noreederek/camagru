<?php
function check_form($flag, $text, $data)
{
	if (isset($data) && $data != NULL)
	{
		$_SESSION[$flag."-".$text] = "SUCCESS";
	}
	else
	{
		$_SESSION[$flag."-".$text] = "FAIL";
	}
}

function check_regex_mail($data)
{
	if (filter_var($data, FILTER_VALIDATE_EMAIL) == FALSE)
	{
		$_SESSION['flag-regex-mail'] = "FAIL";
	}
	else {
		$_SESSION['flag-regex-mail'] = "SUCCESS";
	}
}

function check_regex_password($data, $flag)
{
	if (preg_match("/(?=.{6,})(?=.*\d)(?=.*[a-zA-Z])/", $data) != 1)
	{
		$_SESSION[$flag] = "FAIL";
	}
	else {
		$_SESSION[$flag] = "SUCCESS";
	}
}

function check_exists_username($username)
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT * FROM `persons` WHERE `login`= :login");
		$request->bindParam(':login', $username);
		$request->execute();
		$result = $request->rowCount();
		if ($result  > 0){
			$_SESSION['flag-user-exists'] = "FAIL";
		}
		else {
			$_SESSION['flag-user-exists'] = "SUCCESS";
		}
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function check_exists_mail($mail)
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT * FROM `persons` WHERE `mail`= :mail");
		$request->bindParam(':mail', $mail);
		$request->execute();
		$result = $request->rowCount();
		return ($result);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function check_same_password($pass1, $pass2, $flag)
{
	if ($pass1 != $pass2)
	{
		$_SESSION[$flag] = "FAIL";
	}
	else {
		$_SESSION[$flag] = "SUCCESS";
	}
}

function send_confirmation_mail($username, $mail, $submit, $activationtok)
{
	$name = "Camagru";
	$message = "Hello" . $username . ",\r\n\r\n" .
	"You just registered on Camagru\r\n\r\n" .
	"To continue your registration process please go to \r\n\r\n" .
	"<a href='http://". $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] ."/srcs/register/activateaccount.php?activationtok=".$activationtok."'>THIS LINK</a>\r\n\r\n" .
	"Thanks for registration!";
	$from = 'From: Camagru';
	$to = $mail;
	$subject = mb_encode_mimeheader('Registration on Camagru', "UTF-8");
	$body = "From: $name\r\nTo: $to\r\nMessage:\r\n\r\n$message";

	if ($submit)
	{
		if (mail ($to, $subject, $body, $from) == FALSE)
		{
			die();
		}
	}
}

 ?>
