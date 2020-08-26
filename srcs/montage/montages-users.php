<?PHP
session_start();
?>
<!DOCTYPE html>
<html>
<head>
		<title>Posts - Camagru</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../../assets/css/gallery.css" />
</head>

<body class="is-preload-0 is-preload-1 is-preload-2">
<div id="main">
	<?php
	include '../../functions/gallery.php';
	?>
			<?PHP
			$exists_or_not = check_if_login_exists(htmlentities($_GET['login']));
			if ($exists_or_not == 0)
			{
				echo "<meta http-equiv='refresh' content='0,url=../gallery/gallery.php'>";
			}
			else {
					$login = htmlentities($_GET['login']);
					echo '<header id="header">';
					echo "<h1>".$login."</h1>";
					$data = get_gallery_user($login);
					$nb_values = count($data);
					if ($nb_values == 0)
					{
						if ($_SESSION['login'] == $login)
						{
						echo "<p>You dont have any posts, try to <a href='montage.php'>create it</a></p>";
						include '../../user_gallery_header.php';
						}
						else {
							echo "<p>".$login." has no posts</p>";
							include '../../user_gallery_header.php';
						}
					}
					else {
						echo '<p>'.$login.' has '.$nb_values.' posts</p>';
						include '../../user_gallery_header.php';
						echo "<section id='thumbnails'>";
						foreach ($data as $data1)
						{	
							echo "<article><a class='thumbnail' href='../../".$data1['link']."'><img src='../../".$data1['link']."'></a>";
							echo "<h2><a href='../photo/photo.php?id_photo=".$data1['id_photo']."'>".$data1['postauthor']."</a></h2>";
							echo "<p><a href='../photo/photo.php?id_photo=".$data1['id_photo']."'>".$data1['datetextformat']."</a>";
							echo "</br><a href='../photo/photo.php?id_photo=".$data1['id_photo']."'>".$data1['geopos']."</a></p>";
							echo "</article>";
						}
						echo "</section>";
					}
			}
			?>
					<footer id="footer">
						<ul class="copyright">
							<li>&copy; nderek.</li><li><a href="http://21-school.ru">21SCHOOL</a>.</li>
						</ul>
					</footer>
</div>
	<script src="../../assets/js/jquery.min.js"></script>
	<script src="../../assets/js/browser.min.js"></script>
	<script src="../../assets/js/breakpoints.min.js"></script>
	<script src="../../assets/js/gallery.js"></script>
</body>
</html>
