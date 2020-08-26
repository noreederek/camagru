<?php
session_start();
 ?>

<header id="header">
  <h1><a href="/index.php">Camagru</a></h1>
	<nav class="links">
	<ul>

		<li><a href='/srcs/gallery/gallery.php?page=1'>Gallery</a></li>
		<?PHP
		echo "<li><a href='/srcs/montage/montage.php'>New Post</a></li>";
		if ($_SESSION['connected'] == "SUCCESS")
		{
			echo "<li><a href='/srcs/account/my-account.php'>My Account</a></li>";
			if ($_SESSION['roles'] == 'admin')
			{
			echo "<li><a href='/srcs/admin/admin.php'>Dashboard</a></li>";
		}
			echo "<li><a href='/srcs/account/signout.php'>Logout</a></li>";
		}
		else
		{
			echo "<li><a href='/srcs/register/register.php'>Registration</a></li>";
			echo "<li><a href='/srcs/signin/signin.php'>Login</a></li>";
		}
		?>
		<ul>
	</nav>
		<nav class="main">
			<ul>
				<li class="menu">
					<a class="fa-bars" href="#menu">Menu</a>
				</li>
			</ul>
		</nav>
</header>

	<section id="menu">
		<!-- Links -->
			<section>
				<ul class="links">
				<li><a href='/srcs/gallery/gallery.php?page=1'>
					<h3>Gallery</h3>
					<p>All Posts on Camagru</p>
					</a>
				</li>
				<?PHP
				echo "<li><a href='/srcs/montage/montage.php'><h3>Create Snap</h3><p>Post New Image with Some Effects</p></a></li>";
				if ($_SESSION['connected'] == "SUCCESS")
				{
					if ($_SESSION['roles'] == 'admin')
					{
						echo "<li><a href='/srcs/account/my-account.php'><h3>My Account</h3><p>Settings and Analytics</p></a></li>";
						echo "<li><a href='/srcs/admin/admin.php'><h3>Admin Dashboard</h3><p>Administrate Camagru</p></a></li></ul></section>";
					}
					else 
					{
						echo "<li><a href='/srcs/account/my-account.php'><h3>My Account</h3><p>Settings and Analytics</p></a></li></ul></section>";
					}
					echo "<section>
					<ul class='actions stacked'><li><a href='/srcs/account/signout.php' class='button large fit'>Log Out</a></li></ul>
					</section>";
				}
				else
				{
					echo "<li><a href='/srcs/register/register.php'><h3>Registration</h3><p>Create Account</p></a></li></ul>
					</section>";
					echo "<section>
					<ul class='actions stacked'><li><a href='/srcs/signin/signin.php' class='button large fit'>Log in</a></li></ul>
					</section>";
				}
				?>
	</section>