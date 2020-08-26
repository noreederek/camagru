<div id="main">
	<article class="post">
		<header>
			<div class="title">
				<h2>Take Picture</h2>
				<p>Click On Effect than click on "snapshot" picture</p>
			</div>
		</header>
<div id="move" class="row">
		<div class="col-2"></div>
		<div class="col-1"><h1><a class="fa fa-plus-circle" onclick='plus_image()'></a></h1></div>
		<div class="col-1"><h1><a class="fa fa-minus-circle" onclick="minus_image()"></a></h1></div>
		<div class="col-1"><h1><a class="fa fa-arrow-left" onclick="move_left()"></a></h1></div>
		<div class="col-1"><h1><a class="fa fa-arrow-right" onclick="move_right()"></a></h1></div>
		<div class="col-1"><h1><a class="fa fa-arrow-up" onclick="move_up()"></a></h1></div>
		<div class="col-1"><h1><a class="fa fa-arrow-down" onclick="move_down()"></a></h1></div>
		<div class="col-1"></div>
		<div class="col-1"><h1><a class="fa fa-window-close" onclick="do_reset()"></a></h1></div>
		<div class="col-2"></div>
</br>
</br>
</div>
<div id="camera-and-filters">
	<div id="camera">
		<canvas id="canva_filters" width="960px" height="720px"></canvas>
		<video id="video" width="960px" height="720px" autoplay></video>
		<canvas id="canvas" width="960px" height="720px"></canvas>
		<img src="../../img/empty.png" style="width:100%;">
	</div>

</div>
<div class="row">
	<div id="side" class="col-12">
		<a class="fa fa-arrow-circle-left" onclick='prev_filter()'></a>
		<div id="filters">
			<?php
			include '../../functions/filters.php';

			$data = get_filters();
			foreach ($data as $filter)
			{
				echo "<img src='../../".$filter['path_filter']."' class='hidden_path' id='".$filter['id_filter']."'/>";
			}
			for ($i = 0; $i < 5; $i++)
			{
				echo "<div class='filter' style='display:block;'>";
				echo "<img src='' class='image_filter' onclick='submitfilter(event)' id=''/>";
				echo "</div>";
			}
			?>

		</div>
		<a class="fa fa-arrow-circle-right" onclick='next_filter()'></a>

	</div>
</div>
</br>
</br>
<div id="buttons">
	<?php
	if ($_SESSION['print_file_uploaded'])
	{
		echo "<button id='reset'>Camera</button>";
	}
	else {
		echo "<button id='reset'>Reset</button>";
	}
	?>
	<button id="snap">Snapshot</button>
	<button id="save">Save</button>
	<form method="post" accept-charset="utf-8" name="form1">
		<input name="hidden_data" id="hidden_data" type="hidden"/>
		<input name="hidden_data2" id="hidden_data2" type="hidden"/>
	</form>
</div>
</br>
</article>
	<article class="post">
				<h2><a>Upload Custom Image</a></h2>
				<p>JPG, PNG - Max Filesize 2MB; Max Resolution - 1600x1200</p>
			<form method="post" action="reception.php" enctype="multipart/form-data">
				<input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
				<input type="file" name="image" id="image" /></br></br>
				<input type="submit" name="submit" value="Upload Image" />
			</form>
				<?php
				include '../../errors.php';
				send_image_error();
				if ($_SESSION['print_file_uploaded'])
				{
					echo $_SESSION['print_file_uploaded'];
					$_SESSION['print_file_uploaded'] = NULL;
				}
				?>		
	</article>
</div>

<section id="sidebar">

	<section>
	<div class="mini-posts" id="photos">
	<article class="mini-post">
	<header>
		<h3><a href="single.html">Your Snapshots</a></h3>
		<p class="published"><?php 
		date_default_timezone_set('Europe/Moscow');
		echo date('jS \of F Y h:i'); 
		?></p>
		<a class="author"><img src="/img/avatar.png"/></a>
	</header>
	</article>
	</div>
	</section>

	<script src="../../camera_js/list-filters.js"></script>
	<script src="../../camera_js/submitfilter.js"></script>
	<script src="../../camera_js/camera_handle.js"></script>
	<?php include '../../srcs/footers/footer2.php'; ?>
</section>