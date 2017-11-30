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
	
	
$check=mysql_query("SELECT `id` FROM `c_teacher` WHERE `c_id`='$cource' AND `t_id`='$teacher'");

$a= @mysql_num_rows($check);

 
if($a>0)
{
	$errors[] = 'Already Assing Cource To Same Teacher';
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
	
	
else {
	
	if (empty($errors)) {
		$sql = mysql_query("INSERT INTO c_teacher (`c_id`,`t_id`) VALUES ('$teacher','$cource')");
		
			
				if (!$sql) {
			echo 'Cource Could not Be Added.';
		} 

else {
			echo 'Result are Added Succesfully.';

header('Location:index.php');
			  
		}
	
	 
	
	}
	}
	
	
	           }
			

include 'header.php'; 


?>
        <div id="add_product">
        	<h1>Assing Teacher To cource</h1>
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
		//echo "<br>Select Category first  <select name=cat id='s1' onchange=AjaxFunction();>
		//<option value='$row[id]'>$row[t_name]</option>";
		
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