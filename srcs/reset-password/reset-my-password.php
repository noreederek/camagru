<?PHP session_start();?>
<!DOCTYPE html>
<html>
<head>
<title>New Password - Camagru</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/carcas.css" />
</head>

<body class="is-preload">
	<div id="wrapper">
	<?php
	include '../../header.php';
	include '../../functions/gallery.php';
	$token = $_GET['token'];
	?>
	<div id="main">
	<article class="post">
			<header>
				<div class="title">
					<h2>New Password</h2>
					<p>Enter your new password</p>
				</div>
			</header>
			<form method="post" action="check-reset-my-password.php">
				<div class="row gtr-uniform">
					<div class="col-6 col-12-xsmall">
					<input type="email" name="mail" value="" placeholder="Email"
						<?PHP if ($_SESSION['flag-mail-exists-reset-my-password'] == "FAIL")
						{echo "style='background: rgba(199, 47, 47, 0.075)'";}?>>
					</div>
					<div class="col-6 col-12-xsmall">
					<input type="password" name="password1" value="" placeholder="New Password"
						<?PHP if ($_SESSION['reset-password1'] == "FAIL" ||
						$_SESSION['reset-flag-regex-password'] == "FAIL")
						{echo "style='background: rgba(199, 47, 47, 0.075)'";}?>>
					</div>
					<div class="col-6 col-12-xsmall">
					<input type="password" name="password2" value="" placeholder="New Password Again"
						<?PHP if ($_SESSION['reset-password2'] == "FAIL" ||
						$_SESSION['reset-same-password'] == "FAIL")
						{echo "style='background: rgba(199, 47, 47, 0.075)'";}?>>
					</div>
					<div class="col-12">
						<ul class="actions">
						    <li><input type="hidden" name="token" value="<?PHP echo $token;?>"></li>
							<li><input type="submit" name="submit" value="Submit"/></li>
						</ul>
					</div>
				</div>
			</form>
		<?PHP
		include "../../errors.php";
		error_reset_password();
		if ($_SESSION['reinit-password-in-db'] == "SUCCESS")
		{
			echo "<meta http-equiv='refresh' content='5,url=../../index.php'>";
		}
		delete_error_reset_password();
		?>
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
