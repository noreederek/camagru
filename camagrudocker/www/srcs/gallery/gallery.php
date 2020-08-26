<?PHP session_start();?>
<!DOCTYPE html>
<html>
<head>
		<title>Gallery - Camagru</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../../assets/css/gallery.css" />
</head>
<body class="is-preload-0 is-preload-1 is-preload-2">
<div id="main">
	<?php
	$current_page = "gallery";
	include '../../header_gallery.php';
	include '../../functions/gallery.php';

	$db_exists = check_if_database_exists('camagru');
	if ($db_exists != NULL)
	{
		$code = check_if_table_photos_exists();
	}

	if ($code != NULL)
	{

		$nb_montages = get_nb_montages();
		$_SESSION['max_page'] = ceil($nb_montages / 10);

		if (isset($_GET['page']) && $_GET['page'] != NULL && is_numeric($_GET['page'])
		&& $_GET['page'] > 0 && $_GET['page'] <= $_SESSION['max_page'])
		{
			$_SESSION['page'] = $_GET['page'];
			$data = get_gallery_data($_SESSION['page']);
			echo "<section id='thumbnails'>";
			foreach ($data as $key=>$elem)
			{
				echo "<article><a class='thumbnail' href='../../".$elem['link']."'><img src='../../".$elem['link']."'></a>";
				echo "<h2><a href='../photo/photo.php?id_photo=".$elem['id_photo']."'>".$elem['postauthor']."</a></h2>";
				echo "<p><a href='../photo/photo.php?id_photo=".$elem['id_photo']."'>".$elem['datetextformat']."</a>";
				echo "</br><a href='../photo/photo.php?id_photo=".$elem['id_photo']."'>".$elem['geopos']."</a></p>";
				echo "</article>";
			}
			echo "</section>";
			?>

			<footer id="footer">
			<ul class="icons">
			<?php
			if ($nb_montages > 10)
			{
				if ($_SESSION['page'] == 1)
				{
					echo '<li><a class="fa fa-angle-left" style="pointer-events: none;"></a></li>';
				}
				else {
					echo "<li><a href='gallery.php?page=1'>1</a></li>";
					echo '<li><a class="fa fa-angle-left" onclick="previous_page()"/></a></li>';
				}
				echo "<li><p id='current_page'>".$_SESSION['page']."</p></li>";
				if ($_SESSION['page'] < $_SESSION['max_page'])
				{
					echo '<li><a class="fa fa-angle-right" onclick="next_page()"/></a></li>';
					echo "<li><a href='gallery.php?page=".$_SESSION['max_page']."'>".$_SESSION['max_page']."</a></li>";
				}
				else {
					echo '<li><a class="fa fa-angle-right" style="pointer-events: none;"></a></li>';
				}
			}
		}
		else {
			echo "<meta http-equiv='refresh' content='0,url=gallery.php?page=1'>";
			exit();
		}
	}
	?>
	</ul>
						<ul class="copyright">
							<li>&copy; nderek.</li><li><a href="http://21-school.ru">21SCHOOL</a>.</li>
						</ul>
					</footer>
	</div>
	<script>
	function	next_page()
	{
		var current = document.getElementById('current_page').innerHTML.replace('page ', '');
		location.href="gallery.php?page="+(parseInt(current, 10)+1);
	}
	function	previous_page()
	{
		var current = document.getElementById('current_page').innerHTML.replace('page ', '');
		location.href="gallery.php?page="+(parseInt(current, 10)-1);
	}
	</script>
	<script src="../../assets/js/jquery.min.js"></script>
	<script src="../../assets/js/browser.min.js"></script>
	<script src="../../assets/js/breakpoints.min.js"></script>
	<script src="../../assets/js/gallery.js"></script>
</body>
</html>
