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
	  $result = mysql_query("SELECT * FROM cource");
 $num_rows = mysql_num_rows($result);
	 
                          $id = max_id();
                          list($array) = order_by_date();
                          $zero=0;
                        ?>

 <div id="view_products">
        	<h1>Cources List To add Books
            </h1>
           
            <a href="book_detail.php?id=<?php echo $zero  ?>">ADD A BOOK</a>
            
<table width="100%" border="1">
              <tr>
                <td><h1>Cource Name</h1></td>
                <td><h1>Details</h1></td>
                <td><h1>Price</h1></td>
                 <td><h1>Date Added</h1></td>
                   <td><h1>ADD A BOOK</h1></td>
              </tr>
<?php  for ($i = 0; $i <$num_rows ; $i++){
	 list($id, $cource_name, $cource_price, $cource_description) = product_data($array[$i]);
	
	
	?>
<tr>
<td>
<p><?php echo $cource_name ?></p><p><img src="inventory_images/products/<?php echo $array[$i] ?>/<?php echo $array[$i] ?>.jpg" width="100" height="100" alt="" /></p></td>
<td><p><?php echo $cource_description ?></p></td>
<td><p><?php echo $cource_price ?></p></td>
<td><p><?php  ?></p></td>
<td><p><a href="book_detail.php?id=<?php echo $array[$i] ?>">ADD A BOOK</a></p></td>



<?php }?>