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
	  $result = mysql_query("SELECT * FROM c_teacher");
 $num_rows = mysql_num_rows($result);
	 
                          $id = max_id_t_c();
                          list($array) = order_by_date_t();
                       
                        ?>


 <div id="view_products">
        	<h1>Teacahers And Cources 
            </h1>
           
            
            
<table width="100%" border="1">
              <tr>
                <td><h1>Teacher Name</h1></td>
                   <td><h1>Cource</h1></td>
                     <td><h1>Delete</h1></td>
              </tr>
<?php  for ($i = 0; $i <$num_rows ; $i++){
	
	 list($id,$cource_name,$t_name,$t_username,$t_pass,$t_id) = c_teac($array[$i]);
	
	?>
<tr>



<td><p><?php echo  $t_name;?></p></td>
<td><p><?php echo $cource_name ;?></p></td>
<td>    <a href ="delete_teacher.php?id=<?php echo $id;?>"><img src="../inc/images/error.png" img style="margin-left:5px; border: solid 1px #0066FF;"/></a></td>






<td><p><?php  ?></p></td>

<?php }?>