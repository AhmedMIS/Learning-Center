<?php
include '../init.php';
include '../include/main_query.php';

if (logged_admin() === false) {
	header('Location: login.php');
	exit();
}




//if (!isset($_GET['id']) || empty($_GET['id'])) {
	//header('Location:page_not_found.php');
	//exit();
//} 

//else { 

	
	//	$result = exists_id($_GET['id']);
	//if ($result === false) {
		//header('Location:page_not_found.php');
		//exit();
	//}

	
	if (!strlen($_GET['id']==0) && !empty($_GET['id'])) {
		if (preg_replace('#[^A-Za-z]#i', '', $_GET['id'])) {
    		header('Location:page_not_found.php');
			exit();
		}
		else {
			$id=$_GET['id'];
			
			}
		
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

if (isset($_POST['add_book'])) {
	$book_name	= test_input($_POST['book_name']);

	$book_details		= test_input($_POST['book_details']);
	$price			= $_POST['price'];

	
	$allowed_ext = array("gif", "jpeg", "jpg", "png");
	$allowed_filetype=array("pdf");
	
	if (empty($book_name)) {
		$errors[] = 'Enter a book_name.';
		echo '<style type="text/css">
        #product_name{
			border:1px solid red;
		}
        </style>';
	}
	
	if (empty($book_details)) {
		$errors[] = 'Enter book_details for Product.';
		echo '<style type="text/css">
        #book_details{
			border:1px solid red;
		}
        </style>';
	}
	
	if (empty($price)) {
		$errors[] = 'Enter Price in US Dollors.';
		echo '<style type="text/css">
        #price{
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



	
		if (empty($_FILES['fileField2']['name'])) {
		$errors[] = 'Please Select A PDF File.';
		echo '<style type="text/css">
        #fileField1{
			border:1px solid red;
		}
        </style>';
	} else {
		$image_name_1	= $_FILES['fileField2']['name'];
		$image_size_1	= $_FILES['fileField2']['size'];
		$extension_1	= strtolower(end(explode(".", $image_name_1)));
		if (!in_array($extension_1, $allowed_filetype)) {
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
		$result = add_book($book_name,  $book_details, $price,$id);
	if ($result === false) {
			echo 'Cource Could not Be Added.';
		} 
		else {
			//echo 'Cource added Succesfully.';
		$product_id		= $result;
			$directory	='admin/inventory/Books/' . $product_id;
		if (!is_dir($directory))	
			mkdir($_SERVER['DOCUMENT_ROOT'] . '/LC/admin/inventory/Books/' . $product_id, 0744);
		
			move_uploaded_file( $_FILES['fileField1']['tmp_name'],$_SERVER['DOCUMENT_ROOT'] . '/LC/'.$directory .  "/$product_id.jpg");
	move_uploaded_file( $_FILES['fileField2']['tmp_name'],$_SERVER['DOCUMENT_ROOT'] . '/LC/'.$directory .  "/$product_id.pdf");



		}
	//	header('Location:add_specs.php?id='.$product_id);
	header('Location:index.php');
		exit();
	}
}




?>

        <div id="add_product">
        	<h1>ADD BOOK</h1>
            <?php 
			if (!empty($errors)) {
				foreach ($errors as $error) {
					echo '<p>&#9658 '.$error.'</p>';
				}	
			}?>
        	<form action="" method="POST" enctype="multipart/form-data">
        	<table width="100%" border="0">
              <tr>
                <td>BOOk Name:</td>
                <td style="border-right:none;"><input type="text" name="book_name" id="book_name" maxlength="50" size="50" value="<?php if(isset($book_name)) echo $book_name?>" /></td>
              </tr>
              <tr>
                <td>BOOK Price:</td>
                <td style="border-right:none;"><input type="text" name="price" id="price" maxlength="3" onKeyPress="return isNumberKey(event)" value="<?php if(isset($price)) echo $price?>" /></td>
              </tr>
              <tr>
                <td>BOOK Details:</td>
                <td style="border-right:none;"><textarea name="book_details" id="book_details" cols="64" rows="7" onKeyPress="if (this.value.length > 300) { return false; }"><?php if(isset($book_details)) echo $book_details?></textarea></td>
              </tr>
              <tr>
                <td>BOOK Image :</td>
                <td style="border-right:none;">
                    <input type="file" name="fileField1" id="fileField1" accept="image/*" />
                </td>
         
                  <tr>
                <td>BOOK FILE  :</td>
                <td style="border-right:none;">
                    <input type="file" name="fileField2" id="fileField2" accept="image/*" />
                </td>
              </tr>
                <td>&nbsp;</td>
                <td style="border-right:none;"><input type="submit" name="add_book" value="Submit"></td>
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