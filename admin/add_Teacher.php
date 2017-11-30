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







include 'header.php';






//echo "IT IS regading the Adress of "+$id;

if (isset($_POST['add_teacher'])) {
	$teacher_name	= test_input($_POST['teacher_name']);

	$teacher_adress		= test_input($_POST['teacher_adress']);
    $teacher_degree   =test_input($_POST['teacher_degree']);

	$t_name=	$_POST['t_name'];
	$pass=$_POST['pass'];
	
	echo $t_name;
	echo $pass;
	$allowed_ext = array("gif", "jpeg", "jpg", "png");
	$allowed_filetype=array("pdf");



$sql=mysql_query("SELECT * FROM teachers WHERE t_username='$t_name'");
$row=mysql_num_rows($sql);
if($row>0)
	{
		
		$errors[] = 'User Name Already Assign';
		echo '<style type="text/css">
        #details{
			border:1px solid red;
		}
        </style>';
		}
	






	if (empty($teacher_name)) {
		$errors[] = 'Enter a teacher_name.';
		echo '<style type="text/css">
        #product_name{
			border:1px solid red;
		}
        </style>';
	}
	if (empty($t_name)) {
		$errors[] = 'Enter a Teacher User name.';
		echo '<style type="text/css">
        #product_name{
			border:1px solid red;
		}
        </style>';
	}
	
	if (empty($teacher_adress)) {
		$errors[] = 'Enter teacher_adress ';
		echo '<style type="text/css">
        #teacher_adress{
			border:1px solid red;
		}
        </style>';
	}
	
	if (empty($pass)) {
		$errors[] = 'Enter a Password.';
		echo '<style type="text/css">
        #product_name{
			border:1px solid red;
		}
        </style>';
	}
	if (empty($teacher_degree)) {
		$errors[] = 'Enter teacher_degree';
		echo '<style type="text/css">
        #teacher_adress{
			border:1px solid red;
		}
        </style>';
	}
	
	
	if (empty($_FILES['fileField1']['name'])) {
		$errors[] = 'Image 1 not selected.';
		echo '<style type="text/css">
        #fileField1{
			border:1px solid red;
		}
        </style>';
	} else {
		$image_name_1	= $_FILES['fileField1']['name'];
		$image_size_1	= $_FILES['fileField1']['size'];
		$extension_1	= strtolower(end(explode(".", $image_name_1)));
		if (!in_array($extension_1, $allowed_ext)) {
			$errors[] = 'File type "'. $image_name_1 .'" not allowed.';
		} /* else {
			if (@empty(getimagesize($_FILES["fileField1"]["tmp_name"]))) {
				$errors[] =  '"' . $image_name_1 . '" is not an image file.';
			}
		} */
		if ($image_size_1 > 3388608) {
			$errors[] = '"' . $image_name_1 . '" exceeds file size 3 MB.';
		}
	}



	

	if (empty($errors)) {
		$result = add_teacher($teacher_name,  $teacher_adress, $teacher_degree,$t_name,$pass);
	if ($result === false) {
			echo 'Cource Could not Be Added.';
		} 
		else {
			//echo 'Cource added Succesfully.';
		$t_id		= $result;
			$directory	='admin/Data/Teachers/' . $t_id;
		if (!is_dir($directory))	
			mkdir($_SERVER['DOCUMENT_ROOT'] . '/LC/admin/Data/Teachers/' . $t_id, 0744);
		
			move_uploaded_file( $_FILES['fileField1']['tmp_name'],$_SERVER['DOCUMENT_ROOT'] . '/LC/'.$directory .  "/$t_id.jpg");



		}
	//	header('Location:add_specs.php?id='.$product_id);
	header('Location:index.php');
		exit();
	}
}




?>

        <div id="add_product">
        	<h1>ADD Teacher Detail</h1>
            <?php 
			if (!empty($errors)) {
				foreach ($errors as $error) {
					echo '<p>&#9658 '.$error.'</p>';
				}	
			}?>
        	<form action="" method="POST" enctype="multipart/form-data">
        	<table width="100%" border="0">
              <tr>
                <td>Name:</td>
                <td style="border-right:none;"><input type="text" name="teacher_name" id="teacher_name" maxlength="50" size="50" value="<?php if(isset($teacher_name)) echo $teacher_name?>" /></td>
              </tr>
              
                 <td>Teacher User Name:</td>
                <td style="border-right:none;"><input type="text" name="t_name" id="t_name" maxlength="50" size="50" value="<?php if(isset($t_name)) echo $t_name?>" /></td>
              </tr>
              
              <td>Teacher User Password:</td>
                <td style="border-right:none;"><input type="password" name="pass" id="pass" maxlength="50" size="50" value="<?php if(isset($pass)) echo $pass?>" /></td>
              </tr>
              
                <td>Adress:</td>
                <td style="border-right:none;"><textarea name="teacher_adress" id="teacher_adress" cols="64" rows="7" onKeyPress="if (this.value.length > 300) { return false; }"><?php if(isset($teacher_adress)) echo $teacher_adress?></textarea></td>
              </tr>
              <tr><td>Qualification Detail</td>
                <td style="border-right:none;"><textarea name="teacher_degree" id="teacher_degree" cols="64" rows="7" onKeyPress="if (this.value.length > 300) { return false; }"><?php if(isset($teacher_degree)) echo $teacher_degree?></textarea></td>
              </tr>
              <tr>
                <td>Profile Image :</td>
                <td style="border-right:none;">
                    <input type="file" name="fileField1" id="fileField1" accept="image/*" />
                </td>
         
                  <tr>
             
                <td>&nbsp;</td>
                <td style="border-right:none;"><input type="submit" name="add_teacher" value="Submit"></td>
              </tr>
            </table>

            
        	</form>
		</div>
        <div class="clear"></div>
        <div id="footer">
        	<p>All rights reserved by Smart Store</p>
        </div>
	</div>
</body>
</html>