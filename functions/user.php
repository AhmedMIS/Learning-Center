<?php

function all_users() {
	$i = 0;
	$sql = mysql_query("SELECT * FROM users");
	$usersCount = @mysql_num_rows($sql);
	if ($usersCount > 0) {
		while ($row = mysql_fetch_array($sql)) {
			$user_id[$i]	= $row['user_id'];
			$username[$i]	= $row['username'];
			$first_name[$i]	= $row['first_name'];
			$email[$i]		= $row['email'];
			$contact[$i]	= $row['contact'];
			$city[$i]		= $row['city'];
			$i = $i + 1;
		}
	} else {
		return 0;	
	}
	return array($user_id, $username, $first_name, $email, $contact, $city);
}

function recover_admin($mode, $email) {
	$mode	= sanitize($mode);
	$email	= sanitize($email);
	
	$admin_data = admin_data(admin_id_from_email($email), 'username');
	
	if ($mode == 'username') {
		mail($email, 'Your username', "Hello " . $admin_data['username']. ",\n\nYour username is: " . $admin_data['username'] . "\n\nFrom: Smart-Store");
	} else if ($mode == 'password'){
		
	}
}
function recover_user($mode, $email) {
	$mode	= sanitize($mode);
	$email	= sanitize($email);
	
	$user_data = user_data(user_id_from_email($email), 'user_id', 'username', 'first_name');
	
	if ($mode == 'username') {
		mail($email, 'Your Username', "Hello " . $user_data['first_name']. ",\n\nYour username is: " . $user_data['username'] . "\n\nFrom: Smart-Store");
	} else if ($mode == 'password'){
		$generated_password = substr(md5(rand(999, 999999)), 0, 8);
		change_password($user_data['user_id'], $generated_password);
		mail($email, 'Your Password Recovery', "Hello " . $user_data['first_name']. ",\n\nYour new password is: " . $generated_password . "\n\nFrom: Smart-Store");
	}
}

function activate($email, $email_code) {
	$email = sanitize($email);
	$email_code = sanitize($email_code);
	
	if (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' AND `email_code` = '$email_code' AND `active` = 0"), 0) == 1) {
		mysql_query("UPDATE `users` SET `active` = 1 WHERE `email` = '$email'");
	} else {
		return false;
	}
}

function change_password($user_id, $password) {
	$user_id = (int)$user_id;
	$password = md5($password);
	
	mysql_query("UPDATE `users` SET `password` = '$password' WHERE `user_id` = '$user_id'");
}

function register_user($register_data) {
	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = md5($register_data['password']);
	
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\', \'', $register_data) . '\'';

	mysql_query("INSERT INTO `users` ($fields) VALUES ($data)");
	mail($register_data['email'], 'Activate your account', "Hello " . $register_data['username'] . ",\n\nYou need to activate your account, so use the link below:\n\nhttp://ray114.byethost31.com/activate.php?email=" . $register_data['email'] . "&email_code=" . $register_data['email_code'] . "\n\n - smart-store");
}

function user_data($user_id) {
	$data = array();
	$user_id = (int)$user_id;
	
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	
	if ($func_num_args > 1) {
		unset($func_get_args[0]);
		
		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `users` WHERE `user_id`='$user_id'"));
		return $data;
	}
}

function admin_data($id) {
	$data = array();
	$id = (int)$id;
	
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	
	if ($func_num_args > 1) {
		unset($func_get_args[0]);
		
		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `admin` WHERE `id`='$id'"));
		return $data;
	}
}

function logged_in() {
	return (isset($_SESSION['user_id'])) ? true : false;
}

function logged_admin() {
	return (isset($_SESSION['admin_id'])) ? true : false;
}

function user_exists($username) {
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `username` = '$username'");
	
	
	
	return (mysql_result($query, 0) == 1) ? true : false;
}

