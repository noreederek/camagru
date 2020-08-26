<ul class="icons">
							<li><a href="/srcs/gallery/gallery.php?page=1" class="icon fa-image"><span class="label">Gallery</span></a></li>
							<li><a href="/srcs/montage/montage.php" class="icon fa-plus-square"><span class="label">New Image</span></a></li>
							<?PHP
								if ($_SESSION['connected'] == "SUCCESS")
								{
									echo '<li><a href="/srcs/account/my-account.php" class="icon fa-user"><span class="label">My Account</span></a></li>';
									if ($_SESSION['roles'] == 'admin')
									{
										echo '<li><a href="/srcs/admin/admin.php"class="icon fa-window-restore"><span class="label">Dashboard</span></a></li>';
									}
									echo '<li><a href="/srcs/account/signout.php" class="icon fa-window-close"><span class="label">Logout</span></a></li>';
								}
								else
								{
									echo '<li><a href="/srcs/register/register.php" class="icon fa-id-card"><span class="label">Register</span></a></li>';
									echo '<li><a href="/srcs/signin/signin.php" class="icon fa-user-circle"><span class="label">Login</span></a></li>';
								}
							?>
						</ul>
</header>