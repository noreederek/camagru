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
	<title>Manage Filters - Camagru</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/carcas.css" />
</head>

<body class="is-preload">
<div id="wrapper">
	<?php
		include '../../header.php';
		include '../../functions/admin-filters.php'
	?>
	<div id="main">
		<article class="post">
		<header>
				<div class="title">
					<h2>Manage filters</h2>
					<p>Add or remove some filters</p>
				</div>
		</header>
		<?php
		$data = get_list_filters();
		echo "<div class='table-wrapper'><table class='alt'>";
			echo "<thead>
						<tr>
							<th>Filter</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>";
		foreach ($data as $filter)
		{
			echo "<tr>";
			echo "<td>";
			echo str_replace("img/filtres/", "", str_replace(".png", "", $filter['path_filter']));
			echo "</td>";
			echo "<td>";

			if ($filter['login'] != 'admin')
			{
				echo "<a href='suppress-filter.php?id=".$filter['id_filter']."'>Remove</a>";
			}
			echo "</td>";

			echo "</tr>";
		}
		echo "</tbody></table></div>";

		if ($_SESSION['error-delete-filter'] == "FAIL")
		{
			echo "<div>Error: Should be at least 5 filters!</div>";
			$_SESSION['error-delete-filter'] = NULL;
		}
		?>
		<section>
		<h2>Add filter</h2>
		<p>Your filter must be in PNG, and be in the same directory as the others (img / filters). </br> The name of your filter, without the extension: </p>
		<form method="POST" action="add-filter.php">
		<div class="row gtr-uniform">
			<div class="col-6 col-12-xsmall">
			<input type="text" name="filter" id="filter" value="" placeholder="Name of PNG">
			</div>
			<div class="col-12">
												<ul class="actions">
			<li><input type="submit" name="submit" value="Submit"/></li>
			</ul>
											</div>
		</form>
		<?PHP
		if ($_SESSION['filter-already-exists'] == "SUCCESS")
		{
			echo "<div>Error: Filter already exists!</div>";
			$_SESSION['filter-already-exists'] = NULL;
		}
		?>
		</section>
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
