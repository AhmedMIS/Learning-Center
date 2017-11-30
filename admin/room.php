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



if (isset($_POST['add_room'])) {
	
	$details		= test_input($_POST['details']);
	$r_no			= $_POST['r_no'];

if (empty($details)) {
		$errors[] = 'Enter details for Room.';
		echo '<style type="text/css">
        #details{
			border:1px solid red;
		}
        </style>';
	}

if (empty($r_no)) {
		$errors[] = 'Please Enter The Room NO.';
		echo '<style type="text/css">
        #r_no{
			border:1px solid red;
		}
        </style>';
	}


else{
	if (empty($errors)) {
		$sql=mysql_query("INSERT INTO room (`room_no`,`r_detail`) VALUES ('$r_no','$details')");
	
	if(!$sql)
	{echo 'Record not store';
		}
	else{
		echo 'Record store';
		header('Location:index.php');
		}
	exit();
	}	
	
	}









}









include 'header.php'; ?>
        <div id="add_product">
        	<h1>Add ROOM:</h1>
            <?php 
			if (!empty($errors)) {
				foreach ($errors as $error) {
					echo '<p>&#9658 '.$error.'</p>';
				}	
			}?>
        	<form action="" method="POST" enctype="multipart/form-data">
        	<table width="100%" border="0">
           
                <td>ROOM NO.</td>
                <td style="border-right:none;"><input type="text" name="r_no" id="r_no" maxlength="3" onKeyPress="return isNumberKey(event)" value="<?php if(isset($r_no)) echo $r_no?>" /></td>
              </tr>
              <tr>
                <td>Details:</td>
                <td style="border-right:none;"><textarea name="details" id="details" cols="64" rows="7" onKeyPress="if (this.value.length > 300) { return false; }"><?php if(isset($details)) echo $details?></textarea></td>
              </tr>
            
                <td>&nbsp;</td>
                <td style="border-right:none;"><input type="submit" name="add_room" value="Submit"></td>
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