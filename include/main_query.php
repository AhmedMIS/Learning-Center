<?php




//////////////**************Student Assingment Retreive query************///////////////

function r_assignment($id){
$c=	$_SESSION['c_id'];
	$sql = mysql_query("SELECT * FROM assignment WHERE c_id='$c'");
	$count = @mysql_num_rows($sql);
if($count>0)
{ while($row = mysql_fetch_array($sql)){
	$id				= $row["id"];
	$c_id=$row["c_id"];
	$sql1=mysql_query("SELECT cource_name FROM cource WHERE id='$c_id'");
	 $row1=mysql_fetch_array($sql1);
	$cource_name=$row1['cource_name'];	
	$t_id=$row['t_id'];
	$sql2=mysql_query("SELECT t_name FROM teachers WHERE id='$t_id'");
	 $row2=mysql_fetch_array($sql2);
       $t_name=$row2['t_name'];
	   $c_date=$row['c_date'];
	   $date=$row['submission_date'];
	}
	
	
	}else echo "no "; 
	
	
	
	return array($id,$cource_name,$t_name,$c_date,$date);
	}



///Checking the assingment



function check_assignment($id){
	$sql = mysql_query("SELECT * FROM assignment WHERE id='$id'");
	$count = @mysql_num_rows($sql);
if($count>0)
{ while($row = mysql_fetch_array($sql)){
	$id				= $row["id"];
	$c_id=$row["c_id"];
	$sql1=mysql_query("SELECT cource_name FROM cource WHERE id='$c_id'");
	 $row1=mysql_fetch_array($sql1);
	$cource_name=$row1['cource_name'];	
	$t_id=$row['t_id'];
	$sql2=mysql_query("SELECT t_name FROM teachers WHERE id='$t_id'");
	 $row2=mysql_fetch_array($sql2);
       $t_name=$row2['t_name'];
	   $c_date=$row['c_date'];
	   $date=$row['submission_date'];
	   $detail=$row['a_detail'];
	   
	   
	}
	
	
	}else echo "no "; 
	
	
	
	return array($id,$cource_name,$t_name,$c_date,$date,$detail);
	}


///Interstoin of Cource Request By Student 

function s_cource($cource,$s_id){
	
	
	
	$sql="INSERT INTO s_cource (c_id,s_id) VALUES('$cource','$s_id')";
	
	if(mysql_query($sql))
	{
		return true;
		}
	else
	{ echo "no";
		return false;}
	
	
	}




/////////////////Fectching Student Data////////////////

function fetch_student($id){
	$sql = mysql_query("SELECT * FROM users WHERE id='$id'");
	$count = @mysql_num_rows($sql);
if($count>0)
{ while($row = mysql_fetch_array($sql)){
	$id	= $row["id"];
	$Name=$row["Name"];
	$username=$row['username'];
	//checking which cource request is Sended By the User
	$sql1=mysql_query("SELECT c_id FROM s_cource WHERE s_id='$id'");
	 $row1=mysql_fetch_array($sql1);
	$c_id=$row1['c_id'];	
	
	$sql2=mysql_query("SELECT cource_name FROM cource WHERE id='$c_id'");
	 $row2=mysql_fetch_array($sql2);
	$cource_name=$row2['cource_name'];	
//////////////////,.......////////
     $pas=$row['password'];
	$email=$row['email'];
	

	}
	
	
	}else echo "no "; 
	
	
	
	return array($id,$Name,$cource_name,$pas,$email,$username,$c_id);
	}



//////////cources and teachers//

