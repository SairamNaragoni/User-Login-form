<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		td.error{
			color: green;
		}
	</style>

</head>
<body>
	<?php
		$passerr = $pass1err = $unameerr = $pmatch = "";
		if($_SERVER["REQUEST_METHOD"]=="POST") 
		{	
			if(empty($_POST["uname"]))
				$unameerr="UserName is required";
			if(empty($_POST["password"]))
				$passerr="Password is required";
			if(empty($_POST["password1"]))
				$pass1err="Re-enter the password";
			if($_POST["password"]!=$_POST["password1"])
				$pmatch="Passwords Don't Match";
			if($passerr ==  "" && $pass1err=="" && $unameerr=="" && $pmatch=="" )
				{

					$uname=$_POST["uname"];
					$pass=md5($_POST["password"]);
					$con = new mysqli("localhost","root","");
					mysqli_query($con,"CREATE DATABASE  if NOT EXISTS user") or die(mysql_error());
					//$con=mysqli_connect("localhost","root","","user") or die(mysql_error());
					mysqli_select_db($con,"user") or die(mysql_error()) ;
					mysqli_query($con,"CREATE TABLE if NOT EXISTS info (id INT AUTO_INCREMENT,username varchar(20),password varchar(50),PRIMARY KEY(id))") or die(mysql_error());
					$exist = mysqli_query($con,"SELECT * FROM info WHERE username='$uname'");
					$result = mysqli_fetch_array($exist);
					if($uname==$result['username'])
					{
						die("User with same Username Exists,Try Again with Another UserName");
					}
					else
					{
						session_start();
						mysqli_query($con,"INSERT INTO info (username,password) VALUES ('$uname','$pass')");
						$_SESSION['username'] = $uname;
						echo "You have successfully registered";
						header("location: http://localhost/login/home.php");
					}		
				}
		}		
	?>
<div class="main_wrapper">
	<div class="header"><h1>Register</h1></div>
	<div class="central">
		<form method="POST" action="register.php" id="formElts">
			<table>
				<tr>
					<td>Enter Your UserName</td>
					<td>: <input type="text" name="uname" placeholder="UserName"></td>
					<td class="error"><?php echo $unameerr; ?></td>
				</tr>
				<tr>
					<td>Choose a Password</td>
					<td>: <input type="password" name="password" placeholder="password"></td>
					<td class="error"><?php echo $passerr; ?></td>
				</tr>
				<tr>
					<td>ReEnter Password</td>
					<td>: <input type="password" name="password1" placeholder="Retype password"></td>
					<td class="error"><?php echo $pass1err; ?></td>
					<td class="error"><?php echo $pmatch; ?></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="register" value="Register" id="ibutton"></td>
				</tr>
			</table>
		</form>
	</div>
	<footer>
	<h6>Created by <a href="https://github.com/SairamNaragoni" target="_blank">Rogue</a></h6>
	</footer>
</div>
</body>
</html>