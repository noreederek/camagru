<?PHP

function	get_list_users()
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT `id`, `login`, `mail` FROM `persons`");
		$request->execute();
		$code = $request->fetchAll(PDO::FETCH_ASSOC);
		return ($code);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	suppress_user($id)
{
	try{
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");

		$request = $dbpdo->prepare("DELETE FROM `comments` WHERE `id_user`= :id_user");
		$request->bindParam(':id_user', $id);
		$request->execute();

		$request = $dbpdo->prepare("DELETE FROM `likes` WHERE `id_user`= :id_user");
		$request->bindParam(':id_user', $id);
		$request->execute();

		$request = $dbpdo->prepare("DELETE FROM `photos` WHERE `id_user`= :id_user");
		$request->bindParam(':id_user', $id);
		$request->execute();

		$request = $dbpdo->prepare("DELETE FROM `persons` WHERE `id`= :id");
		$request->bindParam(':id', $id);
		$request->execute();
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	check_if_id_exists($id)
{
	try{
		$name = "img/filtres/".$filter.".png";
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT * FROM `persons` WHERE `id` LIKE :id");
		$request->bindParam(':id', $id);
		$request->execute();
		$result = $request->rowCount();
		return ($result);

	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	check_if_not_admin($id)
{
	try{
		$name = "img/filtres/".$filter.".png";
		include '../../config/database.php';
		$dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbpdo->query("USE camagru");
		$request = $dbpdo->prepare("SELECT * FROM `persons` WHERE `login` LIKE 'admin' AND `id` LIKE :id");
		$request->bindParam(':id', $id);
		$request->execute();
		$result = $request->rowCount();
		return ($result);

	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

?>
