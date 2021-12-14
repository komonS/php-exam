<?php
session_start();
include("dbconnect.php");

if($_FILES["filUpload"]["tmp_name"] != "")
{
	$arFile1=explode('.',$_FILES['filUpload']['name']);
	$type1 = strtolower($arFile1[count($arFile1)-1]);
	$newname = $_SESSION['ses_user_id'].date("Y-m-d-H-i-s").".".$type1;
	move_uploaded_file($_FILES["filUpload"]["tmp_name"],"myfile/".$newname);
	//$path = "test";
	$path ='<img class="img-responsive" style="width:50%" src= "myfile/'.$newname.'" />';
	$sql="
	INSERT INTO tbl_chat SET 
	chat_msg='".$path."',
	chat_user1='".$_SESSION['ses_user_id']."',  
	chat_user2='".$_SESSION['ses_user_id2']."',
	chat_datetime='".date("Y-m-d H:i:s")."'			
	";
	$mysqli->query($sql);
	
	echo "<script>alert('Upload file successfully!');</script>";
	echo "<script>window.top.window.showResult('1');</script>";
}
else
{
	echo "<script>alert('Error! Cannot upload data');</script>";
	echo "<script>window.top.window.showResult('2');</script>";
}
?>