<?php

	function	get_infos_user_photo($id_photo)
	{
		try{
			include '../../config/database.php';
			$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbpdo->query("USE camagru");
			$request = $dbpdo->prepare("SELECT `link`, `login`, `mail`, `comgetflag` FROM `photos` INNER JOIN `persons` ON persons.id = photos.id_user WHERE `id_photo` LIKE :id_photo");
			$request->bindParam(':id_photo', $id_photo);
			$request->execute();
			$data = $request->fetchAll(PDO::FETCH_ASSOC);
			return ($data);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	get_geo_and_date_photo($id_photo)
	{
		try{
			include '../../config/database.php';
			$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbpdo->query("USE camagru");
			$request = $dbpdo->prepare("SELECT `geopos`, `datetextformat` FROM `photos` WHERE `id_photo` LIKE :id_photo");
			$request->bindParam(':id_photo', $id_photo);
			$request->execute();
			$data = $request->fetchAll(PDO::FETCH_ASSOC);
			return ($data);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	get_nb_likes($id_photo)
	{
		try{
			include '../../config/database.php';
			$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbpdo->query("USE camagru");
			$request = $dbpdo->prepare("SELECT * FROM `likes` WHERE `id_photo`= :id_photo");
			$request->bindParam(':id_photo', $id_photo);
			$request->execute();
			$result = $request->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	check_if_already_liked($id_photo, $id)
	{
		try{
			include '../../config/database.php';
			$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbpdo->query("USE camagru");
			$request = $dbpdo->prepare("SELECT * FROM `likes` INNER JOIN `persons` ON persons.id = likes.id_user WHERE `id_photo`= :id_photo AND `id_user` = :id_user");
			$request->bindParam(':id_photo', $id_photo);
			$request->bindParam(':id_user', $id);
			$request->execute();
			$result = $request->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	check_if_my_photo($id_photo, $id)
	{
		try{
			include '../../config/database.php';
			$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbpdo->query("USE camagru");
			$request = $dbpdo->prepare("SELECT * FROM `photos` WHERE `id_photo`= :id_photo AND `id_user` = :id_user");
			$request->bindParam(':id_photo', $id_photo);
			$request->bindParam(':id_user', $id);
			$request->execute();
			$result = $request->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	can_i_like_it($id_photo)
	{
		if (isset($_SESSION['login']))
		{
			$_SESSION['already_liked'] = check_if_already_liked($id_photo, $_SESSION['id']);
			$_SESSION['my_photo'] = check_if_my_photo($_GET['id_photo'], $_SESSION['id']);
			if ($_SESSION['already_liked'] != 0 || $_SESSION['my_photo'] != 0)
			{
				echo 'src="../../img/like-grey.png"';
				if ($_SESSION['already_liked'] != 0)
				echo 'title="Already liked!"';
				else if ($_SESSION['my_photo'] != 0)
				echo 'title="You can not like your post!"';
			}
			else {
				echo 'src="../../img/like-black.png"';
				echo 'onmouseover="this.src=\'../../img/like-pink.png\'"';
				echo 'onmouseout="this.src=\'../../img/like-black.png\'"';
				echo 'onclick="increment_like(this)"';
				$_SESSION['click-like'] = "SUCCESS";
				$_SESSION['id_photo'] = $id_photo;
			}
		}
		else {
			echo 'src="../../img/like-grey.png"';
			echo 'title="You must be logged in to like this image!"';
		}
	}


function	get_comments($id_photo)
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$dbpdo->query("SET NAMES UTF8");
		$request = $dbpdo->prepare("SELECT `login`, `comments`, `id_comment` FROM `comments` INNER JOIN `persons` ON persons.id = comments.id_user WHERE `id_photo` LIKE :id_photo");
		$request->bindParam(':id_photo', $id_photo);
		$request->execute();
		$data = $request->fetchAll(PDO::FETCH_ASSOC);
		return ($data);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_mail_user($login)
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$dbpdo->query("SET NAMES UTF8");
		$request = $dbpdo->prepare("SELECT `mail` FROM `persons` WHERE `login` LIKE :login");
		$request->bindParam(':login', $login);
		$request->execute();
		$data = $request->fetchAll(PDO::FETCH_ASSOC);
		return ($data);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	send_comment_mail($username, $id_photo, $submit, $mail)
{
		$name = "Camagru";
		$message = "<br/>Hello " . $username . ",<br/><br/>" .
		"One of your post recently had been commented by other user". "<br/>".
		"It's <a href='http://". $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] ."/srcs/photo/photo.php?id_photo=".$id_photo."'>here</a>" . "<br/><br/>" .
		"Please check it!";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
     	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: Camagru';
		$to = $mail;
		$subject = 'Comment on your post';
		$body = "From: $name<br/>To: $to<br/>Message:<br/>$message";

		if ($submit)
		{
			if (mail ($to, $subject, $body, $headers) == FALSE)
			{
				die("error");
			}
		}
}


function	put_comments($comments)
{
if ($comments == NULL)
{
	echo "<li>
	<article>
		<header>
			<p>There are no comments under this post</p>
		</header>
	</article>
	</li>";
}
else {
	foreach ($comments as $data)
	{
		if ($data['login'] == $_SESSION['login'] || $_SESSION['roles'] == 'admin')
		{
			echo "<li>
			<article>
				<header>
					<h3>";
			echo "<a href='../montage/montages-users.php?login=".$data['login']."'>".$data['login']."</a> ";
			echo "<a href='delete-comment.php?id-comment=".$data['id_comment']."' class='delete-comment' id='".$data['id_comment']."'>(Delete comment)</a>";
			echo "</h3>";
			echo "<p>".$data['comments']."</p>";
			echo "</header></article></li>";
		}
		else {
			echo "<li>
			<article>
				<header>
					<h3>";
			echo "<a href='../montage/montages-users.php?login=".$data['login']."'>".$data['login']."</a></h3>";
			echo "<p>".$data['comments']."</p>";
			echo "</header></article></li>";
		}
	}
}
}

function	check_if_picture_exists($id)
{
	if (isset($id) && $id != NULL && is_numeric($id))
	{
		try{
			include '../../config/database.php';
			$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbpdo->query("USE camagru");
			$request = $dbpdo->prepare("SELECT * FROM `photos` WHERE `id_photo` = :id_photo");
			$request->bindParam(':id_photo', $id);
			$request->execute();
			$code = $request->rowCount();
			if ($code == 0)
			{
				echo "<meta http-equiv='refresh' content='0,url=../gallery/gallery.php'>";
				exit();
			}
			else {
				$_SESSION['id_photo'] = $id;
			}
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}
	else {
		echo "<meta http-equiv='refresh' content='0,url=../gallery/gallery.php'>";
		exit();
	}
}

function	picture_belong_to_user($id)
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT * FROM `photos` WHERE `id_photo` = :id_photo AND `id_user` = :id_user");
		$request->bindParam(':id_photo', $id);
		$request->bindParam(':id_user', $_SESSION['id']);
		$request->execute();
		$code = $request->rowCount();
		return ($code);

}
catch (PDOException $e) {
	print "Error : ".$e->getMessage()."<br/>";
	die();
}
}


?>
