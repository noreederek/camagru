<?PHP session_start();
	if ($_SESSION['login'])
	{
		header('Location: ../account/my-account.php');
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login - Camagru</title>
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
					<h2>Login</h2>
					<p>Enter to Camagru</p>
				</div>
				
			</header>
									<form method="post" action="check-signin.php">
										<div class="row gtr-uniform">
											<div class="col-6 col-12-xsmall">
											<input type="email" name="mail" id="mail" value="" placeholder="Email"
												<?PHP if ($_SESSION['signin-mail'] == "FAIL" ||
												$_SESSION['signin-mail-exists'] == "FAIL")
												{echo "style='background: rgba(199, 47, 47, 0.075)'";}?>
											>
											</div>
											<div class="col-6 col-12-xsmall">
											<input type="password" name="password" id="password" value="" placeholder="Password"
												<?PHP if ($_SESSION['signin-password'] == "FAIL" ||
												$_SESSION['signin-good-password'] == "FAIL")
												{echo "style='background: rgba(199, 47, 47, 0.075)'";}?>
												>
											</div>
											<div class="col-12">
												<ul class="actions">
													<li><input type="submit" name="submit" value="Login"/></li>
												</ul>
											</div>
										</div>
									</form>
			<footer>
				<ul class="stats">
					<li>Forgot your password? <a href="../reset-password/reset-password.php">Reset Password</a></li>
				</ul>
			</footer>
			<?PHP
				include "../../errors.php";
				error_signin();
				delete_error_signin();
			?>
		</article>
	</div>

	<section id="sidebar">
    <section>
								<h3><a>Last posts</a></h3>
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
