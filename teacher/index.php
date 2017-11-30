
<?php 
session_start();
require '../connect/connect.php';
require '../functions/user.php';
require '../functions/general.php';

if (logged_teacher() === false) {
	header('Location:t_login.php');
	exit();
}


$t_id=($_SESSION['id']);

 $sql=mysql_query("SELECT t_name FROM teachers WHERE id='$t_id'");
 $row=mysql_fetch_array($sql);
 $t_na=$row['t_name'];

 $GLOBALS['t_na']=$row['t_name'];
 $_SESSION['username'] = $t_na;









?>







<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../inc/css/global.css" />
<link rel="stylesheet" type="text/css" href="../inc/css/pmsadmin.css" />
</head>

<body>

<div id="wraper">
 <?php include("header.php"); ?>
 
   <fieldset style="margin-top:50px; margin-left:135px; width:600px; height:325px; text-align:center;">
     <legend style="color:#06F; font-family:Verdana, Geneva, sans-serif;">Teacher Control Pannel</legend>
     <div id="icons1">
     <a href ="assign.php"><img  src="inc/images/NewAs.png" img style="margin-left:5px; border: solid 1px #0066FF; "/></a>
     <a href ="r_assign.php"><img src="inc/images/RecAss.png" img style="margin-left:40px; border: solid 1px #0066FF;"/></a>
     <a href ="newmeeting.php"><img src="inc/images/dis.png" img style="margin-left:40px; border: solid 1px #0066FF;"/></a>
     <a href ="timetable.php"><img src="inc/images/tt.png" img style="margin-left:40px; border: solid 1px #0066FF;"/></a>
     </div>
    
     </fieldset>
     <?php include("footer.php"); ?>
     </div>
     </body>
</html>