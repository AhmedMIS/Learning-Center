<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Meeting</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css" />
<link rel="stylesheet" type="text/css" href="../include/css/chosen.min.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />

  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  
  
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    
    <!-- Load jQuery JS -->
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <!-- Load jQuery UI Main JS  -->
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    
  
  
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>




</head>







<?php
include '../init.php';
include '../include/main_query.php';

if (logged_admin() === false) {
	header('Location: login.php');
	exit();
}


function test_input($data) {
  $data = mysql_real_escape_string($data);
  $data = trim($data);
  $data = stripslashes($data);
  $data = strip_tags($data);
  $data = htmlspecialchars($data);
  $data = preg_split('/[\s]+/', $data);
  $data	= implode(" ",$data);
  return $data;
}
if(isset($_POST['submit'])){
	
	$teacher	=$_POST['teacher'];

	$cource		= $_POST['cource'];
	
	$time=$_POST['time'];
	
	$room=$_POST['room'];
	
	$date=$_POST['date'];


$check=mysql_query("SELECT `id` FROM `time_table` WHERE `c_id`='$cource' AND `t_id`='$teacher' AND `timing_id`='$time' ");
$time_check=mysql_query("SELECT `id` FROM `time_table` WHERE `timing_id`='$time' AND `date`='$date' ");
$time_check_loop=@mysql_num_rows($time_check);
$sameTeacher= @mysql_num_rows($check);

 
if($sameTeacher>0)
{
	$errors[] = 'Already Assing Cource To Same Teacher At Same time';
		echo '<style type="text/css">
        #product_name{
			border:1px solid red;
		}
        </style>';
	
	}
	
	
	if($time_check_loop>0)
{
	$errors[] = 'Already Assing time';
		echo '<style type="text/css">
        #product_name{
			border:1px solid red;
		}
        </style>';
	
	}

	if (empty($date)) {
		$errors[] = 'Enter A Date.';
		echo '<style type="text/css">
        #product_name{
			border:1px solid red;
		}
        </style>';
	}
	
	
	
	if (empty($teacher)) {
		$errors[] = 'Select a Teacher Name.';
		echo '<style type="text/css">
        #product_name{
			border:1px solid red;
		}
        </style>';
	}
	
	if (empty($cource)) {
		$errors[] = 'Select A cource';
		echo '<style type="text/css">
        #details{
			border:1px solid red;
		}
        </style>';
	}
	
	if (empty($time)) {
		$errors[] = 'Select Time';
		echo '<style type="text/css">
        #details{
			border:1px solid red;
		}
        </style>';
	}
	
	if (empty($room)) {
		$errors[] = 'Select A Room for the class';
		echo '<style type="text/css">
        #details{
			border:1px solid red;
		}
        </style>';
	}
	
	
else {
	
	if (empty($errors)) {
		$sql = mysql_query("INSERT INTO time_table (`c_id`,`t_id`,`timing_id`,`date`,`r_id`) VALUES ('$cource','$teacher','$time','$date','$room')");
		
			
				if (!$sql) {
			echo 'Time Table Could not Be Added.';
		} 

else {
			echo 'Time Table are Added Succesfully.';

header('Location:index.php');
			  
		}
	
	 
	
	}
	}
	
	
	           }
			

include 'header.php'; 


?>
        <div id="add_product">
        	<h1>Time Table</h1>
            <?php 
			if (!empty($errors)) {
				foreach ($errors as $error) {
					echo '<p>&#9658 '.$error.'</p>';
				}	
			}?>
        	<form action="" method="POST" enctype="multipart/form-data">
        	<table width="100%" border="0">
              <tr>
                <td>Select A Teacher:
              
                
                  <select name="teacher" id="teacher">
<option value=''>Select Teacher</option>";


<?php


$sql = mysql_query("SELECT * FROM teachers");
$count = @mysql_num_rows($sql);
if($count>0)
{
	while($row = mysql_fetch_array($sql))
	{
		
		
		echo "<option value=$row[id]>$row[t_name]</option>";
	}
		}


?>

</select>
                
                
                
                
                
                
                
                </td>
              </tr>
              <tr>
                <td>Select A Cource:
               
              <select name="cource" id="cource">
<option value=''>Select Cource</option>";
<br>

<?php
$sql = mysql_query("SELECT * FROM cource");
$count = @mysql_num_rows($sql);
if($count>0)
{
	while($row = mysql_fetch_array($sql))
	{
		echo "<option value=$row[id]>$row[cource_name]</option>";
	echo "$row[id]";
	}
		}

?>
</select>
               </td>
              </tr>
              
              
               <tr>
                <td>Select Time:
               
              <select name="time" id="time">
<option value=''>Select Time</option>";
<br>

<?php
$sql = mysql_query("SELECT * FROM time");
$count = @mysql_num_rows($sql);
if($count>0)
{
	while($row = mysql_fetch_array($sql))
	{
		$time=$row[slots];
		echo $time;
		
		echo "<option value=$row[id]>$time</option>";
	echo "$row[id]";
	}
		}

?>
</select>
               </td>
              </tr>
              
              
              
              
              
               <tr>
                <td>Select A ROOM:
               
              <select name="room" id="room">
<option value=''>Select ROOM</option>";
<br>

<?php
$sql = mysql_query("SELECT * FROM room");
$count = @mysql_num_rows($sql);
if($count>0)
{
	while($row = mysql_fetch_array($sql))
	{
		echo "<option value=$row[id]>$row[room_no]</option>";
	echo "$row[id]";
	}
		}

?>
</select>
               </td>
              </tr>
              
              
              
              
     
              
              
               <tr>
    <td>Date
    
 
               <input type="date" name="date"  value="<?php echo date('Y-m-d'); ?>" " >        
              
              
            </td>
            </tr>  
              
              
              
              
              
              
              
              <tr>
                <td>&nbsp;</td>
                <td style="border-right:none;"><input type="submit" name="submit" value="Submit"></td>
              </tr>
            </table>
        	</form>
		</div>
        <div class="clear"></div>
        <div id="footer">
        	<p>All rights reserved by Admin</p>
        </div>
	</div>
</body>
</html>