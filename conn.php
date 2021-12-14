<?php

class DB{
	var $con;
	var $re;
	function DB($host='localhost',$user='root',$password='',$database='dbname'){
	//function DB($host='localhost',$user='root',$password='12345678',$database='chat'){
		$this->con=@mysqli_connect($host,$user,$password,$database) or die('Connection ERROR');
		mysqli_query($this->con,'SET NAMES utf8');		
	}
	
	function Query($txtSQL){
		$this->re=@mysqli_query($this->con,$txtSQL) or die('SQL ERROR');		
	}
	
	function Read(){
		return mysqli_fetch_array($this->re);	
	}
	
	function Row(){
		return mysqli_num_rows($this->re);		 
	}
}

?>