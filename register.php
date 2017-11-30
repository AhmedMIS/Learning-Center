<?php 

include 'header.php';
include 'init.php';



if (isset($_POST['submit'])) {
		$username = $_POST['name'];
	$password = $_POST['password'];
	$email=$_POST['email'];
 	$r_password = $_POST['r_password'];
		if (empty($username) === true || empty($password) === true||empty($password)===true||empty($r_password)===true) {
		$errors[] = 'You are Missing some thing Please Fill The Form Properly.';
		} else if(!($_POST['r_password']==$_POST['password']))
				{
			$errors[] = 'Your Password and Retype Does Not Match Please Fill Carefully.';
			}else if(email_already($email)==true){
				$errors[] = 'You are Already Regestered';
				
				} else{
					
					if(empty($errors)===true)
				{
					$verification=md5( rand(0,1000) );
					if(add_users($username,$password,$email,$verification)==true)
					{      
					echo "YOUR SOTRED";
					header('Location:student/login.php');
				exit();
							if(verify($username,$email)==true)
							{echo "I am Happy";
								}				
					}
					else
					{echo "Dont Make Me angry"; 
					}
					
					
				}	
					
					
					     }
			
		


}

?>
  
    <!-- / header -->
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
              <h2>Register Form</h2>
                 <?php if (!empty($errors)) { foreach ($errors as $error) { echo '<p>&#9658 '.$error.'</p>'; } }?>
             <form method="post">
    <div class="form-group">
                <div>
                  <div  class="wrapper"> <strong>Email:</strong>
                    <div class="bg">
              <div class="form-group">

             <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
             </div>
                    </div>
                  </div>
                  <div  class="wrapper"> <strong>Name</strong>
                    <div class="bg">
              <div class="form-group">

            <input type="text" name="name" class="form-control" id="" placeholder="Enter Your Name">
  </div>
                               </div>
                  </div>
                  <div  class="textarea_box"> <strong>Password:</strong>
                    <div class="bg">
    <div class="form-group">
          
            <input type="password" name="password" id="password" class="form-control"  placeholder="Enter password">
     </div>       
                                </div>
                  </div>
                  
                  <div  class="textarea_box"> <strong>Retype Password:</strong>
                    <div class="bg">
             <div class="form-group">
 
            <input type="password" name="r_password" id="r_password" class="form-control"  placeholder="Enter password">
            
</div>

                                </div>
                  </div>
      
        <div class="form-group">

                   <button type="submit" name="submit"class="btn btn-default">Submit</button>
</form>      
</div>
                   
                   
                  
            
            </div>
          </article>
          <article class="col2 pad_left2">
            <div class="pad_left1">
              <h2>THINGS TO NOTE <span>BEFORE REGESTEING</span></h2>
              <p>Quia voluptas sit aspernatur aut odit aut fugit, seduia consequuntur magni dolores eos qui ratione. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non.<br>
                numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur.</p>
            </div>
          </article>
        </div>
      </div>
    </section>
    <!-- content -->
    <!-- footer -->
   <?php include'm_footer.php'; ?>