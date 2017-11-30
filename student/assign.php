
<?php 
session_start();
require '../connect/connect.php';
require '../functions/user.php';
require '../functions/general.php';
include '../include/main_query.php';

  


if (logged_user() === false) {
	header('Location:login.php');
	exit();
}
$uid=$_SESSION['u_id'];

$sql = mysql_query("SELECT * FROM s_cource WHERE s_id='$uid'");
$row = mysql_fetch_array($sql);
$_SESSION['c_id']=$row['c_id'];

$c=$_SESSION['c_id'];

  
 	
	
	$result = mysql_query("SELECT * FROM assignment WHERE c_id='$c'");
 $num_rows = mysql_num_rows($result);
 $id = max_id_assi();
 list($array) = order_by_date_assi();

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
<?php 
include 'header.php';

?>

 <div id="body">
			<div class="cb"></div>
			<div class="">
				<span id="form_heading">Assignment</span>
			</div>
             <div id="project_holder">
             
             <div class="project_row row_heading">
					<div class="project_cell _num"> Cource</div>
					<div class="project_cell _text">Teacher Name</div>
					<div class="project_cell _text">Last Date </div>
					<div class="project_cell _text">Date</div>
					<div class="project_cell _text">Download File</div>
                   
					<div class="project_cell _link">Send</span></div>
				</div>
     


<?php  for ($i = 0; $i <$num_rows ; $i++){
	 list($id,$cource_name,$t_name,$c_date,$date) = r_assignment($array[$i]);
	
	
	?>

  <div class="project_row row_heading">
					<div class="project_cell _num"> <?php echo $cource_name?></div>
					<div class="project_cell _text"><?php echo $t_name?></div>
					<div class="project_cell _text"><?php echo date('F d, Y ', strtotime($date));?></div>
					<div class="project_cell _text"><?php echo date('F d, Y ', strtotime($c_date));?></div>
			<a href="../teacher/assignment/<?php echo $id?>/<?php echo $id?>.pdf" download="<?php echo $cource_name?> assingment">
            
		<div class="project_cell _text">Download File</div>
			</a>		
            
            <a href="s_assign.php?id=<?php echo $id?>">
            					<div class="project_cell _link">Send</span></div>
                                </a>
            
            
				</div>
     




<?php
}
include 'footer.php';


?>

</div>
</body>
</html>
