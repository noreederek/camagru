<?PHP session_start();
include '../../functions/signin.php';
include '../../functions/register.php';

check_form("change-pass", "old_pass", $_POST['old_pass']);
check_form("change-pass", "pass1", $_POST['pass1']);
check_form("change-pass", "pass2", $_POST['pass2']);

if ($_SESSION['change-pass-old_pass'] == "SUCCESS" && $_SESSION['change-pass-pass1'] == "SUCCESS" && $_SESSION['change-pass-pass2'] == "SUCCESS")
{
	$old_pass = hash('sha512', $_POST['old_pass']);
	$pass1 = hash('sha512', htmlentities($_POST['pass1']));
	$pass2 = hash('sha512', htmlentities($_POST['pass2']));

	check_regex_password($pass1, "flag-regex-password");
	check_old_pass($old_pass, "flag-old-pass");
	check_same_password($pass1, $pass2, "same-password");
}

if ($_SESSION['change-pass-old_pass'] == "SUCCESS" && $_SESSION['change-pass-pass1'] == "SUCCESS" &&
$_SESSION['change-pass-pass2'] == "SUCCESS" && $_SESSION['flag-regex-password'] == "SUCCESS" &&
$_SESSION['same-password'] == "SUCCESS" && $_SESSION['flag-old-pass'] == "SUCCESS")
{
	$_SESSION['flag-password-changed'] = "SUCCESS";
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("UPDATE `persons` SET `mdp` = :password WHERE `mail` LIKE :mail");
		$request->bindParam(':mail', $_SESSION['mail']);
		$request->bindParam(':password', $pass1);
		$request->execute();

	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

echo "<meta http-equiv='refresh' content='0,url=change-password.php'>";
?>
