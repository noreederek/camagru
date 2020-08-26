<?php
session_start();


if ($_SESSION['roles'] != 'admin')
{
	echo "<meta http-equiv='refresh' content='0,url=../account/my-account.php'>";
	exit();
}
else {
	include '../../functions/admin-filters.php';
	if (isset($_POST['filter']) && $_POST['filter'] != NULL)
	{
		$filter = htmlentities($_POST['filter']);
		$exists = check_if_filter_exists($filter);
		if ($exists == 0)
		{
			add_filter($filter);
		}
		else {
			$_SESSION['filter-already-exists'] = "SUCCESS";
		}
		echo "<meta http-equiv='refresh' content='0,url=filters-management.php'>";
	}
	else {
		echo "<meta http-equiv='refresh' content='0,url=filters-management.php'>";

	}
}

?>
