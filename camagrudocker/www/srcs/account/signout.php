<?PHP
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Logout - Camagru</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/carcas.css" />
</head>

<body class="is-preload">
	<div id="wrapper">
		
	<?php
	include '../../header.php';
	include '../../functions/gallery.php';
	?>
	<div id="main">
	<article class="post">
			<header>
				<div class="title">
					<h2><?PHP echo $_SESSION['login'];?> logout</h2>
				</div>
			</header>
			<div class="row gtr-uniform">
				<div class="col-4"></div>
				<div class="col-4"><span class="image fit"><img src="/img/load.gif" alt="" /></span></div>
				<div class="col-4"></div>
			</div>
		<p style="text-align:center;">You will leave an account within 5 seconds</p>
	</article>
	</div>

	<section id="sidebar">
    		<section>
										<h3>Last posts</h3>
										<div class="row gtr-uniform">

											<?php
											$db_exists = check_if_database_exists('camagru');
											if ($db_exists != NULL)
											{
												$code = check_if_table_photos_exists();
											}
											if ($code != NULL)
											{
												$data = get_gallery_data_sidepanel();
												foreach ($data as $key=>$elem)
													{
														echo "<div class='col-6'>";
														echo "<a href='../photo/photo.php?id_photo=".$elem['id_photo']."' class='image fit'><img src='../../".$elem['link']."'></a>";
														echo "</div>";
													}
											}
											?>
										</div>
			</section>
    	  <?php include '../../srcs/footers/footer2.php'; ?>
    	</section>
</div>
</body>
</html>
<?PHP
session_destroy();

	echo "<meta http-equiv='refresh' content='5,url=../../index.php'>";
?>
