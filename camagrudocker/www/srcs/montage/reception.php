<?php
session_start();
if ($_FILES['image']['error'] > 0 || !(isset($_POST['submit'])) || !(isset($_FILES['image'])))
{
	$_SESSION['send-image-error'] = "FAIL";
}

if ($_SESSION['send-image-error'] != "FAIL")
{
	if ($_FILES['image']['size'] > 2097152)
	{
		$_SESSION['send-image-size'] = "FAIL";
	}
}

if ($_SESSION['send-image-size'] != "FAIL")
{
	$extensions = array('png', 'jpg');
	$extension_upload = strtolower(substr(strchr($_FILES['image']['name'], '.'), 1));
	if (!(in_array($extension_upload, $extensions)))
	{
		$_SESSION['send-image-extension'] = "FAIL";
	}
}

if ($_SESSION['send-image-extension'] != "FAIL")
{
	$maxwidth = 1600;
	$maxheight = 1200;
	$image_sizes = getimagesize($_FILES['image']['tmp_name']);
	if ($image_sizes[0] > $maxwidth || $image_sizes[1] > $maxheight)
	{
		$_SESSION['send-image-dimensions'] = "FAIL";
	}
	$date_upload = mktime();

	$nom = '../../img/galerie/' . $date_upload . $_SESSION['id'] . '.'. $extension_upload;
	$result = move_uploaded_file($_FILES['image']['tmp_name'], $nom);
	if ($result)
	{
		$_SESSION['print_file_uploaded'] = "<img src='".$nom."' style='display:none;' id='uploaded_file' />";

	}

}

echo "<meta http-equiv='refresh' content='0,url=montage.php'>";


?>