function c_teac($id){
	$sql = mysql_query("SELECT * FROM c_teacher WHERE id='$id'");
	$count = @mysql_num_rows($sql);
if($count>0)
{ while($row = mysql_fetch_array($sql)){
	$id				= $row["id"];
	$c_id=$row["c_id"];
	$t_id=$row['t_id'];
	$sql1=mysql_query("SELECT cource_name FROM cource WHERE id='$c_id'");
	 $row1=mysql_fetch_array($sql1);
	$cource_name=$row1['cource_name'];	
	
	$sql2=mysql_query("SELECT * FROM teachers WHERE id='$t_id'");
	 $row2=mysql_fetch_array($sql2);
       $t_name=$row2['t_name'];
	   $t_username=$row2['t_username'];
	   $t_pass=$row2['t_password'];
	 
	}
	
	
	}else echo "$t_id"; 
	
	
	
	return array($id,$cource_name,$t_name,$t_username,$t_pass,$t_id);
	}

/////////////////////Teachers 

function teac($id){
	$sql2=mysql_query("SELECT * FROM teachers WHERE id='$t_id'");
	 $count = @mysql_num_rows($sql2);
	 $row2=mysql_fetch_array($sql2);
    
if($count>0)
{ 
while($row2 = mysql_fetch_array($sql))
{
	$id				= $row2["id"];
	   $t_name=$row2['t_name'];
	   $t_username=$row2['t_username'];
	   $t_pass=$row2['t_password'];
	 
	}
	
	
	}else echo "$t_id"; 
	
	
	
	return array($id,$t_name,$t_username,$t_pass);
	}

























/////////Submitting Assingment Data//////////////(`id`, `c_id`, `t_id`, `as_id`, `s_id`
function s_assingment($id,$s_id,$t_name,$cource_name){
	$date=date("Y-m-d");
	
	$sql="INSERT INTO s_assignment (c_id,t_id,as_id,s_id,sub_date) VALUES 	('$cource_name','$t_name','$id','$s_id','$date')";
	if(mysql_query($sql))
	{
		return true;
		}
	else{
		return false;
		}
	
	
	}

///////////Recieving Assingment From Teacher Side // c_id`, `t_id`, `as_id`, `s_id`, `sub_date
function tr_assignment($id){
	$sql = mysql_query("SELECT * FROM s_assignment WHERE id='$id'");
	$count = @mysql_num_rows($sql);
if($count>0)
{ while($row = mysql_fetch_array($sql)){
	$id				= $row["id"];
	           $c_id=$row["c_id"];
	           $as_id=$row["as_id"];
            	$s_date=$row["sub_date"];
	$s_id=$row["s_id"];
	$sql1=mysql_query("SELECT Name FROM users WHERE id='$s_id'");
	 $row1=mysql_fetch_array($sql1);
	$s_name=$row1['Name'];	
	$t_id=$row['t_id'];
	$sql2=mysql_query("SELECT submission_date FROM assignment WHERE id='$as_id'");
	 $row2=mysql_fetch_array($sql2);
       $last_date=$row2["submission_date"];
	   
	}
	
	
	}else echo "no "; 
	
	
	
	return array($id,$c_id,$as_id,$s_date,$s_name,$last_date,$s_id);
	}


/////////////////////////////////////////////////////////////////

function fbook($id,$cource_id){
	
		$sql2=mysql_query("SELECT * FROM books WHERE cource_id='$cource_id'");
	$i=0;
	
while($row2 = mysql_fetch_array($sql2))
{
	$b_id=$row2['id'];
	
	 $b_name[$i]=$row2['book_name'];
	
	
	$i=$i+1;
	
	
	}
	
	
	
	
	
	

	return array($b_id,$b_name);
	
	
	}





function add_book($book_name,$book_details,$price,$id)
{
	$book_name=addslashes($book_name);
	$book_details=addslashes($book_details);
	
	$sql= "INSERT INTO books (book_name,book_detail,book_price,cource_id) VALUES ('$book_name','$book_details','$price','$id')";	


if(mysql_query($sql))
{
	//echo "ADD WAS SUCCESSFULLY ADDED";
	
	return mysql_insert_id();
	}	
	
	
	 else {
		return false;
	}

}


