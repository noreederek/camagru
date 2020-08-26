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
	<title>User Management - Camagru</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/carcas.css" />
</head>

<body class="is-preload">
<div id="wrapper">
	<?php
	include '../../header.php';
	include '../../functions/admin-users.php'
	?>
	<div id="main">
		<article class="post">
		<header>
				<div class="title">
					<h2>User Mangement</h2>
					<p>List of all Users</p>
				</div>
		</header>
		<?php
		$data = get_list_users();
		if (count($data) == 1)
		{
			echo "<p class='text' style='text-align:center;'>I think, we don't have user to manage!</p>";
		}
		else {
			echo "<div class='table-wrapper'><table class='alt'>";
			echo "<thead>
						<tr>
							<th>Login</th>
							<th>Email</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>";
			foreach ($data as $user)
			{
				echo "<tr>";
					echo "<td>";
					echo $user['login'];
					echo "</td>";
					echo "<td>";
					echo $user['mail'];
					echo "</td>";
					echo "<td>";

					if ($user['login'] != 'admin')
					{
						echo "<a href='suppress-user.php?id=".$user['id']."'>Remove</a>";
					}
					echo "</td>";
				echo "</tr>";
			}
			echo "</tbody></table></div>";
		}
		?>
		<br/>
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
