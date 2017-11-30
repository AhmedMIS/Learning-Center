

<?php

include '../init.php';
 
if (isset($_POST['submit'])) {
		$username = $_POST['username'];
	$password = $_POST['password'];

	
	
	if (empty($username) === true || empty($password) === true) {
		$errors[] = 'You need to enter a username and password.';
	} else if (t_exists($username) === false) {
		$errors[] = 'Teacher is not registered.';
	} else {
		$login = t_login($username, $password);
		if ($login === false) {
			$errors[] = 'Username/password combination is incorrect.';
		} else {
			$_SESSION['id'] = $login;
			echo $_SESSION['id'];
			if (isset($_SESSION['redirect'])) {
				//echo $_SESSION['redirect'];
				header("Location: ".$_SESSION['redirect']);
				exit();
			} else {
				header('Location: index.php');
				exit();
			}
		}
	}
}











?>






























<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Login</title>
<script type="text/javascript" src="inc/js/jquery-2.1.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="inc/css/global.css" />
<link rel="stylesheet" type="text/css" href="inc/css/login.css" />
</head>

<body>
<div id="wraper">
	<div id="top">
		<div class="header_wrapper">
			<div id="logo"><a href="#"><img src="inc/images/pm.png" border="0"></a></div>
			<div id="heading" > <h2 style="color:#FFF;">Teacher Login</h2></div>
		</div>
	</div>
	<div id="heading1"><h3>Please Enter Name And Password</h3></div>
	<div id="bottom" style="border-radius:100px;20px solid"/>
	<div id="login-pic">
    
        <?php if (!empty($errors)) { foreach ($errors as $error) { echo '<p>&#9658 '.$error.'</p>'; } }?>
    	<table width="100%" border="1">

		<img src="inc/images/Login.png"/>
		<div id="login-form">
			<form method="post" >
			<div id="field1">
				<div id="msgbar" ></div>
				<label for="user-name">Username</label>
				<input type="text" name="username" id="username" /><div id="error_username" class="color"> </div>
			</div>
			<div id="field2">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" /><div id="error_password" class="color"></div>
			</div>
			<div id="login-button">
				<input type="submit" name= "submit"  value="Login" id="login-btn" style="width:60px" />
				<input type="reset" value="Reset" style="width:60px" />
			</div>
			</form>
		</div>

	 </div>
</div>
<div id="Bottom-Border"></div>
<div id="footer"><font color="#3366FF"><b>©Copyright: 2016</b></font></div>
</body>
</html>