function add_teacher($teacher_name,  $teacher_adress, $teacher_degree,$t_name,$pass){
	
	$teacher_name=addslashes($teacher_name);
	$teacher_adress=addslashes($teacher_adress);
	$teacher_degree=addslashes($teacher_degree);
	$sql= "INSERT INTO teachers (t_name,t_adress,t_degree,t_username,t_password) VALUES ('$teacher_name','$teacher_adress','$teacher_degree','$t_name','$pass')";	

	if(mysql_query($sql))
{
	//echo "ADD WAS SUCCESSFULLY ADDED";
	
	return mysql_insert_id();
	}	
	
	
	 else {
		return false;
	}

	
	
	}










function exists_id($id){
	
$sql = "SELECT id FROM cource WHERE id='$id'";

$result = mysql_query($sql);
if(mysql_num_rows($result) >0){
  return true;
}else{
   return false;
}

}


function menu_brands() {
	//TOP BRANDS
	$i = 0;
	$sql = mysql_query("SELECT brand FROM products LIMIT 7");
	$productCount = @mysql_num_rows($sql); // count the output amount
	if ($productCount > 0) {
		while($row = mysql_fetch_array($sql)){
			$arr[$i] = $row["brand"];
			$i = $i + 1;			 
			}
	}
	return($arr);
}

function min_id() {
 	//SELECT MINIMUM ID
 	$sql = mysql_query("SELECT * FROM products WHERE id = ( select min(id) from products )");
    $productCount = @mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             $id			= $row["id"];
			 $product_name	= $row["product_name"];
			 $details		= $row["details"];
			 $category		= $row["category"];
			 $subcategory	= $row["subcategory"];
        }
    }
 	return array($id, $product_name, $details, $category, $subcategory);
}

function max_id() {
 	//SELECT MAXIMUM ID
 	$sql = mysql_query("SELECT id FROM cource WHERE id = ( select max(id) from cource )");
    $productCount = @mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             $id			= $row["id"];
        }
    }
 	return ($id);
}

function max_idt() {
 	//SELECT MAXIMUM ID
 	$sql = mysql_query("SELECT id FROM time_table WHERE id = ( select max(id) from time_table )");
    $productCount = @mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             $id			= $row["id"];
        }
    }
 	return ($id);
}

function max_idb() {
 	//SELECT MAXIMUM ID
 	$sql = mysql_query("SELECT id FROM books WHERE id = ( select max(id) from time_table )");
    $productCount = @mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             $id			= $row["id"];
        }
    }
 	return ($id);
}


function max_id_assi() {
 	//SELECT MAXIMUM ID
 	$sql = mysql_query("SELECT id FROM assignment WHERE c_id = ( select max(id) from assignment )");
    $productCount = @mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             $id			= $row["id"];
        }
    }
 	//return ($id);
}



function max_id_book() {
 	//SELECT MAXIMUM ID
 	$sql = mysql_query("SELECT id FROM assignment WHERE id = ( select max(id) from assignment )");
    $productCount = @mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             $id			= $row["id"];
        }
    }
 	return ($id);
}






function max_id_ad() {
 	//SELECT MAXIMUM ID
 	$sql = mysql_query("SELECT id FROM users WHERE id = ( select max(id) from users )");
    $Count = @mysql_num_rows($sql); // count the output amount
    if ($Count > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             $id= $row["id"];
        }
    }
 	return ($id);
}

//for teacher cources
function max_id_t_c() {
 	//SELECT MAXIMUM ID
 	$sql = mysql_query("SELECT id FROM c_teacher WHERE id = ( select max(id) from c_teacher )");
    $Count = @mysql_num_rows($sql); // count the output amount
    if ($Count > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             $id= $row["id"];
        }
    }
 	return ($id);
}




////Teacher

function max_id_t_() {
 	//SELECT MAXIMUM ID
 	$sql = mysql_query("SELECT id FROM teachers WHERE id = ( select max(id) from c_teacher )");
    $Count = @mysql_num_rows($sql); // count the output amount
    if ($Count > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             $id= $row["id"];
        }
    }
 	return ($id);
}




