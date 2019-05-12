<?php
$connection =	mysqli_connect('localhost' , 'root' ,'' ,'pfe');


mysqli_query($connection ,"SET CHARACTER SET 'utf8'");
mysqli_query($connection ,"SET SESSION collation_connection ='utf8_unicode_ci'");

if(isset($_POST['email'])){
	
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$id = $_POST['id'];

	//  query to update data 
	 

	
$result  = mysqli_query($connection , "UPDATE webmaster SET nom='$firstName' , prenom='$lastName' , email = '$email' WHERE id_m='$id'");

if($result){
		echo 'data updated';
		
	}

}
?>