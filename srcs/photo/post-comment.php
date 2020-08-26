<?php
session_start();

if (isset($_POST['comment']) && $_POST['comment'] != NULL)
{
	include '../../functions/page-photo.php';
	$comment = htmlentities($_POST['comment']);
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT * FROM `photos` WHERE `id_photo` = :id_photo");
		$request->bindParam(':id_photo', $_SESSION['id_photo']);
		$request->execute();
		$code = $request->fetchAll(PDO::FETCH_ASSOC);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
	if ($code == NULL)
	{
		echo "<meta http-equiv='refresh' content='0,url=../gallery/gallery.php?page=1'>";
	}
	else {

		try{
			include '../../config/database.php';
			$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbpdo->query("USE camagru");
			$request = $dbpdo->prepare("INSERT INTO `comments` (`id_user`, `id_photo`, `comments`)
			VALUES (:id_user, :id_photo, :comments);");
			$request->bindParam(':id_photo', $_SESSION['id_photo']);
			$request->bindParam(':id_user', $_SESSION['id']);
			$request->bindParam(':comments', $comment);
			$request->execute();

			$_SESSION['comment-send'] = "SUCCESS";
			$mail = get_mail_user($_SESSION['login-target']);
			if ($mail[0]['mail'] != $_SESSION['mail'] && $_SESSION['login-target-commentflag'] == 'send')
			{
					send_comment_mail($_SESSION['login-target'], $_SESSION['id_photo'], $_POST['submit'], $mail[0]['mail']);
			}
			echo "<meta http-equiv='refresh' content='0,url=photo.php?id_photo=".$_SESSION['id_photo']."'>";
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}
}
else {
	echo "<meta http-equiv='refresh' content='0,url=photo.php?id_photo=".$_SESSION['id_photo']."'>";
	$_SESSION['comment-send'] = "FAIL";
	exit();

}

?>
