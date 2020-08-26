<?php
session_start();
if ($_SESSION['login'] == NULL || !($_SESSION['login']))
{
	echo "<meta http-equiv='refresh' content='0,url=../../index.php'>";
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Change Password - Camagru</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/carcas.css" />
</head>

<body class="is-preload">
<div id="wrapper">
	<?php
	include '../../header.php';
	include '../../errors.php';
	?>
	<div id="main">
	<article class="post">
	<header>
				<div class="title">
					<h2>Change Password</h2>
					<p>Change your password on new</p>
				</div>
			</header>

			<form method="post" action="check-change-password.php">
										<div class="row gtr-uniform">
											<div class="col-6 col-12-xsmall">
											<input
												type="password"
												name="old_pass" id="old_pass" value="" placeholder="Old Password"
												<?PHP
												if ($_SESSION['change-pass-old_pass'] == "FAIL" || $_SESSION['flag-old-pass'] == "FAIL")
												{echo "style='background: rgba(199, 47, 47, 0.075)'";}
												?>>
											</div>
											<div class="col-6 col-12-xsmall">
											<input
												type="password"
												name="pass1" id="pass1" value="" placeholder="New Password"
												<?PHP
												if ($_SESSION['change-pass-pass1'] == "FAIL" || $_SESSION['flag-regex-password'] == "FAIL")
												{echo "style='background: rgba(199, 47, 47, 0.075)'";}
												?>
												>
											</div>
											<div class="col-6 col-12-xsmall">
											<input
												type="password"
												name="pass2"
												id="pass2" value="" placeholder="Reenter New Password"
												<?PHP
												if ($_SESSION['change-pass-pass2'] == "FAIL" || $_SESSION['same-password'] == "FAIL")
												{echo "style='background: rgba(199, 47, 47, 0.075)'";}
												?>
												>
											</div>
											<div class="col-12">
												<ul class="actions">
													<li><input type="submit" name="submit" value="Submit"/></li>
												</ul>
											</div>
										</div>
									</form>
		<?php
		error_change_password();
		if ($_SESSION['flag-password-changed'] == "SUCCESS")
			echo "<meta http-equiv='refresh' content='5,url=my-account.php'>";
		delete_error_change_password();
		 ?>
		 </article>
</div>
<section id="sidebar">
    <section id="intro">
			<a href="#" class="logo"><img src="../../img/logo.png" alt="" /></a>
			<header>
				<h2><a>Settings</a></h2>
				<p>Manage your account</p>
			</header>
		</section>
      <?php include '../../srcs/footers/footer2.php'; ?>
    </section>
</div>
</body>
</html>
