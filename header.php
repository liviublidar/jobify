<?php
session_start();
require 'dbconnect.php';


?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title;?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="styles/screen.css" media="screen and (min-width: 700px)"/>
		<link rel="stylesheet" href="styles/mobile.css" media="screen and (max-width: 700px)" />
		<link href="http://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Damion" rel="stylesheet" type="text/css">
		<script src="scripts/jquery.js"></script>
		
	</head>
	<body>
		<header>
			<h1>Jobify</h1>
			<?php
			
			if(isset ($_SESSION['loggedin'])){
				if(($_SESSION['loggedin'])== true){
					echo 'Welcome back <br/> <a href="logout.php">Logout</a>';
				}
			}
			else{
				if(isset ($_POST['login'])){
					$stmt = $pdo->prepare('SELECT * FROM users WHERE mail = :mail AND pass = :password');
					$criteria = [
						'mail' => $_POST['mail'],
						'password' => $_POST['pwd']
					];
					$stmt->execute($criteria);

					if ($stmt->rowCount() > 0) {
						$_SESSION['loggedin'] = true;
						while ($row = $stmt->fetch()) {
							echo 'Welcome back ' . $row['fname']. ' <br/> <a href="logout.php">Logout</a>';
							$_SESSION['email']=$row['mail'];
							$_SESSION['admin']=$row['admin'];
						}
					}
					else {
						echo 'Sorry, your username and password could not be found';
					}
				}
			else{
			?>
			<div id="loginContainer" align="right">
				<form id="loginform" method="post">
					<label for "mail">E-mail adress: </label>
					<input id="mail" name="mail" type="email" "required"/>
					<br/>
					<label for "pass">Password: </label>
					<input id="pass" name="pwd" type="password" "required"/>
					<br/>
					<input type="submit" name="login" value="Login"/>
					<br/>
					<span>Don't have an account?</span>
					<a href="register.php">Register now</a><br/>
					<span>admin login: liviu.blidar94@gmail.com password: abcd</span>
				</form>
			</div>
			<?php 
				}
			}
			?>
			<div id="searchContainer">
				<form id="searchform" action="jobs.php" method="post">
					<input id="searchbar" name="searchkey" type="text" placeholder="Find jobs..." "required" autocomplete="off">
				</form>
			</div>
		</header>
		<nav align="center">
			<a href="index.php">Home </a><a href="jobs.php">Jobs </a>
			<?php
				if(isset($_SESSION['admin'])){
					if($_SESSION['admin'] == 'y'){
						echo'<a href="admin.php">Admin</a>';
					}
				}
			?>
		</nav>
		<main>