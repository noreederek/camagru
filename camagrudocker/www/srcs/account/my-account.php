<?PHP session_start();
if ($_SESSION['login'] == NULL || !($_SESSION['login']))
{
	echo "<meta http-equiv='refresh' content='0,url=../../index.php'>";
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/carcas.css" />
<title>My account - Camagru</title>
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
					<h2>My account</h2>
					<p>User information and settings</p>
				</div>
		</header>
		<h3>User</h3>
		<?php
		include '../../functions/signin.php';
		include '../../functions/gallery.php';

		$gallery_user = get_gallery_user($_SESSION['login']);
		if ($gallery_user == NULL)
		{
			$_SESSION['nb_montages'] = 0;
			echo "<h5>You don't have any posts!</h5>";
		}
		else
		{
			echo '<ul class="actions fit"><li>
				<a href="../montage/montages-users.php?login='.$_SESSION['login'].'" class="button fit">
					All my posts
				</a>
				</li></ul>';
			echo '<p> Number of likes on my montages : ';
			$nb_likes = get_nb_likes_user($_SESSION['id']);
			echo $nb_likes;
			echo "</p>";
			echo '<p> My most liked montage: ';
			$most_liked_picture = get_most_liked_picture($_SESSION['id']);
			if ($most_liked_picture == NULL)
			{
				echo "None </p>";
			}
			else {
				$max = $most_liked_picture[0]['nb_likes'];
				foreach ($most_liked_picture as $elem)
				{
					if ($elem['nb_likes'] == $max)
					$array_like[] = $elem;
				}
				foreach ($array_like as $photo_like)
				{
					if ($max > 1)
					{
						echo "<a href='../photo/photo.php?id_photo=".$photo_like['id_photo']."'>Here </a> (".$max." likes)<br/>";
					}
					else {
						echo "<a href='../photo/photo.php?id_photo=".$photo_like['id_photo']."'>Here </a> (".$max." like)<br/>";
					}
				}
			}
			echo '<p>Number of comments on my montages: ';
			$nb_comments = get_nb_comments_user($_SESSION['id']);
			echo $nb_comments;
			echo "</p>";
			echo '<p>My most commented editing: ';
			$most_commented_picture = get_most_commented_picture($_SESSION['id']);
			if ($most_commented_picture == NULL)
			{
				echo "None </p>";
			}
			else {
				echo "<br/><br/>";
				$max = $most_commented_picture[0]['nb_comments'];
				foreach ($most_commented_picture as $elem)
				{
					if ($elem['nb_comments'] == $max)
					{
						$array_comments[] = $elem;
					}
				}
				foreach ($array_comments as $photo_comment)
				{
					if ($max > 1)
					{
						echo "<a href='../photo/photo.php?id_photo=".$photo_comment['id_photo']."'>Here</a> (".$max." comments)<br/>";
					}
					else {
						echo "<a href='../photo/photo.php?id_photo=".$photo_comment['id_photo']."'>Here</a> (".$max." comment)<br/>";
					}
				}
			}

		}
		?>
		<?php 
		if ($_SESSION['comgetflag'] == "stopsend")
		{
			echo "<h4>You will not get messages if other users comment your posts</h4>";
			echo "<form method='post' action='start-get-messages.php'>";
			echo "<input type='submit' name='send' value='Send Messages'/>";
			echo "</form>";
		}
		else
		{
			echo "<h4>You will get messages if other users comment your posts</h4>";
			echo "<form method='post' action='stop-get-messages.php'>";
			echo "<input type='submit' name='stopsend' value='Stop Send Messages'/>";
			echo "</form>";
		}
		?>
		<h3>Change password</h3>
			<a href="change-password.php" class="button fit">Change my password</a><br/>
		<?php
		if ($_SESSION['roles'] != 'admin')
		{
			echo '</br>';
			echo '<h3>Delete account</h3>';
			echo '<a href="suppress-account.php" class="button fit">Delete account</a>';
			echo "</br></br>";
		}
		if ($_SESSION['wish-to-suppress-account'] == "SUCCESS")
		{
			echo "<p style='color: #f54029'>You really want to delete an account?</p>";
			echo "<form method='post' action='suppress-account.php'>";
			echo "<input type='submit' name='yes' value='Yes'/>\t";
			echo "<input type='submit' name='no' value='No'/>";
			echo "</form>";
		}
		if ($_SESSION['session-destroy'] == "SUCCESS")
		{
			echo "</br><p style='color: #3CB371'>Account destroy - success!</p>";
			echo "<p style='text-align:center'>You will be returned to start page...</p>";
			echo "<div class='row gtr-uniform'>
			<div class='col-4'></div>
			<div class='col-4'><span class='image fit'><img src='/img/load.gif' alt='' /></span></div>
			<div class='col-4'></div>
			</div>";
			session_destroy();
			echo "<meta http-equiv='refresh' content='5,url=../../index.php'>";
		}
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
