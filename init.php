<?php
session_start();

require 'connect/connect.php';
require 'functions/user.php';
require 'functions/general.php';


if (logged_in() === true) {
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'user_id', 'username', 'password', 'email');
	//deactivate account
	//if (user_active($user_data['username']) === false) {
	//	session_destroy();
		//header("Location: index.php");
		//exit();
	//}
}

$errors = array();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="style1.css" type="text/css" media="screen" />
</head>