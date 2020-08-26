<?PHP session_start();?>
<!DOCTYPE html>
<html>
<head>
<title>Reset Password - Camagru</title>
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
					<h2>Reset Password</h2>
					<p>Enter email of your account</p>
				</div>
			</header>
			<form method="post" action="check-reset-password.php">
				<div class="row gtr-uniform">
					<div class="col-6 col-12-xsmall">
					<input type="email" name="mail" value="" placeholder="Email"
						<?PHP if ($_SESSION['flag-reset-password-mail-exists'] == "FAIL")
						{echo "style='background: rgba(199, 47, 47, 0.075)'";}?>
					>
					</div>
					<div class="col-12">
						<ul class="actions">
							<li><input type="submit" name="submit" value="Reset password"/></li>
						</ul>
					</div>
				</div>
			</form>
		<?PHP
		include "../../errors.php";
		error_reset_password();
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
