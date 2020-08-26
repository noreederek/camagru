<?PHP session_start();
	if ($_SESSION['id'])
	{
		header('Location: ../account/my-account.php');
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register - Camagru</title>
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
					<h2>Registration</h2>
					<p>Create an account on Camagru</p>
				</div>
			</header>
			<form method="post" action="check-register.php">
					<div class="row gtr-uniform">
						<div class="col-6 col-12-xsmall">
						<input
							type="text"
							name="username" id="username" value="" placeholder="Username"
							<?PHP if ($_SESSION['register-username'] == "FAIL" ||
							$_SESSION['flag-user-exists'] == "FAIL")
							{echo "style='background: rgba(199, 47, 47, 0.075)'";}?>>
						</div>
						<div class="col-6 col-12-xsmall">
						<input
							type="email"
							name="mail"
							id="mail" value="" placeholder="Email"
							<?PHP if ($_SESSION['register-mail'] == "FAIL" ||
							$_SESSION['flag-regex-mail'] == "FAIL" || $_SESSION['flag-mail-exists'] == "FAIL")
							{echo "style='background: rgba(199, 47, 47, 0.075)'";}?>>
						</div>
						<div class="col-6 col-12-xsmall">
						<input
							type="password"
							name="password1"
							id="password1" value="" placeholder="Password"
							<?PHP if ($_SESSION['register-password1'] == "FAIL" ||
							$_SESSION['flag-regex-password'] == "FAIL")
							{echo "style='background: rgba(199, 47, 47, 0.075)'";}?>>
						</div>
						<div class="col-6 col-12-xsmall">
						<input
							type="password"
							name="password2"
							id="password2" value="" placeholder="Password Again"
							<?PHP if ($_SESSION['register-password2'] == "FAIL" || $_SESSION['same-password'] == "FAIL")
							{echo "style='background: rgba(199, 47, 47, 0.075)'";}?>>
						</div>
						<div class="col-12">
							<ul class="actions">
								<li><input type="submit" name="submit" value="Register"/></li>
							</ul>
						</div>
					</div>
				</form>

				<?PHP
				include "../../errors.php";
				error_register();
				delete_error_register();
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
