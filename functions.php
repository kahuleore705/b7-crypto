<?php
require_once('db.php');

if(isset($_GET['f'])){
	if($_GET['f']=='list') dbRead();
	if($_GET['f']=='add') dbCreate();
	if($_GET['f']=='change') dbUpdate();
	if($_GET['f']=='remove') dbDelete();
}

function dbCreate(){
global $conn;
$target_dir = "photos/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$name = $_POST['name'];
$password = $_POST['password'];

	if(isset($_FILES["fileToUpload"])) {
	  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	  if($check !== false) {
	    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
	    echo 'Uploaded<br>filename:'.$_FILES["fileToUpload"]["name"].'<br>Name: '.$_POST['name'];

$sql = "INSERT INTO `users` (`id`, `name`, `password`, `photo`) VALUES (NULL, '".$name."',MD5('".$password."'), '".$_FILES["fileToUpload"]["name"]."');";
		mysqli_query($conn,$sql);
	  } else {
	  	echo 'Erroe: Not an Image';
	  }
	}
}


function dbRead(){
global $conn;
$sql = 'SELECT * FROM `users`';
$r = mysqli_query($conn,$sql);
	if(mysqli_num_rows($r)>0){
		echo '[';
		$rArr=[];
		while($row = mysqli_fetch_assoc($r)) {
			//echo $row['id'];
			$rArr[]= '{"id":"'.$row['id'].'","name":"'.$row['name'].'","password":"'.$row['password'].'","photo":"'.$row['photo'].'"}';
		}
		echo implode(',',$rArr);
		echo ']';

	}
}

function dbUpdate(){

global $conn;

$id = $_POST['id'];
$name = $_POST['name'];
$password = $_POST['password'];
$target_dir = "photos/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

 move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
 echo "Uploaded<br>filename ; " .$_FILES["fileToUpload"]["tmp_name"].'<br>';
		//UPDATE `users` SET `photo` = 'i2.png' WHERE `users`.`id` = 1;
$sql = "UPDATE `users` SET `name` = '".$name."', `password` = MD('".$password."'),`photo` = '".$_FILES["fileToUpload"]["name"]."' WHERE `users`.`id` = ".$id.";";
$r = mysqli_query($conn,$sql);
}


function dbDelete(){
	global $conn;
$id = $_POST['id'];
$sql = "DELETE FROM `users` WHERE `users`.`id` = ".$id.";";
$r = mysqli_query($conn,$sql);
}




?>