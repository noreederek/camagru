<?php
	function	check_token_reset_password($password1, $token, $mail)
	{
		try{
			include '../../config/database.php';
			$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbpdo->query("USE camagru");
			$request = $dbpdo->prepare("SELECT * FROM `persons` WHERE `mail`= :mail");
			$request->bindParam(':mail', $mail);
			$request->execute();
			$code = $request->fetch(PDO::FETCH_ASSOC);
			if (in_array($token, $code) == TRUE)
			$_SESSION['reset-good-token'] = "SUCCESS";
			else {
				$_SESSION['reset-good-token'] = "FAIL";
			}
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}
 ?>
