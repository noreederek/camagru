<?PHP session_start();

if (isset($_POST['mail']) && $_POST['mail'] != NULL
&& isset($_POST['password1']) && $_POST['password1'] != NULL
&& isset($_POST['password2']) && $_POST['password2'] != NULL
&& isset($_POST['token']) && $_POST['token'] != NULL)
{
	include "../../functions/reset-password.php";
	include "../../functions/register.php";

	$mail = htmlentities($_POST['mail']);
	$password1 = htmlentities($_POST['password1']);
	$password2 = htmlentities($_POST['password2']);
	$token = htmlentities($_POST['token']);

	$return = check_exists_mail($mail);
	$_SESSION['flag-mail-exists-reset-my-password'] = ($return > 0) ? "SUCCESS" : "FAIL";

	check_form("reset", "password1", $password1);
	check_form("reset", "password2", $password2);
	check_regex_password($password1, "reset-flag-regex-password");
	check_same_password($password1, $password2, "reset-same-password");



	if ($_SESSION['flag-mail-exists-reset-my-password'] == "SUCCESS" &&
	$_SESSION['reset-password1'] == "SUCCESS" && $_SESSION['reset-password2'] == "SUCCESS" &&
	$_SESSION['reset-flag-regex-password'] == "SUCCESS" &&
	$_SESSION['reset-same-password'] == "SUCCESS")
	{
		check_token_reset_password($password1, $token, $mail);
		if ($_SESSION['reset-good-token'] == "SUCCESS"){
			$new_password = hash('sha512', $password1);

			try{
				include '../../config/database.php';
				$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
				$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$dbpdo->query("USE camagru");
				$request = $dbpdo->prepare("UPDATE `persons` SET `mdp` = :new_password, `token` = NULL WHERE `mail` LIKE :mail");
				$request->bindParam(':new_password', $new_password);
				$request->bindParam(':mail', $mail);
				$request->execute();
				$_SESSION['reinit-password-in-db'] = "SUCCESS";

			}
			catch (PDOException $e) {
				print "Error : ".$e->getMessage()."<br/>";
				die();
			}

			echo "<meta http-equiv='refresh' content='0,url=reset-my-password.php'>";

		}
	}
}
echo "<meta http-equiv='refresh' content='0,url=reset-my-password.php?token=".$token."'>";
?>
