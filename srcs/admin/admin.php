<?PHP session_start();
	if ($_SESSION['roles'] != 'admin')
	{
		echo "<meta http-equiv='refresh' content='0,url=../account/my-account.php'>";
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard - Camagru</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/carcas.css" />
</head>

<body class="is-preload">
<div id="wrapper">
	<?php
	include '../../header.php';
	?>
	<div id="main">
		<article class="post">
		<header>
				<div class="title">
					<h2>Administration</h2>
					<p>Choose option to manage</p>
				</div>
		</header>

		<ul class="actions fit small">
			<li><a href="user-management.php" class="button fit small">User Management</a></li>
			<li><a href="filters-management.php" class="button fit small">Manage Filters</a></li>
			<li><a href="analytics.php" class="button fit small">Analytics</a></li>
		</ul>
		</article>

	</div>
	<section id="sidebar">
    <section id="intro">
			<a href="#" class="logo"><img src="../../img/logo.png" alt="" /></a>
			<header>
				<h2><a>Dashboard</a></h2>
				<p>Camagru management section</p>
			</header>
		</section>
      <?php include '../../srcs/footers/footer2.php'; ?>
    </section>
</div>
</body>
</html>
