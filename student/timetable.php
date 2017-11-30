
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
	
if(isset($_SESSION['c_name']))
{
$s_id=($_SESSION['u_id']);
$c_id=$_SESSION['c_id'];
$c_name=$_SESSION['c_name'];
  
  
 $result = mysql_query("SELECT * FROM time_table WHERE c_id='$c_id'");
 $num_rows = mysql_num_rows($result);
 while($rows=mysql_fetch_array($result))
 {
	 $tid=$rows['t_id'];
	 }
 
 
 $num_rows;
 
 
 $sql=mysql_query("SELECT t_name FROM teachers WHERE id='$tid'");
 $row=mysql_fetch_array($sql);
 $t_na=$row['t_name'];

 $GLOBALS['t_na']=$row['t_name'];


}


///
//echo $tid;
  
 
	 
                    $id = max_idt();
                        list($array) = order_by_datet();
                        
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

    
     <table width="100%" border="1">
     <tr>
                <td><h1>Teacher Name</h1></td>
                <td><h1>Cource</h1></td>
                <td><h1>Room</h1></td>
                 <td><h1>Time</h1></td>
                   <td><h1>Date</h1></td>
                       
              </tr>
              
              
               <?php  
			   
			   if(isset($_SESSION['c_name']))
{
			   
			   for ($i = 0; $i <$num_rows ; $i++){
	 list($id, $teacher_name, $cource_name, $room_no,$time,$date) = time_table_s($array[$i]);
	
	//echo "$teacher_name";
	
	?>
	<tr>

    
      
      <td><p><?php echo $teacher_name[$i]; ?></p></td>
      <td><p><?php echo $cource_name[$i]; ?></p></td>
       <td><p><?php echo $room_no[$i]; ?></p></td>
        <td><p><?php echo $time[$i]; ?></p></td>
       <td><p><?php echo date('F d, Y ', strtotime($date[$i]));?></p></td>
      
    
    
    <?php }
               }else {
				   echo "<p style='color:#FFA500' >Register for the Cource First.</p>";
				   }
	?>
              
              
              
              
              
              
              
              
              
              
              
              
              
              
</table>
    
     </fieldset>
     <?php include("footer.php"); ?>
     </div>
     </body>
</html>


