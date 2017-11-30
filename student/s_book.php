
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







                    $id = max_idb();
                        list($array) = order_by_dateb();




$sql=mysql_query("SELECT * FROM s_cource WHERE s_id='$_SESSION[u_id]'");
 $num_rows = mysql_num_rows($sql);


if($num_rows>0)
{
	$row = mysql_fetch_array($sql);
	$cource_id=	$row['c_id'];
	$active=$row['active'];
$_SESSION['c_id']=$cource_id;

if($active==1)
{
} else $no=	"Wait for the Admin TO active you";
	

	$sql1=mysql_query("SELECT * FROM cource WHERE id='$cource_id'");
	if($sql1){
	
while($row1 = mysql_fetch_array($sql1))
                                   {
	$des=$row1['cource_description'];
 $c_name=$row1['cource_name'];
$_SESSION['c_name']= $c_name;
                                    }
	} else echo "no";
	
	} else echo "yes";



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
     <legend style="color:#06F; font-family:Verdana, Geneva, sans-serif;">Download Books</legend>
   <div id="body">
			<div class="cb"></div>
			<div class="">
				
			</div>
             <div id="project_holder">
           
             <div class="project_row row_heading">
					<div class="project_cell _text	"> Cource</div>
					<div class="project_cell _text">BOOK Name</div>
					<div class="project_cell _text">Download File</div>
                   
					
				</div>
     
     <?php 
	 
	 
	 $sql=mysql_query("SELECT * FROM s_cource WHERE s_id='$_SESSION[u_id]'");
	  $num_rows = mysql_num_rows($sql);


if($num_rows>0)
{
	
	$row = mysql_fetch_array($sql);
	$cource_id=	$row['c_id'];
	$active=$row['active'];
	if($active==1)
	{
		

	 
	 
	 
	  for ($i = 0; $i <2 ; $i++){
	 list($b_id,$b_name) = fbook($array[$i],$cource_id);
	
	
	?>
     <div class="project_row row_heading">
					<div class="project_cell _text"> <?php echo $c_name?></div>
				
                    <div class="project_cell _text"><?php echo $b_name[$i]?></div>
			
			<a href="../admin/inventory/Books/<?php echo $b_id?>/<?php echo $b_id?>.pdf" download="<?php echo $b_name?>">
            
		<div class="project_cell _text">Download File</div>
			</a>		
            
          
            
            
				</div>
     




<?php
}


}else echo "<h2 style='color:#C30'>wait for the admin to activate you!!</h2>";

	}


?>
     
     
     
     
     
     
     
     
     
     
     
     <div id="icons2" >
     
  </div>   
     </fieldset>
     <?php include("footer.php"); ?>
     </div>
     </body>
</html>