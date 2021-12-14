<?php
session_start();
require_once("conn.php");
$db=new DB();

if(isset($_POST['regis'])){
	$txtSQL="SELECT * FROM user WHERE username = '".$_POST['username']."'";
	$db->Query($txtSQL);
	while($row=$db->Read()){
		$xx = $row['username'];
	}
	if($xx != ''){
			echo "<script type='text/javascript'>
		 	alert('username นี้มีผู้ใช้งานแล้วกรุณาทำการสมัครใหม่');
		  	document.location='index.php';
		  </script>";
	}else{
			$txtSQL="INSERT INTO user
		         (name, username,password)
		         VALUES ('".$_POST['name']."','".$_POST['username']."','".$_POST['password']."')";
		    $db->Query($txtSQL);
		         //	echo $txtSQL;
		    echo "<script type='text/javascript'>
				 	alert('ทำการสมัครเรียบร้อย กรุณาทำการล็อคอิน');
				  	document.location='index.php';
				  </script>";
	}

}


?>


<div class="modal fade" id="modalRegister">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Register</h4>
			</div>
			<div class="modal-body">
				<form action="register.php" method="POST" role="form">
					
					<div class="form-group">
						<label for="">ช่ือ - นามสกุล</label>
						<input type="text" class="form-control" name="name" id="name" placeholder="ชื่อ นามสกุล">
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" id="inputUsername" class="form-control"  required="required"  >
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" id="password" class="form-control"  required="required"  >
					</div>			
					<button type="submit" name="regis" class="btn btn-primary">register</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>