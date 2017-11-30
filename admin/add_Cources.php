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
if (isset($_POST['add_product'])) {
	$product_name	= test_input($_POST['product_name']);

	$details		= test_input($_POST['details']);
	$price			= $_POST['price'];

	
	$allowed_ext = array("gif", "jpeg", "jpg", "png");
	
	if (empty($product_name)) {
		$errors[] = 'Enter a Product Name.';
		echo '<style type="text/css">
        #product_name{
			border:1px solid red;
		}
        </style>';
	}
	
	if (empty($details)) {
		$errors[] = 'Enter details for Product.';
		echo '<style type="text/css">
        #details{
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
	
	if (empty($errors)) {
		$result = add_product($product_name,  $details, $price);
		if ($result === false) {
			echo 'Cource Could not Be Added.';
		} else {
			//echo 'Cource added Succesfully.';
		$product_id		= $result;
			$directory	='admin/inventory_images/products/' . $product_id;
		if (!is_dir($directory))	
			mkdir($_SERVER['DOCUMENT_ROOT'] . '/LC/admin/inventory_images/products/' . $product_id, 0744);
		
			move_uploaded_file( $_FILES['fileField1']['tmp_name'],$_SERVER['DOCUMENT_ROOT'] . '/LC/'.$directory .  "/$product_id.jpg");
	



		}
	//	header('Location:add_specs.php?id='.$product_id);
		exit();
	}
}

include 'header.php'; ?>
        <div id="add_product">
        	<h1>Add cCource :</h1>
            <?php 
			if (!empty($errors)) {
				foreach ($errors as $error) {
					echo '<p>&#9658 '.$error.'</p>';
				}	
			}?>
        	<form action="" method="POST" enctype="multipart/form-data">
        	<table width="100%" border="0">
              <tr>
                <td>Cource Name:</td>
                <td style="border-right:none;"><input type="text" name="product_name" id="product_name" maxlength="50" size="50" value="<?php if(isset($product_name)) echo $product_name?>" /></td>
              </tr>
              <tr>
                <td>Price:</td>
                <td style="border-right:none;"><input type="text" name="price" id="price" maxlength="3" onKeyPress="return isNumberKey(event)" value="<?php if(isset($price)) echo $price?>" /></td>
              </tr>
              <tr>
                <td>Details:</td>
                <td style="border-right:none;"><textarea name="details" id="details" cols="64" rows="7" onKeyPress="if (this.value.length > 300) { return false; }"><?php if(isset($details)) echo $details?></textarea></td>
              </tr>
              <tr>
                <td>Image 1:</td>
                <td style="border-right:none;">
                    <input type="file" name="fileField1" id="fileField1" accept="image/*" />
                </td>
              </tr>
                <td>&nbsp;</td>
                <td style="border-right:none;"><input type="submit" name="add_product" value="Submit"></td>
              </tr>
            </table>
        	</form>
		</div>
        <div class="clear"></div>
        <div id="footer">
        	<p>All rights reserved by ADMIN</p>
        </div>
	</div>
</body>
</html>