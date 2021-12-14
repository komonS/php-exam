<?php
session_start();
require_once("conn.php");
$db=new DB();

if(isset($_POST['addFriend'])){
	$txtSQL="SELECT * FROM friend WHERE userID = '".$_SESSION['userID']."' 
	AND friendID = '".$_POST['friendID']."'";
	$db->Query($txtSQL);
	while($row=$db->Read()){
		$ff = $row['id'];
	}
	if($ff != ''){
			echo "<script type='text/javascript'>
		 	alert('คุณได้เพิ่มเพื่อนคนนี้ไปแล้ว');
		  	document.location='index.php';
		  </script>";
	}else{
			$txtSQL="SELECT * FROM user WHERE pinFreind = '".$_POST['friendID']."'";
			$db->Query($txtSQL);
			while($row=$db->Read()){
				$ffID = $row['id'];
			}
	
			
			$txtSQL="INSERT INTO friend
		         (userID, friendID,status)
		         VALUES ('".$_SESSION['userID']."','".$ffID."','1')";
		    $db->Query($txtSQL);
		    $txtSQL="INSERT INTO friend
		         (userID, friendID,log)
		         VALUES ('".$ffID."','".$_SESSION['userID']."','0')";
		    $db->Query($txtSQL);
		         //	echo $txtSQL;
		    echo "<script type='text/javascript'>
				 	alert('ทำการเพิ่มเพื่อนเรียบร้อย');
				  	document.location='index.php';
				  </script>";
	}
}

?>


<div class="modal fade" id="addFriend">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add friend</h4>
			</div>
			<div class="modal-body">
				<form action="" method="POST" role="form">
					
					<div class="form-group" align="center">
						<label>รหัสเพื่อน</label>
						<input type="text" name="friendID" id="friendID" class="form-control">
					</div>
					<div class="form-group" align="center">
						<button type="submit" name="addFriend" class="btn btn-primary">add</button>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>