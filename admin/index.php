<?php 
include '../init.php';
	include '../include/main_query.php';

if (logged_admin() === false) {
	header('Location: login.php');
	exit();

}
?>

	<?php include 'header.php'; ?>



     <?php 
	  $result = mysql_query("SELECT * FROM users");
 $num_rows = mysql_num_rows($result);
	 
                          $id = max_id_ad();
                          list($array) = order_by_date_a();
						  
						  // For Checking the user Submit for cource
						  
// echo $_SERVER['PHP_SELF'];		
 $_SESSION['index']=	$_SERVER['PHP_SELF'];				 
                       
                        ?>


 <div id="view_products">
        	<h1>Student And Cources List 
            </h1>
           
            
            
<table width="100%" border="1">
              <tr>
                <td><h1>Student Name</h1></td>
                <td><h1>User Name</h1></td>
                <td><h1>Password</h1></td>
                 <td><h1>Email</h1></td>
                   <td><h1>Cource</h1></td>
                   <td><h1>Active</h1></td>
                     <td><h1>Delete</h1></td>
              </tr>
<?php  for ($i = 0; $i <$num_rows ; $i++){
	 list($id,$Name,$cource_name,$pas,$email,$username,$c_id) = fetch_student($array[$i]);
	
	?>
<tr>


<td><p><?php echo $Name ;?></p></td>
<td><p><?php echo  $username;?></p></td>
<td><p><?php echo  $pas;?></p></td>
<td><p><?php echo  $email;?></p></td>
<td><p><?php echo  $cource_name;?></p></td>
<td>  <?php $zero=0; 
$sql=mysql_query("SELECT * FROM s_cource WHERE s_id='$id' AND active='$zero'");
//$sql1=mysql_query("SELECT * FROM s_cource WHERE s_id='$id' AND active='$one'");
 //$row= mysql_num_rows($sql1);
 
 $rows= mysql_num_rows($sql);
 //if($row<0){
 if($rows>0)
 { echo  "<a href ='success.php?id=$id'><img src='../inc/images/success.png' img style='margin-left:5px; border: solid 1px #0066FF;'/></a></td>"?><?php }?>
<td>    <a href ="delete.php?id=<?php echo $id;?>"><img src="../inc/images/error.png" img style="margin-left:5px; border: solid 1px #0066FF;"/></a></td>




<?php }


?>




