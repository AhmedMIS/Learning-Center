<?php
include '../init.php';
include '../include/main_query.php';

if (logged_admin() === false) {
	header('Location: login.php');
	exit();
}

?>

<?php
if (isset($_POST['cat'])&&isset($_POST['sub'])) {
	$cat=$_POST['cat'];
	$sub=$_POST['sub'];
	
	$sql		= mysql_query("INSERT INTO c_teacher (`c_id`,`t_id`) VALUES ('$cat','$sub')");
	
	if($sql)
	{
		echo "Record Adeed Succesfully";
		
		
		}
	else
	{
		echo "NOt Stored";
		}
	
	
	
	}
?>
<!DOCTYPE html>
<html>
<head>
<script>
function showUser(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","c_teacher.php?q="+str,true);
  xmlhttp.send();
}

function populate(s1,s2){
	var s1 = document.getElementById(s1).value;
	var s2 = document.getElementById(s2).value;

s2.innerHTML = "";
if(s1!==0)
{ xmlhttp.open("GET","c_teacher.php?q="+s1,true);
  xmlhttp.send();

	}
	if(s2!==0){
		xmlhttp.open("GET","c_teacher.php?q="+s2,true);
		  xmlhttp.send();
		}

}

</script>
<body>

<form>
<select name="users" onchange="showUser(this.value)">
  <option value="">Select a person:</option>
  <option value="1">Peter Griffin</option>
  <option value="2">Lois Griffin</option>
  <option value="3">Joseph Swanson</option>
  <option value="4">Glenn Quagmire</option>
  </select>
</form>
<br>
<div id="txtHint"><b>Person info will be listed here...</b></div>

</body>
</html>


	<form action="" method="post" enctype="multipart/form-data">

<br>Select Category first  <select name="cat" id="cat">
<option value=''>Select One</option>";

<br>

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
else 
		
		{echo  "NO REcord Found";}

?>

</select>

<br>Select the Cources  <select name="sub" id="sub">
<option value=''>Select One</option>";
<br>

<?php
$sql = mysql_query("SELECT * FROM cource");
$count = @mysql_num_rows($sql);
if($count>0)
{
	while($row = mysql_fetch_array($sql))
	{
		//echo "<br>Select Category first  <select name=cat id='cat' onchange=AjaxFunction();>
		//<option value='$row[id]'>$row[t_name]</option>";
		
		echo "<option value=$row[id]>$row[cource_name]</option>";
	echo "$row[id]";
	}
		}

?>
</select>

<?php 

echo $_POST['cat'];


echo $_POST['sub'];
 ?>
<td></td>
			<td><input type="submit" name="submit" value="Submit" /></td>
         </form>   

