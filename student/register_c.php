
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





if(empty($_GET['id'])){
//	header('Location:page_not_found.php');
			exit();
	
	}
	
	if (!strlen($_GET['id']==0) && !empty($_GET['id'])) {
		if (preg_replace('#[^A-Za-z]#i', '', $_GET['id'])) {
    		header('Location:page_not_found.php');
			exit();
		}
		else {
			$id=$_GET['id'];
			
			}
		
	}

 	$sql=mysql_query("SELECT * FROM s_cource WHERE s_id='$id'");
	$row=mysql_num_rows($sql);
	if($row>0)
	{
		
		$errors[] = 'Already Selected A cource';
		echo '<style type="text/css">
        #details{
			border:1px solid red;
		}
        </style>';
		}
	
	
	if(isset($_POST['submit'])){
		
		$cource		= $_POST['cource'];
echo $cource;
if (empty($cource)) {
		$errors[] = 'Select A cource';
		echo '<style type="text/css">
        #details{
			border:1px solid red;
		}
        </style>';
	}	
												  
												  
	 if (empty($errors)) {
		  $s_id=($_SESSION['u_id']);
		  
		  if(s_cource($cource,$s_id)==true)
		  {header('Location:index.php');
		exit();
			  }
	
		
	
	


//header('Location:index.php');
	//	exit();
	
	
	
												  }
	
	
	}
	
	
	
	
	
	
	

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
  <?php

			if (!empty($errors)) {
				
				foreach ($errors as $error) {
					echo '<p>&#9658 '.$error.'</p>';
				}	
			}?>
			<div class="cb"></div>
			<div class="">
				<span id="form_heading">Register Cources</span>
			</div>
             <div id="project_holder">
               <form action="" method="POST" enctype="multipart/form-data">
             <table width="100%" border="1">          
             <tr>
             <td>Cource Name:
             </td>
             
             <td>
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
</select>             </td>
         
         
      
         
         
             </tr>
      
      <tr>
      <td>Active</td>
      <td></td>
      
      </tr>
      
             
            <td style="border-right:none;"></td>
             <td style="border-right:none;"><input type="submit" name="submit" value="Submit"></td>
            </tr>	
            
            
             
             </table>
       




            
			</a>		
            
          
     




<?php

include 'footer.php';


?>

</div>
</body>
</html>
