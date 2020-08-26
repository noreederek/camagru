<?PHP session_start();

	include "../../functions/register.php";
	check_form("register", "username", $_POST['username']);
	check_form("register", "mail", $_POST['mail']);
	check_form("register", "password1", $_POST['password1']);
	check_form("register", "password2", $_POST['password2']);

	if ($_SESSION['register-username'] == "SUCCESS")
	{
		$username = htmlentities($_POST['username']);
		check_exists_username($username);

	}

	if ($_SESSION['register-mail'] == "SUCCESS")
	{
		$mail = htmlentities($_POST['mail']);
		check_regex_mail($mail);
		$return = check_exists_mail($mail);
		$_SESSION['flag-mail-exists'] = ($return > 0) ? "FAIL" : "SUCCESS";
	}

	if ($_SESSION['register-password1'] == "SUCCESS")
	{
		$password1 = $_POST['password1'];
		check_regex_password($password1, "flag-regex-password");
	}

	if ($_SESSION['register-password2'] == "SUCCESS")
	{
		$password2 = $_POST['password2'];
	}
	if ($_SESSION['register-password1'] == "SUCCESS" && $_SESSION['register-password2'] == "SUCCESS")
	{
		check_same_password($password1, $password2, "same-password");
	}

if ($_SESSION['register-username'] == "SUCCESS" && $_SESSION['register-mail'] == "SUCCESS"
&& $_SESSION['register-password1'] == "SUCCESS" && $_SESSION['register-password2'] == "SUCCESS"
&& $_SESSION['flag-regex-password'] == "SUCCESS" && $_SESSION['flag-regex-mail'] == "SUCCESS"
&& $_SESSION['flag-user-exists'] == "SUCCESS" && $_SESSION['flag-mail-exists'] == "SUCCESS"
&& $_SESSION['same-password'] == "SUCCESS")
{

	$_SESSION['flag-register'] = "SUCCESS";
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$password = hash('sha512', $password1);
		$activationtok = md5($email.time());
		$activationstatus = 'notactivated';
		$comgetflag = 'send';
		$request = $dbpdo->prepare("INSERT INTO `persons` (`login`, `mail`, `roles`, `mdp`, `activationtok`, `activationstatus`, `comgetflag`)
		VALUES(:username, :mail, :user, :password, :activationtok, :activationstatus, :comgetflag)");
		$request->bindParam(':username', $username);
		$request->bindParam(':mail', $mail);
		$request->bindValue(':user', 'user');
		$request->bindParam(':password', $password);
		$request->bindParam(':activationtok', $activationtok);
		$request->bindParam(':activationstatus', $activationstatus);
		$request->bindParam(':comgetflag', $comgetflag);
		$request->execute();

		send_confirmation_mail($username, $mail, $_POST['submit'], $activationtok);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
	echo "<meta http-equiv='refresh' content='0,url=register.php'>";

}
else {
	echo "<meta http-equiv='refresh' content='0,url=register.php'>";
	exit();
}
?>
