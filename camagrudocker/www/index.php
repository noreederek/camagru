<?PHP session_start();?>
<!DOCTYPE html>
<html>
<head>
  <title>Camagru</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="assets/css/carcas.css" />
</head>

<body class="is-preload" style="background: #fafbfc">
  <div id="wrapper">
    <?php
    include "header.php";
    ?>
    <div id="main">
        <a class="image featured"><img src="/img/test.gif" alt="" /></a>
    </div>
    
    <section id="sidebar">
    <section id="intro">
			<a class="logo"><img src="/img/logo.png" alt="" /></a>
			<header>
				<h2><a href="/index.php">Camagru</a></h2>
				<p>SnapChat-like Project for web-developer branch in <a href="https://21-school.ru/">21SCHOOL</a></p>
			</header>
		</section>
    <section id="footer">
	    <p class='copyright'>&copy; nderek - <a href="https://21-school.ru/">21SCHOOL</a>. 2020</p>
    </section>
    </section>
    <?php include 'srcs/footers/footer.php'; ?>
  </div>
</body>
</html>