function admin_exists($username) {
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`id`) FROM `admin` WHERE `username` = '$username'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function email_exists($email) {
	$email = sanitize($email);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function user_active($username) {
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `active` = 1");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function user_id_from_username($username) {
	$username = sanitize($username);
	return mysql_result(mysql_query("SELECT `id` FROM `users` WHERE `username`='$username'"), 0, 'id');
}
function user_id_from_email($email) {
	$email = sanitize($email);
	return mysql_result(mysql_query("SELECT `user_id` FROM `users` WHERE `email`='$email'"), 0, 'user_id');
}
function admin_id_from_email($email) {
	$email = sanitize($email);
	return mysql_result(mysql_query("SELECT `id` FROM `admin` WHERE `email`='$email'"), 0, 'id');
}

function login($username, $password) {
	$user_id = user_id_from_username($username);
	
	$username = sanitize($username);
	$password = $password;
	
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `username`='$username' AND `password`='$password'"), 0) == 1) ? $user_id :false;
}

function logged_user() {
	return (isset($_SESSION['u_id'])) ? true : false;
}



function email_already($email){
	
	$email = sanitize($email);
	$sql=mysql_query("SELECT `email` FROM `users` WHERE `email`='$email'");
	$row=mysql_num_rows($sql);
if($row>0)
{
	return true;
	}
	else
	{
		return false;}
	
	
	
	}
	
	
	
	
	
	
function add_users($username,$password,$email,$verification){
	$email = sanitize($email);
	$password=sanitize($password);
$username=	sanitize($username);
$active=0;


$sql=mysql_query("INSERT INTO users (username,password,email,verification,active) VALUES ('$username','$password','$email','$verification','$active')");
if(mysql_query($sql))
{
	return true;
	}
else{
	
	return true;
	}

	
	}




function verify($email,$verification)
{
	$to      = "mustafaahmed25@gmail.com"; // Send email to our user
$subject = 'Signup | Verification'; // Give the email a subject 
$message = '
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------
Username: '.$name.'

------------------------
 
Please click this link to activate your account:

http://localhost:1234/lc/verify.php?email='.$email.'&hash='.$verification.'
 
'; // Our message above including the link
$from='mustafaahmed25@gmail.com';            
$headers = "From: mustafaahmed25@gmail.com" . "\r\n" . // Set from headers
mail($to, $subject, $message, $headers); // Send our email
if(mail)
{
	return true;
	}else 
	{
	return false;
		}
	
	}









///****************Teacher  FUNCTIONS******************///


function t_login($username, $password) {
	$user_id = user_id_from_t_username($username);
	
	$username = sanitize($username);
	//$password = md5($password);
	
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `teachers` WHERE `t_username`='$username' AND `t_password`='$password'"), 0) == 1) ? $user_id :false;
}

//Fetching the Teacher Id
function user_id_from_t_username($username) {
	$username = sanitize($username);
	return mysql_result(mysql_query("SELECT `id` FROM `teachers` WHERE `t_username`='$username'"), 0, 'id');
}



//Check weather the  teacher Exists

function t_exists($username) {
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`id`) FROM `teachers` WHERE `t_username` = '$username'");
	
	
	
	return (mysql_result($query, 0) == 1) ? true : false;
}

function logged_teacher() {
	return (isset($_SESSION['id'])) ? true : false;
}


//Sending Assingment
function send_a($cource,$date, $as_detail,$c_date,$t_id){
	
	$sql=mysql_query("INSERT INTO assignment (c_id,c_date,submission_date,a_detail,t_id) VALUES ('$cource','$c_date','$date','$as_detail','$t_id')");
if(mysql_query($sql))
	{
			return mysql_insert_id();
		
		}else
		{
		return mysql_insert_id(); 
			}
	
	
	}





function admin_id_from_username($username) {
	$username = sanitize($username);
	return mysql_result(mysql_query("SELECT `id` FROM `admin` WHERE `username`='$username'"), 0, 'id');
}


function log_admin($username, $password) {
	$user_id = admin_id_from_username($username);
	
	$username = sanitize($username);
	//$password = md5($password);
	$query = mysql_query("SELECT COUNT(`id`) FROM `admin` WHERE `username`='$username' AND `password`='$password'");
	return (mysql_result($query, 0) == 1) ? true : false;
	//return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `admin` WHERE `username`='$username' AND `password`='$password'"), 0) == 1) ? $user_id :false;
}

?>