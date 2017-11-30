

<?php 
session_start();
require '../connect/connect.php';
require '../functions/user.php';
require '../functions/general.php';

if (logged_teacher() === false) {
	header('Location:t_login.php');
	exit();
}

?>

<?php 
 $t_id=($_SESSION['id']);
 
 

if(isset($_POST['submit'])){
	
		$cource	= $_POST['cource'];
		$date=$_POST['date'];
		$as_detail=$_POST['as_detail'];
		echo $cource;
$allowed_filetype=array("pdf");
$c_date= date('Y-m-d');	


		if (empty($cource)) {
		$errors[] = 'Enter a Cource.';
		echo '<style type="text/css">
        #product_name{
			border:1px solid red;
		}
        </style>';
	                         }
							 

            		
	if (empty($as_detail)) {
		$errors[] = 'Enter Some Important detail.';
		echo '<style type="text/css">
        #book_details{
			border:1px solid red;
		}
        </style>';
	                       }

	


	if (empty($date)) {
		$errors[] = 'Enter Submission Date.';
		echo '<style type="text/css">
        #price{
			border:1px solid red;
		}
        </style>';
                   	}
	


	
		if (empty($_FILES['fileField2']['name'])) {
		$errors[] = 'Please Select A PDF File.';
		echo '<style type="text/css">
        #fileField1{
			border:1px solid red;
		}
        </style>';
		                                          }
												  else{ 										 													 {
		$image_name_1	= $_FILES['fileField2']['name'];
		$image_size_1	= $_FILES['fileField2']['size'];
		$extension_1	= strtolower(end(explode(".", $image_name_1)));
		if (!in_array($extension_1, $allowed_filetype)) {
			$errors[] = 'File type "'. $image_name_1 .'" not allowed.';
	
                                                         } 
		/* else {
			if (@empty(getimagesize($_FILES["fileField1"]["tmp_name"]))) {
				$errors[] =  '"' . $image_name_1 . '" is not an image file.';
			}
		} */
		if ($image_size_1 > 3388608) {
			$errors[] = '"' . $image_name_1 . '" exceeds file size 3 MB.';
                               		}
	}

												  }


			
	if (empty($errors)) {
	
	
			  $t_id=($_SESSION['id']);
			
	
		$result = send_a($cource,$date, $as_detail,$c_date,$t_id);
	if ($result === false) {
	//		echo 'Cource Could not Be Added.';
	
	echo "results";
	
		                    } 

	else {
			//echo 'Cource added Succesfully.';
		$id_f		= $result;
	
			$directory	='teacher/assignment/' . $id_f;
		if (!is_dir($directory))	
			mkdir($_SERVER['DOCUMENT_ROOT'] . '/LC/teacher/assignment/' . $id_f, 0744);
		
			//move_uploaded_file( $_FILES['fileField1']['tmp_name'],$_SERVER['DOCUMENT_ROOT'] . '/Alkhuda/1/'.$directory .  "/$product_id.jpg");
	move_uploaded_file( $_FILES['fileField2']['tmp_name'],$_SERVER['DOCUMENT_ROOT'] . '/LC/'.$directory .  "/$id_f.pdf");
                
	
	


header('Location:index.php');
		exit();




	}

	



 
												 
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
 <?php include("header.php"); ?>
 <?php

			if (!empty($errors)) {
				
				foreach ($errors as $error) {
					echo '<p>&#9658 '.$error.'</p>';
				}	
			}?>
   <fieldset style="margin-top:50px; margin-left:135px; width:600px; height:325px; text-align:center;">
     <legend style="color:#06F; font-family:Verdana, Geneva, sans-serif;">Teacher Control Pannel</legend>
    
     
              
              
     <form action="" method="POST" enctype="multipart/form-data">
        	<table width="100%" border="0">
             
              <tr>
                <td>Assignmetn Details:</td>
                <td style="border-right:none;"><input type="text" name="as_detail" id="as_detail" maxlength="50" size="50" value="<?php if(isset($as_detail)) echo $as_detail;?>" /></td>
              </tr>
              
              <tr>
                
                
               
         
                  <tr>
                <td>Assignment File  :</td>
                <td style="border-right:none;">
                    <input type="file" name="fileField2" id="fileField2"  />
                </td>
                
              </tr>
                <td>Select Cource :
                
                
                </td> <td>             <select name="cource" id="cource">
<option value=''>Select Cource</option>";
<br>

<?php
$sql = mysql_query("SELECT * FROM c_teacher WHERE t_id='$t_id'");
$count = @mysql_num_rows($sql);
if($count>0)
{
		
	while($row = mysql_fetch_array($sql))
	{
	$c_id=$row['c_id'];
$sql1 = mysql_query("SELECT * FROM cource WHERE id='$c_id'");
	$row1=	 mysql_fetch_array($sql1);
		echo "<option value=$row1[id]>$row1[cource_name]</option>";
	echo "$row1[id]";
	
	
	}
		}

?>
</select>
               </td>

              
               <tr>
    <td>Submission Date
    
 </td>
 <td>
               <input type="date" name="date"  value="<?php echo date('Y-m-d'); ?>" " >        
              
              
            </td>
            </tr>  
              
                
                
                
                
                
                
                
                
                
                
                <td>&nbsp;</td>
                <td style="border-right:none;"><input type="submit" name="submit" value="Submit"></td>
              </tr>
            </table>

            
        	</form>
     </fieldset>
     <?php include("footer.php"); ?>
     </div>
     </body>
</html>