//For Assingment(teacher)
function max_id_r_assi() {
 	//SELECT MAXIMUM ID
 	$sql = mysql_query("SELECT id FROM s_assignment WHERE id = ( select max(id) from s_assignment )");
    $Count = @mysql_num_rows($sql); // count the output amount
    if ($Count > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             $id= $row["id"];
        }
    }
 	return ($id);
}



function time_table($id){
	$sql= mysql_query("SELECT * FROM time_table WHERE id='$id'");
	$no_row=@mysql_num_rows($sql);
	if($no_row>0)
	{
		while($row = mysql_fetch_array($sql))
		
		{
		
		$id=$row["id"];
		$t_id=$row["t_id"];
		$c_id=$row["c_id"];
		$timing_id=$row["timing_id"];
		$date=$row["date"];
		$r_id=$row["r_id"];
	
	//echo $id;
// For Teacher Name Through ID
		$tec= mysql_query("SELECT t_name from teachers WHERE id='$t_id'");
				$tn_rows=@mysql_num_rows($sql);
			
			
				while($t_row = mysql_fetch_array($tec)){
	    $teacher_name=$t_row["t_name"];
				}
				
	
	
		
		}

		//For Cource Name through Id
		$tec= mysql_query("SELECT cource_name from cource WHERE id='$c_id'");
		$t_row = mysql_fetch_array($tec);
		$cource_name=$t_row["cource_name"];
		
		//For Rooms
				$tec= mysql_query("SELECT room_no from room WHERE id='$r_id'");
		$t_row = mysql_fetch_array($tec);
		$room_no=$t_row["room_no"];
		
		//For Time
				$tec= mysql_query("SELECT slots from time WHERE id='$timing_id'");
		$t_row = mysql_fetch_array($tec);
		$time=$t_row["slots"];
		
	//$cou=mysql_query("SELECT `id` FROM `time_table` WHERE `id`='c_id'");

	






			
	return array($id,$teacher_name, $cource_name, $room_no,$time,$date);	
		}else echo "no";
	
	
	}



//////// Time Table For teachers
function time_table_t($id){
	$tid=($_SESSION['id']);
$i=0;
	$sql= mysql_query("SELECT * FROM time_table WHERE t_id='$tid'");
	$no_row=@mysql_num_rows($sql);
	if($no_row>0)
	{
		
		
		while($row = mysql_fetch_array($sql))
		
		{


		$id[$i]=$row["id"];
		$t_id=$row["t_id"];
		$c_id=$row["c_id"];
		$timing_id=$row["timing_id"];
		$date[$i]=$row["date"];
		$r_id=$row["r_id"];
	
	echo $id;
// For Teacher Name Through ID
		$tec= mysql_query("SELECT t_name from teachers WHERE id='$t_id'");
				$tn_rows=@mysql_num_rows($sql);
			
			
				while($t_row = mysql_fetch_array($tec)){
	    $teacher_name[$i]=$t_row["t_name"];
				}
				


		//For Cource Name through Id
		$tec= mysql_query("SELECT cource_name from cource WHERE id='$c_id'");
		$t_row = mysql_fetch_array($tec);
		$cource_name[$i]=$t_row["cource_name"];
		
		//For Rooms
				$tec= mysql_query("SELECT room_no from room WHERE id='$r_id'");
		$t_row = mysql_fetch_array($tec);
		$room_no[$i]=$t_row["room_no"];
		
		//For Time
				$tec= mysql_query("SELECT slots from time WHERE id='$timing_id'");
		$t_row = mysql_fetch_array($tec);
		$time[$i]=$t_row["slots"];
		
	//$cou=mysql_query("SELECT `id` FROM `time_table` WHERE `id`='c_id'");

	$i=$i+1;


		}
		

			
		
		

		}
		
		
		else { echo "no";}
	
return array($id,$teacher_name, $cource_name, $room_no,$time,$date);
	
	}


///////////////// Time Table For Students////////////


