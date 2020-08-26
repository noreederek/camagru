<?php
session_start();

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
	$cut = imagecreatetruecolor($src_w, $src_h);
	imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
	imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
	imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
}

if (isset($_POST['hidden_data']) && $_POST['hidden_data'] != NULL && isset($_POST['hidden_data2']) && $_POST['hidden_data2'] != NULL)
{
	$upload_dir = "../../img/galerie/";
	$img = $_POST['hidden_data'];
	$img2 = $_POST['hidden_data2'];

	$img = str_replace('data:image/png;base64,', '', $img);
	$img2 = str_replace('data:image/png;base64,', '', $img2);

	$img = str_replace(' ', '+', $img);
	$img2 = str_replace(' ', '+', $img2);

	$img = base64_decode($img);
	$img2 = base64_decode($img2);

	$_SESSION['image1'] = $img;
	$_SESSION['image2'] = $img2;


	$filename = mktime() . $_SESSION['id'] . ".png";

	$img = imagecreatefromstring($img);
	$img2 = imagecreatefromstring($img2);

	imagecopymerge_alpha($img, $img2, 0, 0, 0, 0, 960, 720, 100);
	imagepng($img, "../../img/galerie/".$filename);


	$file = $upload_dir . $filename;
	$path = $file;
	$path_for_dbpdo = "img/galerie/" . $filename;
	$id = $_SESSION['id'];
	date_default_timezone_set('Europe/Moscow');
	$datetextformat = date('jS \of F Y h:i');
	$geopos = "Hidden";
	$postauthor = $_SESSION['login'];
	try{
		$query = @unserialize (file_get_contents('http://ip-api.com/php/'));
		if ($query && $query['status'] == 'success') {
			$geopos = ' ' . $query['country'] . ' - ' . $query['city'] . ' ';
		}
		else
		{
			$geopos = 'Hidden';
		}
	}
	catch(Exception $ex)
	{
		print "Can't get your geoposition. Leave hidden. Error: ".$ex->getMessage()."!";
	}
	try{
		$date_upload = time();
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("INSERT INTO `photos` (`link`, `id_user`, `date_upload`, `geopos`, `datetextformat`, `postauthor`)
		VALUES(:link, :id_user, :date_upload, :geopos, :datetextformat, :postauthor)");
		$request->bindParam(':link', $path_for_dbpdo);
		$request->bindParam(':id_user', $id);
		$request->bindParam(':date_upload', $date_upload);
		$request->bindParam(':geopos', $geopos);
		$request->bindParam(':datetextformat', $datetextformat);
		$request->bindParam(':postauthor', $postauthor);
		$request->execute();
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}
else {
	echo "<meta http-equiv='refresh' content='0,url=../../index.php'>";
	exit();
}

?>
