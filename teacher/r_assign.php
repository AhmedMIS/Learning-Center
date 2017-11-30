
<?php 
session_start();
require '../connect/connect.php';
require '../functions/user.php';
require '../functions/general.php';
include '../include/main_query.php';

  $result = mysql_query("SELECT * FROM s_assignment");
 $num_rows = mysql_num_rows($result);

if (logged_teacher() === false) {
	header('Location:t_login.php');
	exit();
}


 

  $id = max_id_r_assi();
  list($array) = order_by_date_r_assi();
 	
	
	

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
				<span id="form_heading">Recieved Assignment</span>
			</div>
             <div id="project_holder">
             
             <div class="project_row row_heading">
					<div class="project_cell _num"> Cource</div>
					<div class="project_cell _text">Student Name</div>
					<div class="project_cell _text">Last Date </div>
					<div class="project_cell _text">Submitted Date</div>
					<div class="project_cell _text">Download File</div>
                   
					
				</div>
     


<?php  for ($i = 0; $i <$num_rows ; $i++){
	 list($id,$c_id,$as_id,$s_date,$s_name,$last_date,$s_id) = tr_assignment($array[$i]);
	
	
	?>

  <div class="project_row row_heading">
  
                    <div class="project_cell _num"> <?php echo $c_id?></div>
					<div class="project_cell _text"> <?php echo $s_name?></div>
					<div class="project_cell _text"><?php echo date('F d, Y ', strtotime($last_date));?></div>
					<div class="project_cell _text"><?php echo date('F d, Y ', strtotime($s_date));?></div>
					
			<a href="../teacher/student_assignment/<?php echo $as_id?>/<?php echo $s_id?>.pdf" download="<?php echo $s_name?> assingment">
            
		<div class="project_cell _text">Download File</div>
			</a>		
            
				</div>
     




<?php
}
include 'footer.php';


?>

</div>
</body>
</html>
