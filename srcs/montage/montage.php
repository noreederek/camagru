<?PHP session_start();
?>
<!DOCTYPE html>
<html>
<head>
<head>
	<title>User Management - Camagru</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/carcas.css" />
  <link rel="stylesheet" href="../../assets/montage.css" />
</head>

<body class="is-preload">
<div id="wrapper">
	<?php
	include '../../header.php';
	if (!$_SESSION['login'])
	{	
		echo '<div id="main">
			<article class="post">
			<header>
					<div class="title">
						<h2>Sorry, this page is for members only</h2>
						<p>Try to login or register</p>
					</div>
			</header>
	
			<ul class="actions fit small">
				<li><a href="../register/register.php" class="button fit small">Registration</a></li>
				<li><a href="../signin/signin.php" class="button fit small">Login</a></li>
			</ul>
			</article>
	
		</div>
		<section id="sidebar">
		<section id="intro">
				<a href="#" class="logo"><img src="../../img/logo.png" alt="" /></a>
				<header>
					<h2><a href="/index.php">New Post</a></h2>
					<p>Create new post on camagru</p>
				</header>
			</section>';
		include '../../srcs/footers/footer2.php';
		echo '</section></div>';
	}
	else {
		include 'go-to-montage.php';
	}
	?>
</div>
</body>
</html>
