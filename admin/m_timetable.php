<?php
include '../init.php';
include '../include/main_query.php';
include 'header.php';
if (logged_admin() === false) {
	header('Location: login.php');
	exit();
}
?>


     <?php 
	  $result = mysql_query("SELECT * FROM time_table");
 $num_rows = mysql_num_rows($result);
 
 
	 
                    $id = max_idt();
                        list($array) = order_by_datet();
                        
                        ?>

 <div id="view_products">
        	<h1>Manage Time Table
            </h1>
           
            
            
<table width="100%" border="1">
              <tr>
                <td><h1>Teacher Name</h1></td>
                <td><h1>Cource</h1></td>
                <td><h1>Room</h1></td>
                 <td><h1>Time</h1></td>
                   <td><h1>Date</h1></td>
                        <td><h1>Delet</h1></td>
              </tr>
              
              
              
               <?php  
			   
			   for ($i = 0; $i <$num_rows ; $i++){
	 list($id, $teacher_name, $cource_name, $room_no,$time,$date) = time_table($array[$i]);
	
	//echo "$teacher_name";
	
	?>
	<tr>

    
      
      <td><p><?php echo $teacher_name; ?></p></td>
      <td><p><?php echo $cource_name; ?></p></td>
       <td><p><?php echo $room_no; ?></p></td>
        <td><p><?php echo $time; ?></p></td>
       <td><p><?php echo $date; ?></p></td>
<td>    <a href ="delete_time.php?id=<?php echo $id;?>"><img src="../inc/images/error.png" img style="margin-left:5px; border: solid 1px #0066FF;"/></a></td>
    
    
    <?php }
	
	?>
	