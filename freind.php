<?php
session_start();
require_once("conn.php");
$db=new DB();
if($_SESSION['userID'] == ''){
	exit();
}

$txtSQL="SELECT * FROM friend INNER JOIN user ON friend.friendID = user.id WHERE userID ='".$_SESSION['userID']."' AND status = '1' ";
		//echo $txtSQL;
$db->Query($txtSQL);
?>
<table class="table table-bordered" >
	<thead>
		<tr>
			<th>friend list</th>
		</tr>
	</thead>
	<tbody>
		<?php
			 while($row=$db->Read()){
		?>
		<tr>
			<td><a href="log.php?q=<?php echo $row['friendID'];?>" onclick = "load_chat('<?php echo $row['friendID'];?>')"><?php echo $row['name'];?></a></td>
		</tr>
	<? } ?>
	</tbody>
</table>


    <script>
        $(document).ready(function () {
            $('.user').click(function (e) { 
                e.preventDefault();
                $.ajax({
                	url: $(this).attr('href') ,
                	dataType: "html",
                success: function (response) {
                   
                }
            	});
            });
            
        });
        
    
    
    </script>