function time_table_s($id){
	
	$c_id=$_SESSION['c_id'];
$i=0;
	$sql= mysql_query("SELECT * FROM time_table WHERE c_id='$c_id'");
	$no_row=@mysql_num_rows($sql);
	if($no_row>0)
	{
		
		
		while($row = mysql_fetch_array($sql))
		
		{


		$id[$i]=$row["id"];
		$t_id=$row["t_id"];
		$c_id=$row["c_id"];
		$timing_id=$row["timing_id"];
		$date[$i]=$row["date"];
		$r_id=$row["r_id"];
	
	echo $id;
// For Teacher Name Through ID
		$tec= mysql_query("SELECT t_name from teachers WHERE id='$t_id'");
				$tn_rows=@mysql_num_rows($sql);
			
			
				while($t_row = mysql_fetch_array($tec)){
	    $teacher_name[$i]=$t_row["t_name"];
				}
				


		//For Cource Name through Id
		$tec= mysql_query("SELECT cource_name from cource WHERE id='$c_id'");
		$t_row = mysql_fetch_array($tec);
		$cource_name[$i]=$t_row["cource_name"];
		
		//For Rooms
				$tec= mysql_query("SELECT room_no from room WHERE id='$r_id'");
		$t_row = mysql_fetch_array($tec);
		$room_no[$i]=$t_row["room_no"];
		
		//For Time
				$tec= mysql_query("SELECT slots from time WHERE id='$timing_id'");
		$t_row = mysql_fetch_array($tec);
		$time[$i]=$t_row["slots"];
		
	//$cou=mysql_query("SELECT `id` FROM `time_table` WHERE `id`='c_id'");

	$i=$i+1;


		}
		

			
		
		

		}
		
		
		else { echo "no";}
	
return array($id,$teacher_name, $cource_name, $room_no,$time,$date);
	
	}

















////////////////////////Cource Product DATA




function product_data($id) {
  	$sql = mysql_query("SELECT id,LEFT(cource_name,20) as cource_name,cource_price, LEFT(cource_description,20) as cource_description FROM cource WHERE id='$id'");
    $productCount = @mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){
			$id				= $row["id"];
			$cource_name	= $row["cource_name"];
			$cource_price			= $row["cource_price"];
			$cource_description		= $row["cource_description"];
        }
    } else echo 'no';
	if (strlen($cource_name) == 20) {
		$cource_name .= '....';
	}
	if (strlen($cource_description) == 50) {
		$cource_description .= '....';
	}
	return array($id, $cource_name, $cource_price, $cource_description);
}



function book_data($id)
{
	
	$sql = mysql_query("SELECT id,LEFT(book_name,20) as book_name,book_price, LEFT(book_detail,20) as book_detail FROM books WHERE cource_id='$id'");
	    $bookCount = @mysql_num_rows($sql);
		 if ($bookCount > 0) {
	    while($row = mysql_fetch_array($sql)){
			$book_id			= $row["id"];
			$book_name	= $row["book_name"];
			$book_price			= $row["book_price"];
			$book_detail		= $row["book_detail"];
		//	$i=$i+1;
	
		}
		 }
		 else echo 'no';
	if (strlen($book_name) == 20) {
		$cource_name .= '....';
	}
	if (strlen($book_detail) == 30) {
		$cource_description .= '....';
	}
	return array($book_id, $book_name, $book_price, $book_detail);
}
	


function ads_data($id) {
  	$sql = mysql_query("SELECT LEFT(title,20) as title,price, LEFT(description,20) as description,category,subcategory FROM ads WHERE id='$id'");
    $productCount = @mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){
			//$id				= $row["id"];
			$title			= $row["title"];
			$price			= $row["price"];
			$description	= $row["description"];
			$category		= $row["category"];
			$subcategory	= $row["subcategory"];
        }
    }else echo 'no';
	if (strlen($title) == 20) {
		$title .= '....';
	}
	if (strlen($description) == 20) {
		$description .= '....';
	}
	return array($title, $price, $description,$productCount);
}


