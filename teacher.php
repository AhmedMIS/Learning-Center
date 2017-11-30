<?php include 'header.php';

include 'init.php';
include 'include/main_query.php';



?>


</div>
</div>
<div class="body2">
  <div class="main">
    <!-- content -->
    <section id="content">
      <div class="box1">
        <div class="wrapper">
          <article class="col1">
            <div class="pad_left1">
              <h2 class="pad_bot1">OUR Teachers</h2>
            </div>
            
             <?php    
 $result = mysql_query("SELECT * FROM teachers");
 $num_rows = mysql_num_rows($result);
	 
                          $id = max_id_t_();
                          list($array) = order_by_date_();
						  
						  						  
 
 for ($i = 0; $i <4 ; $i++){
	 
	  list($id,$t_name,$t_username,$t_pass) = teac($array[$i]);
	  
	  
	             ?>

             
            
            <div class="wrapper pad_bot2">
              <figure class="left marg_right1"><img src="admin/Data/Teachers/<?php echo $array[$i] ?>/<?php echo $array[$i] ?>.jpg"  height="150" width="250" /></figure>
              <p class="pad_bot1 pad_top2"><strong><?php echo $t_name;?></strong> <br>
                Dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt.</p>
              <a href="register.php" class="button marg_left1"><span><span>Subscribe</span></span></a> </div>

            
            
            
            




<?php 
 }
 ?>
 
 
</article> 
 
 <article class="col2 pad_left2">
            <div class="pad_left1">
             
            </div>
           
            <div class="pad_left1">
              <h2>Testimonials</h2>
              <p class="quot"> <span><strong><a href="#">William Horner</a></strong></span> <span class="color1">Managing Director</span> <span class="color2 pad_bot1">Company Name</span> Nam libero tempore, cum soluta nobis esteligendi optio cumque nihil impedit quo minusid quod maxime placeat facere possimus, omnis voluptas assumenda estmnis dolor repellendus. </p>
            </div>
            <a href="#" class="button marg_top1"><span><span>&nbsp;&nbsp; View All &nbsp;&nbsp;</span></span></a> </article>
        </div>
      </div>
    </section>

 
 
 
 

 
 
 
 
 
 
 
 
 
 
 
 
 
 
<?php include 'm_footer.php'?>
