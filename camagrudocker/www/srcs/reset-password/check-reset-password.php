<?PHP session_start();

	include "../../functions/reset-password.php";
	include "../../functions/register.php";
	include "../../functions/signin.php";

	$mail = htmlentities($_POST['mail']);

	$return = check_exists_mail($mail);
	if ($return > 0)
	{
		$_SESSION['flag-reset-password-mail-exists'] = "SUCCESS";
	}
	else {
		$_SESSION['flag-reset-password-mail-exists'] = "FAIL";
	}

	if ($_SESSION['flag-reset-password-mail-exists'] == "SUCCESS")
	{
		$token = bin2hex(random_bytes(64));

		try{
			include '../../config/database.php';
			$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbpdo->query("USE camagru");
			$request = $dbpdo->prepare("UPDATE `persons` SET `token` = :token WHERE `mail` LIKE :mail");
			$request->bindParam(':token', $token);
			$request->bindParam(':mail', $mail);
			$request->execute();

			send_reinit_password_mail($token, $mail, $_POST['submit']);
			$_SESSION['mail-reinit-password'] = "SUCCESS";
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
		echo "<meta http-equiv='refresh' content='0,url=reset-password.php'>";
	}
	else {
		echo "<meta http-equiv='refresh' content='0,url=reset-password.php'>";
		exit();
	}



?>
