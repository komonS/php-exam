<?php
session_start();
require_once("conn.php");
$db=new DB();

if(isset($_POST['change'])){
	$txtSQL="SELECT * FROM user WHERE pinFreind = '".$_POST['uID']."'";
	$db->Query($txtSQL);
	while($row=$db->Read()){
		$ff = $row['id'];
	}
	if($ff != ''){
			echo "<script type='text/javascript'>
		 	alert('ไม่สามารถใช้ ID นี้ได้');
		  	document.location='index.php';
		  </script>";
	}else{
			$txtSQL="UPDATE user
					SET pinFreind = '".$_POST['uID']."'
					WHERE id = '".$_SESSION['userID']."'";
		    $db->Query($txtSQL);
		         //	echo $txtSQL;
		    echo "<script type='text/javascript'>
				 	alert('ทำการเปลี่ยน ID เรียบร้อยแล้ว');
				  	document.location='index.php';
				  </script>";
	}
}
$txtSQL="SELECT * FROM user WHERE id = '".$_SESSION['userID']."' ";
$db->Query($txtSQL);
	while($row=$db->Read()){
		$fID = $row['pinFreind'];
	}

?>
<div class="modal fade" id="changes">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Change ID</h4>
			</div>
			<div class="modal-body">
				<form action="" method="POST" role="form">
					<legend>Form title</legend>
				
					<div class="form-group">
						<label for="">ID : </label>
						<input type="text" name="uID" class="form-control" id="uID" value="<?php echo $fID; ?>">
					</div>
					<div class="form-group" align="center">
						<button type="submit" name="change" class="btn btn-primary">save</button>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				
			</div>
		</div>
	</div>
</div>