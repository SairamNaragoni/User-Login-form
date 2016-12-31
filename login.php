<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
		<?php
			$uname= $pass = "";
			if(isset($_POST['login']))
			{
			$uname = $_POST['uname'];
			$pass = $_POST['password'];
			$con=mysqli_connect("localhost","root","","user") or die(mysql_error());
			mysqli_select_db($con,"user") or die(mysql_error());
			$check = mysqli_query($con,"SELECT * FROM info WHERE username = '$uname' ");
			$row=mysqli_num_rows($check);
			if($row!=0)
			{
				$result=mysqli_fetch_array($check);
				$dbuname=$result['username'];
				$dbpassword=($result['password']);
				$passc=md5($pass);
				if($dbuname==$uname && $dbpassword==$passc)
				{
					session_start();
					$_SESSION['username'] = $uname;
					echo "succesful";
					header("location: http://localhost/login/home.php");
				}
				else
				{
					$errorLogin = "Invalid Username Or Password";
				}
			}
			else
				$errorLogin = "Invalid Username Or Password";
			}
			
		?>
		<div class="main_wrapper">
		<div class="header"><h1>login</h1></div>
		<div class="central">
			<form method="POST" action="login.php" >
				<table>
					<tr>
						<td>UserName:</td>
						<td><input type="text" name="uname" placeholder="UserName"></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" name="password" placeholder="Password"></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="login" value="Log In" id="ibutton" ></td>
					</tr>
				</table>
			</form>
		</div>
		<div >
				<p class="errorLogin">
					<?php
						if(isset($errorLogin))
						{
							echo $errorLogin;
						} 
					?>
				</p>
		</div>
		<div class="footer">
			<a href="register.php">Create a New Account</a>
		</div>
		<footer>
			<h6>Created by <a href="https://github.com/SairamNaragoni" target="_blank">Rogue</a></h6>
		</footer>
		</div>
</body>
</html>