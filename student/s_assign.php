
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


$allowed_filetype=array("pdf");

if(empty($_GET['id'])){
	header('Location:page_not_found.php');
			exit();
	
	}
	
	if (!strlen($_GET['id']==0) && !empty($_GET['id'])) {
		if (preg_replace('#[^A-Za-z]#i', '', $_GET['id'])) {
    		header('Location:page_not_found.php');
			exit();
		}
		else {
			$id_b=$_GET['id'];
			
			}
		
	}

 	
	list($id,$cource_name,$t_name,$c_date,$date,$detail)=check_assignment($id_b);		
 $s_id=($_SESSION['id']);
	
	$sql=mysql_query("SELECT * FROM s_assignment WHERE s_id='$s_id' AND as_id='$id'");
	$row=mysql_num_rows($sql);
	if($row>0)
	{
			$errors[] = 'You Can not Submit Another One.';
		echo '<style type="text/css">
        #fileField1{
			border:1px solid red;
		}
        </style>';
		
		}
	
	if(isset($_POST['submit'])){
	
	if($c_date>$date)
	{
		$errors[] = 'Submission Date Had Gone.';
		echo '<style type="text/css">
        #fileField1{
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
		  $s_id=($_SESSION['id']);
		  
		echo $id;
		if(s_assingment($id,$s_id,$t_name,$cource_name)==true)
		{
			
			
			}else echo "no non ";
		 
		 
		  $s_id=($_SESSION['id']);
	
		$directory	='teacher/student_assignment/' . $id;
		if (!is_dir($directory))	
			mkdir($_SERVER['DOCUMENT_ROOT'] . '/LC/teacher/student_assignment/' . $id, 0744);
		
			//move_uploaded_file( $_FILES['fileField1']['tmp_name'],$_SERVER['DOCUMENT_ROOT'] . '/Alkhuda/1/'.$directory .  "/$product_id.jpg");
	move_uploaded_file( $_FILES['fileField2']['tmp_name'],$_SERVER['DOCUMENT_ROOT'] . '/LC/'.$directory .  "/$s_id.pdf");
                
	
	


//header('Location:index.php');
		exit();
	
	
	
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
<?php



		

//  for ($i = 0; $i <$num_rows ; $i++){
	 //list($id,$cource_name,$t_name,$c_date,$date) = r_assignment($array[$i]);
	
	
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
				<span id="form_heading">Assignment</span>
			</div>
             <div id="project_holder">
               <form action="" method="POST" enctype="multipart/form-data">
             <table width="100%" border="1">          
             <tr>
             <td>Cource Name:
             </td>
             
             <td>
             <?php echo $cource_name?>
             </td>
             </tr>
             
             <tr>
             
             <td>
             Assingment Out Line:
             </td>
             <td>
             <?php echo $detail?>
           </td>
             
             
             </tr> 
             
             
            <tr>
            <td>
             Last Date:
             </td>
             <td>
             <?php echo date('F d, Y ', strtotime($date));?>
             
             </td>
             
             
             </tr>
            
            
            
            <tr>
            <td>
            Teacher Name:
             </td>
             <td>
             <?php echo $t_name?></td>
             
             
             </tr>
            <tr>
            <td>
            Submitt Assignment:
             </td>
             <td style="border-right:none;">
                    <input type="file" name="fileField2" id="fileField2"  />
                </td>
             
             </tr>
            
            <tr>
            <td style="border-right:none;"></td>
             <td style="border-right:none;"><input type="submit" name="submit" value="Submit"></td>
            </tr>	
            
            
             
             </table>
             <div class="project_row row_heading">
					<div class="project_cell _num"> Cource</div>
					<div class="project_cell _text">Teacher Name</div>
					<div class="project_cell _text">Last Date </div>
					<div class="project_cell _text">Date</div>
					<div class="project_cell _text">Download File</div>
                   
				</div>
     




  <div class="project_row row_heading">
					<div class="project_cell _num"> <?php echo $cource_name?></div>
					<div class="project_cell _text"><?php echo $t_name?></div>
					<div class="project_cell _text"><?php echo date('F d, Y ', strtotime($date));?></div>
					<div class="project_cell _text"><?php echo date('F d, Y ', strtotime($c_date));?></div>
			<a href="../teacher/assignment/<?php echo $id?>/<?php echo $id?>.pdf" download="<?php echo $cource_name?> assingment">
            
		<div class="project_cell _text">Download File</div>
			</a>		
            
           
            
            
				</div>
     




<?php

include 'footer.php';


?>

</div>
</body>
</html>
