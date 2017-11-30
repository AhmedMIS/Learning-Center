<?php 
include '../init.php';
	include '../include/main_query.php';

if (logged_admin() === false) {
	header('Location: login.php');
	exit();

}


if (!strlen($_GET['id']==0) && !empty($_GET['id'])) {
		if (preg_replace('#[^A-Za-z]#i', '', $_GET['id'])) {
    		header('Location:page_not_found.php');
			exit();
		}
		else {
			$id=$_GET['id'];
			
			}
		
	}
	
	$one=1;
	if(isset($_SESSION['index'])){
	$sql=mysql_query("DELETE FROM c_teacher WHERE id='$id' ");
	if($sql){
		echo "Updated ";
		header('Location: '.$_SESSION['index']);
		die();
		
		} else echo "Cannot Delete"; 
	}
	
	?>
	
    