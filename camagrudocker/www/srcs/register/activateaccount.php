<?PHP session_start();
?>
<!DOCTYPE html>
<html>
<head>
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
    ?>
    <div id="main">
			<article class="post">
			<header>
					<div class="title">
                    <?php
                        if(!empty($_GET['activationtok']) && isset($_GET['activationtok']))
                        {
                            $activationtok=$_GET['activationtok'];
                            try{
                                include '../../config/database.php';
                                $dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
                                $dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $dbpdo->query("USE camagru");
                                $request = $dbpdo->prepare("SELECT * FROM `persons` WHERE `activationtok`= :activationtok");
                                $request->bindParam(':activationtok', $activationtok);
                                $request->execute();
                                $code = $request->fetch(PDO::FETCH_ASSOC);
                                if (in_array($activationtok, $code) == TRUE){
                                    if ($code['activationstatus'] == 'notactivated')
                                    {
                                        try{
                                            $dbpdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
                                            $dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            $dbpdo->query("USE camagru");
                                            $request = $dbpdo->prepare("UPDATE `persons` SET `activationstatus`='activated' WHERE `activationtok`= :activationtok");
                                            $request->bindParam(':activationtok', $activationtok);
                                            $request->execute();
                                            echo "<h1>Account active now! Try login</h1>";
                                        }
                                        catch (PDOException $e) {
                                            print "Error : ".$e->getMessage()."<br/>";
                                            die();
                                        }
                                    }
                                    else
                                    {
                                        echo "<h1>Your account already activated</h1>";
                                    }
                                }
                                else{
                                    echo "<h1>Wrong activation code</h1>";
                                }
                            }
                            catch (PDOException $e) {
                                print "Error : ".$e->getMessage()."<br/>";
                                die();
                            }
                        }
                        ?>
					</div>
			</header>
	
			<ul class="actions fit small">
				<li><a href="../signin/signin.php" class="button fit small">Login</a></li>
			</ul>
			</article>
	
		</div>
		<section id="sidebar">
		<section id="intro">
				<a href="#" class="logo"><img src="../../img/logo.png" alt="" /></a>
				<header>
					<h2><a href="/index.php">New Post</a></h2>
					<p>Create new post on camagru</p>
				</header>
			</section>
            <?php
		include '../../srcs/footers/footer2.php';
	?>
    </section>
    </div>
</div>
</body>
</html>
