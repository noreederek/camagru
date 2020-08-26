<?PHP session_start();

include "../../functions/signin.php";
include "../../functions/register.php";

check_form('signin', 'mail', $_POST['mail']);
check_form('signin', 'password', $_POST['password']);

if ($_SESSION['signin-mail'] == "SUCCESS" && $_SESSION['signin-password'] == "SUCCESS")
{
	$mail = htmlentities($_POST['mail']);
	$password = htmlentities($_POST['password']);
	$return = check_exists_mail($mail);
	$checkactivation = connection_check_activationstatus($mail);
	if ($return > 0)
	{
		$_SESSION['signin-mail-exists'] = "SUCCESS";
		$infos = signin_check_password($mail, hash('sha512', $password));
		if ($checkactivation == TRUE){
			if ($infos != NULL)
			{
				$_SESSION['id'] = $infos['id'];
				$_SESSION['login'] = $infos['login'];
				$_SESSION['mail'] = $infos['mail'];
				$_SESSION['roles'] = $infos['roles'];
				$_SESSION['comgetflag'] = $infos['comgetflag'];
				$_SESSION['connected'] = "SUCCESS";
				echo "<meta http-equiv='refresh' content='0,url=../account/my-account.php'>";
			}
			else
			{
				echo "<meta http-equiv='refresh' content='0,url=signin.php'>";
				exit();
			}
		}
		else{
			echo "<meta http-equiv='refresh' content='0,url=signin.php'>";
			exit();
		}
	}
	else
	{
		$_SESSION['signin-mail-exists'] = "FAIL";
		echo "<meta http-equiv='refresh' content='0,url=signin.php'>";
		exit();
	}
}
else
{
	echo "<meta http-equiv='refresh' content='0,url=signin.php'>";
	exit();
}
?>
