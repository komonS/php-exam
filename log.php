<?php
session_start();
$_SESSION['freindID'] = $_GET['q'];
require_once("conn.php");
$db=new DB();
if($_SESSION['userID'] == ''){
	exit();
}

$txtSQL="UPDATE tbl_chat SET readStatus = '1' WHERE chat_user2 = '".$_SESSION['userID']."' AND chat_user1 = '".$_SESSION['freindID']."' ";
		//echo $txtSQL;
$db->Query($txtSQL);


 echo "<script type='text/javascript'>
        document.location='index.php';
      </script>";

?>