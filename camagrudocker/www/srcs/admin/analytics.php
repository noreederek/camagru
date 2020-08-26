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
	<title>Analytics - Camagru</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/carcas.css" />
</head>

<body class="is-preload">
<div id="wrapper">
	<?php
	include '../../header.php';
	include '../../functions/analytics.php';

	$nb_users = get_nb_users();
	$nb_photos = get_nb_photos();
	$nb_comments = get_nb_comments();
	$nb_like = get_nb_like();

	$most_liked_user = get_most_liked_user();
	$max_like_user = $most_liked_user[0]['nb_likes'];
	foreach ($most_liked_user as $elem)
	{
		if ($elem['nb_likes'] == $max_like_user)
		$array_like[] = $elem;
	}

	$most_commented_user = get_most_commented_user();
	$max_commented_user = $most_commented_user[0]['nb_comments'];
	foreach ($most_commented_user as $elem2)
	{
		if ($elem2['nb_comments'] == $max_commented_user)
		$array_comment[] = $elem2;
	}

	$most_photo_user = get_most_photo_user();
	$max_photo_user = $most_photo_user[0]['nb_photos'];
	foreach ($most_photo_user as $elem3)
	{
		if ($elem3['nb_photos'] == $max_photo_user)
		$array_photos[] = $elem3;
	}

	$most_liked_photo = get_most_liked_photo();
	$max_like_photo = $most_liked_photo[0]['nb_likes_photo'];
	foreach ($most_liked_photo as $elem4)
	{
		if ($elem4['nb_likes_photo'] == $max_like_photo)
		$array_like_photo[] = $elem4;
	}

	$most_commented_photo = get_most_commented_photo();
	$max_commented_photo = $most_commented_photo[0]['nb_comments_photo'];
	foreach ($most_commented_photo as $elem5)
	{
		if ($elem5['nb_comments_photo'] == $max_commented_photo)
		$array_comment_photo[] = $elem5;
	}
	?>
	<div id="main">
		<article class="post">
		<header>
				<div class="title">
					<h2>Analytics</h2>
					<p>Information about Using Camagru</p>
				</div>
		</header>
	<?php

		echo "<h3>Number of: </h3>";
		echo "<div class='table-wrapper'><table>";
			echo "<thead>
						<tr>
							<th><a href='#' class='icon solid fa-user'></a></th>
							<th><a href='#' class='icon solid fa-image'></a></th>
							<th><a href='#' class='icon solid fa-comment'></a></th>
							<th><a href='#' class='icon solid fa-heart'></a></th>
						</tr>
					</thead>
					<tbody>";
		echo "<tr><td>".$nb_users."</td>";
		echo "<td>".$nb_photos."</td>";
		echo "<td>".$nb_comments."</td>";
		echo "<td>".$nb_like."</td></tr>";
		echo "</tbody></table></div>";
		echo "<div class='row'><div class='col-6 col-12-xsmall'>";
		echo "<h3>Users</h3>";
		echo "<p>Most liked users: ";
		if ($array_like == NULL)
		{
			echo "None</p>";
		}
		else {
		foreach ($array_like as $like)
		{
			echo "</br>";
			echo "<a href='../montage/montages-users.php?login=".$like['login']."'>".$like['login']."</a>";
			echo " (".$like['nb_likes']." likes)";
		}
		echo "</p>";
		}


		echo "<p>Most commented users: ";
		if ($array_comment == NULL)
		{
			echo "None</p>";
		}
		else {
		foreach ($array_comment as $comment)
		{
			echo "</br>";
			echo "<a href='../montage/montages-users.php?login=".$comment['login']."'>".$comment['login']."</a>";
			echo " (".$comment['nb_comments']." comments)";
		}
		echo "</p>";
		}

		echo "<p>Users with the max count of photos: ";
		if ($array_photos == NULL)
		{
			echo "None</p>";
		}
		else {
		foreach ($array_photos as $photo)
		{
			echo "</br>";
			echo "<a href='../montage/montages-users.php?login=".$photo['login']."'>".$photo['login']."</a>";
			echo " (".$photo['nb_photos']." photos)";
		}
		echo "</p>";
		}
		echo "</div><div class='col-6 col-12-xsmall'>";
		echo "<h3>Posts</h3>";
		echo "<p>Most liked posts: ";
		if ($array_like_photo == NULL)
		{
			echo "None</p>";
		}
		else {
		foreach ($array_like_photo as $like_photo)
		{
			echo "</br>";
			echo "<a href='../photo/photo.php?id_photo=".$like_photo['id_photo']."' class='icon solid fa-image'></a>";
			echo " (".$like_photo['nb_likes_photo']." likes)";
		}
		echo "</p>";
		}


		echo "<p class='text'>Most commented posts:  ";
		if ($array_comment_photo == NULL)
		{
			echo "None</p>";
		}
		else {
		foreach ($array_comment_photo as $comment_photo)
		{
			echo "</br>";
			echo "<a href='../photo/photo.php?id_photo=".$comment_photo['id_photo']."' class='icon solid fa-comment'></a>";
			echo " (".$comment_photo['nb_comments_photo']." comments)";
		}
		echo "</p>";
		}
		echo "</div></div>";
		?>
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
