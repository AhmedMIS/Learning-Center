
<?php 
session_start();
require '../connect/connect.php';
require '../functions/user.php';
require '../functions/general.php';

if (logged_user() === false) {
	header('Location:login.php');
	exit();
	
	
}
$s_id=($_SESSION['u_id']);
 $sql=mysql_query("SELECT Name FROM users WHERE id='$s_id'");
 $row=mysql_fetch_array($sql);
 $u_name=$row['Name'];
 
 echo $_SESSION['u_name'] = $u_name;


 
 


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
     <legend style="color:#06F; font-family:Verdana, Geneva, sans-serif;">Student Control Pannel</legend>
     <div id="icons1">
     <a href ="assign.php"><img src="../inc/images/View-Tasks.png" img style="margin-left:5px; border: solid 1px #0066FF;"/></a>
     <a href ="register_c.php?id=<?php echo $s_id?>"><img src="inc/images/ts.png" img style="margin-left:40px; border: solid 1px #0066FF;"/></a>
     <a href ="s_book.php"><img src="inc/images/book.png" img style="margin-left:40px; border: solid 1px #0066FF;"/></a>
     <a href ="timetable.php"><img src="inc/images/tt.png" img style="margin-left:40px; border: solid 1px #0066FF;"/></a> 
     </div>
     
     <div id="icons2">
     
     </fieldset>
     <?php include("footer.php"); ?>
     </div>
     </body>
</html>