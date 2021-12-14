<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Chat Gun</title>
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
	<div class="container" style="margin-top: 80px">
		<?php
			if($_SESSION['userID'] == ''){
				echo '<div class="alert alert-info">
  						login แล้วมาคุยกับเพื่อนกันเถอะ !!
					 </div';					
			}else{
				include('content.php');
			}
		?>
	</div>
	
</body>
</html>
<?php
include('login.php');
include('register.php');
include('addFriend.php');
include('change.php');

?>