<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
		<?php
				if(!isset($_SESSION['username']))
					header("location: http://localhost/login/login.php");
		?>
	<div class="main_wrapper">
		<div class="header"><h1>Hello</h1></div>
		<div class="central">
		<p>WELCOME <?php echo $_SESSION['username']; ?></p>
		</div>
		<div class="footer">
			<a href="logout.php">Log OUT</a>
		</div>
		<footer>
			<h6>Created by <a href="https://github.com/SairamNaragoni" target="_blank">Rogue</a></h6>
		</footer>
	</div>
</body>
</html>