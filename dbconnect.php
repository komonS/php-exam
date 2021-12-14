<?php  
$mysqli = new mysqli("localhost", "u562962787_root","klapauc89","u562962787_shopq");  
//$mysqli = new mysqli("localhost", "root","12345678","chat"); 
/* check connection */  
if (mysqli_connect_errno()) {  
    printf("Connect failed: %sn", mysqli_connect_error());  
    exit();  
}  
if(!$mysqli->set_charset("utf8")) {  
    printf("Error loading character set utf8: %sn", $mysqli->error);  
    exit();  
}  