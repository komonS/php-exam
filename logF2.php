<?php
session_start();
//header('Content-Type: application/json');
require_once("conn.php");	
	$conn = mysqli_connect("localhost","u562962787_root","klapauc89","u562962787_shopq");
	mysqli_set_charset($conn, "utf8");

	$sql = "SELECT COUNT(chat_id) AS total, chat_user1, name FROM tbl_chat INNER JOIN user ON tbl_chat.chat_user1 = user.id WHERE readStatus = '0' AND chat_user2 = '".$_SESSION['userID']."' GROUP BY chat_user1 ";

	$query = mysqli_query($conn,$sql);
	$resultArray = array();
	while($result = mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
		array_push($resultArray,$result);
	}
	mysqli_close($conn);

	echo json_encode($resultArray);
?>