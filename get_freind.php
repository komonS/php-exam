<?php
session_start();
require_once("conn.php");
$db = new DB();
if(isset($_GET['f'])){
	$txtSQL="UPDATE friend
					SET status = '1'
					WHERE userID = '".$_SESSION['userID']."' AND friendID = '".$_GET['f']."'";
		    $db->Query($txtSQL);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Chatgun</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
</head>
<body>
	<?php
	 include('header1.php');
	?>
	<div class="container-fluid" style="margin-top: 80px;">
		<div class="row">
			<div class="  col-md-8 ">
				<?php
				$txtSQL = "SELECT * FROM friend INNER JOIN user ON friend.friendID = user.id WHERE userID ='".$_SESSION['userID']."' AND status = '0'";
				$db->Query($txtSQL);
				?>
				<table class="table">
					<tbody>
						
					
				<?php
				while($row=$db->Read()){
					?>
					<tr>
						<td><?php echo $row['name'];?></td><td><a href="get_freind.php?f=<?php echo $row['friendID'];?>"><button type="button" class="btn btn-default">ยืนยัน</button></a></td>
					</tr>
				<?php
				}
				?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
</body>
</html>