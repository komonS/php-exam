<?php
session_start();
header("Content-type:application/json; charset=UTF-8");    
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false); 
require_once("conn.php");
$db = new DB();
$txtSQL = "SELECT COUNT(chat_id) AS total FROM tbl_chat WHERE readStatus = '0' AND chat_user2 = '".$_SESSION['userID']."'";
$db->Query($txtSQL);
$row=$db->Read();
if($row['total'] > 0){
    $json_data[] = array(
            "num_total" => $row['total']
        );
}
// แปลง array เป็นรูปแบบ json string  
if(isset($json_data)){  
    $json= json_encode($json_data);    
    if(isset($_GET['callback']) && $_GET['callback']!=""){    
    echo $_GET['callback']."(".$json.");";        
    }else{    
    echo $json;    
    }    
}  
?>