<?PHP session_start();
include '../../functions/page-photo.php';
check_if_picture_exists($_GET['id_photo']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Watch Photo - Camagru</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/carcas.css" />
</head>

<body class="is-preload">
  <div id="wrapper">
  <?php
    include "../../header.php";
    ?>
  	<div id="main">

		<?php
		if (isset($_GET['id_photo']) && $_GET['id_photo'] != NULL && is_numeric($_GET['id_photo']))
		{
			$id = htmlentities($_GET['id_photo']);
		}
		else {
			echo "<meta http-equiv='refresh' content='0,url=../gallery/gallery.php'>";
			exit();
		}
		$data = get_infos_user_photo($id);
		$timeandgeo = get_geo_and_date_photo($id);
		echo "<article class='post'>
								<header>
									<div class='title'>
										<h2><a href='../montage/montages-users.php?login=".$data[0]['login']."'>".$data[0]['login']."</a></h2>
										<p><a class='fa fa-clock'></a> ".$timeandgeo[0]['datetextformat']."</br> <a class='fa fa-map-marker'></a> ".$timeandgeo[0]['geopos']." ";
		
		$result = picture_belong_to_user($id);
		if ($result > 0 || $_SESSION['roles'] == 'admin')
		{
			echo "<a href='delete-picture.php?id-photo=".$id."' id='delete-picture' class='fake-link'> (Delete post)</a>";
		}
		
		echo "</p></div>";

					$nb_like = get_nb_likes($id);
					$_SESSION['login-target'] = $data[0]['login'];
					$_SESSION['login-target-commentflag'] = $data[0]['comgetflag'];

					echo '<div class="meta">
										<h4>Liked ';
					echo '<a id="compteur">'.$nb_like.'</a>';
					
					echo ' times</h4>';?>

					<a class="author"><img id="like"
					<?PHP
					can_i_like_it($id);
					?>/></a>
					<form method="post" name="form_photo" action="update_nb_like_photo.php" id='hidden_data_photo'>
						<input name="hidden_data_photo" type="hidden"/>
					</form>
					<?php
					echo '</div>
								</header>';

					echo "<div id='id_photo'><a class='image featured'><img src='../../".$data[0]['link']."'/></a></div>";

					if ($_SESSION['login'])
					{
						echo'<section><form method="post" action="post-comment.php">';
						echo '<div class="row gtr-uniform"><div class="col-12">';
						echo '	<textarea  name="comment" maxlength="1000" placeholder="Enter Your Commentary" rows="6"></textarea>';
						echo '</div><div class="col-12"><ul class="actions">';
						echo '<li><input type="submit" name="submit" value="Leave Comment"/></li>';
						echo '</ul></div></div></form></section>';
						include '../../errors.php';
						error_post_comment();
					}
					?>
					<footer>
									<ul class="stats">
										<li>Share on: </li>
										<li><a href="<?php echo "http://twitter.com/share?url=http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . "&text=Camagru&hashtags=camagru"; ?>" target="_blank" class="icon brands fa-twitter"></a></li>
										<li><a href="<?php echo "http://www.facebook.com/sharer.php?u=http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>" target="_blank" class="icon brands fa-facebook-f"></a></li>
										<li><a href="<?php echo "http://vk.com/share.php?url=http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . "&title=camagru&description=nderek&image=http://" . $_SERVER['SERVER_NAME'] . "/" . $data[0]['link'] ; ?>" target="_blank" class="icon brands fa-vk"></a></li>
									</ul>
								</footer>
				</article>
		</div>
		<section id="sidebar">
							<section>
								<ul class="posts">
									<h2><a>Commentaries</a></h2>
									<?php
										$comments = get_comments($id);
										put_comments($comments);
									?>
								</ul>
							</section>
							<?php include '../../srcs/footers/footer2.php'; ?>
							</section>
		</div>
			<script>
			function increment_like(this_element){
				var nb_like = document.getElementById('compteur').innerHTML;
				nb_like++;
				this_element.removeAttribute ('onmouseover');
				this_element.removeAttribute ('onmouseout');
				this_element.removeAttribute ('onclick');
				this_element.setAttribute ('title', 'Already liked');
				document.getElementById('compteur').innerHTML = nb_like;
				this_element.src = "../../img/like-grey.png";
				var fd = new FormData(document.forms["form_photo"]);
				var xhr = new XMLHttpRequest();
				xhr.open('POST', 'update_nb_like_photo.php', true);
				xhr.send(fd);
			}
		</script>
</body>
</html>