function random_id($id) {
	//SELECT RANDOM ID
	$i = 0;
	$sql = mysql_query("SELECT * FROM products WHERE id NOT IN ('$id')ORDER BY RAND() DESC");
    $productCount = @mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){
			$arr[$i]			= $row["id"];
			$i = $i + 1;			 
        }
    }
	return array($arr);
}


// For Cources
function order_by_date() {
	//ORDER BY DATE ADDED
	$i = 0;
	$sql = mysql_query("SELECT * FROM cource ORDER BY id");
    $productCount = @mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){
			$arr[$i]			= $row["id"];
			$i = $i + 1;			 
        }
    }
	return array($arr);
}
////For BOOKS////////
function order_by_dateb() {
	//ORDER BY DATE ADDED
	$i = 0;
	$sql = mysql_query("SELECT * FROM books ORDER BY id");
    $productCount = @mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){
			$arr[$i]			= $row["id"];
			$i = $i + 1;			 
        }
    }
	return array($arr);
}


//For Teacher
function order_by_datet() {
	//ORDER BY DATE ADDED
	$i = 0;
	$sql = mysql_query("SELECT * FROM time_table ORDER BY id ");
    $productCount = @mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){
			$arr[$i]			= $row["id"];
			$i = $i + 1;			 
        }
    }
	return array($arr);
}

/// For Assignment
function order_by_date_assi() {
	//ORDER BY DATE ADDED
	$i = 0;
	$sql = mysql_query("SELECT * FROM assignment ORDER BY id ");
    $productCount = @mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){
			$arr[$i]			= $row["id"];
			$i = $i + 1;			 
        }
    }
	return array($arr);
}

///For Admin
function order_by_date_a() {
	//ORDER BY DATE ADDED
	$i = 0;
	$sql = mysql_query("SELECT * FROM users ORDER BY id ");
    $productCount = @mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){
			$arr[$i]			= $row["id"];
			$i = $i + 1;			 
        }
    }
	return array($arr);
}

///Forteacher Cource

function order_by_date_t() {
	//ORDER BY DATE ADDED
	$i = 0;
	$sql = mysql_query("SELECT * FROM c_teacher ORDER BY id ");
    $productCount = @mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){
			$arr[$i]			= $row["id"];
			$i = $i + 1;			 
        }
    }
	return array($arr);
}



function order_by_date_() {
	//ORDER BY DATE ADDED
	$i = 0;
	$sql = mysql_query("SELECT * FROM teachers ORDER BY id ");
    $productCount = @mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){
			$arr[$i]			= $row["id"];
			$i = $i + 1;			 
        }
    }
	return array($arr);
}






/// For Reciving Assingments


function order_by_date_r_assi() {
	//ORDER BY DATE ADDED
	$i = 0;
	$sql = mysql_query("SELECT * FROM s_assignment ORDER BY id ");
    $productCount = @mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){
			$arr[$i]			= $row["id"];
			$i = $i + 1;			 
        }
    }
	return array($arr);
}



function select_category($category) {
	//SELECT CATEGORY ID IN FDUCTS.PHP
	$i = 0;
	$sql = mysql_query("SELECT * FROM products WHERE category='$category'");
    $productCount = @mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){
			$arr[$i]			= $row["id"];
			$i = $i + 1;			 
        }
    }else echo 'no';
	return array($arr);
}

function slider($id, $array) {

?>
<script>
var id = "<?php echo $id ?>";
    function example(id) {
      document.write(
        '<div class="example" id="' + id + '">' +
          '<div>' +
            '<ul>' +
			<?php
			for ($i = 0; $i < count($array); $i++) {
				?>
				'<li><a href="preview.php?id=<?php echo $array[$i] ?>"><img src="admin/inventory_images/products/<?php echo $array[$i] ?>/<?php echo $array[$i] ?>.jpg" width="auto" height="160"></a></li>' +
				
				<?php
			}
			?>
            '</ul>' +
          '</div>' +
        '</div>'
      );
    }
</script>


<?php	
}

?>