<?php
session_start();
require_once("conn.php");
$db = new DB();
$txtSQL = "SELECT * FROM user WHERE id = '".$_SESSION['userID']."'";
$db->Query($txtSQL);
while($row=$db->Read()){
	$username = $row['name'];
}
?>


<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">CG</a>
			</div>
	
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav navbar-right">
					<?php
						if($_SESSION['userID'] == ''){
							?>
								<li><a data-toggle="modal" href='#modalLogin'>Login</a></li>
								<li><a data-toggle="modal" href='#modalRegister'>Register</a></li>
							<?	
						}else{

							?>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<span class="glyphicon glyphicon-envelope"></span>
									<span class="label label-danger" data-totalitem2="" id="place_total2"></span>
									<b class="caret"></b>
								</a>
								<div class="dropdown-menu" id="myTable">
									<ul   id="getNewMessage">
										
									</ul>
								</div>
								
								
							</li>
							
							
							<li><a href="get_freind.php"><span class="glyphicon glyphicon-user "></span> <span class="label label-danger" data-totalitem="" id="place_total"></span></a></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<?php echo  $username; ?>
									 <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a data-toggle="modal" href='#addFriend'>Add Friend</a>
										<li><a data-toggle="modal" href='#changes'>Change ID</a></li>
										<li><a href="logout.php">Log Out</a></li>
									</ul>
								</li>
							<?
						}

					?>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav>

<script  src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
<script type="text/javascript">
$(function(){
 
///////////
     
    // ตัวแปรสำหรับเก็บค่าจำนวนล่าสุด   
    var curentTotal = null;
    var getNewItem = function(){
         $.post("logF.php",function(response){
             // ถ้ามีการส่งข้อมูลกลับมา
             if(response && response.length){    
                 // เก็บค่าเดิมจาก data attribute ชื่อ totalitem 
                 curentTotal = $("#place_total").data("totalitem");                          
                 if(curentTotal==""){ // ครั้งแรกจะเป็นค่าว่าง
                        // กำหนด data attribute ชื่อ totalitem  ให้มีค่าเท่ากับค่าที่ได้จาก ajax
                        $("#place_total").data('totalitem',''+response[0].num_total+'5');
                 }else{
                     // ถ้าค่าที่ส่งกลับมา มากกว่าค่าเดิม
                     if(response[0].num_total > curentTotal){
                         
                         // กำหนด data attribute ชื่อ totalitem  ให้มีค่าเท่ากับค่าที่ได้จาก ajax ค่าใหม่
                         $("#place_total").data('totalitem',''+response[0].num_total+'5');
                     }
                 }
                 // แสดงข้อความเป้จำนวนรายการทั้งหมด
                 $("#place_total").text(response[0].num_total);  
             }
         });
    };
     
    // เรียกใช้งานฟังก์ชั่นครั้งแรกเมื่อเข้ามาหน้านี้
    getNewItem();
     
    // กำหนดทำงานทุกๆ 7000 เท่ากับ 7 วินาที // 1000 = 1 วินาที
    setInterval(function(){
        getNewItem();
    },7000);     
////////////// 
});

$(function(){
 
///////////
     
    // ตัวแปรสำหรับเก็บค่าจำนวนล่าสุด   
    var curentTotal = null;
    var getNewItem = function(){
         $.post("getNewMessage.php",function(response){
             // ถ้ามีการส่งข้อมูลกลับมา
             if(response && response.length){    
                 // เก็บค่าเดิมจาก data attribute ชื่อ totalitem 
                 curentTotal = $("#place_total2").data("totalitem2");                          
                 if(curentTotal==""){ // ครั้งแรกจะเป็นค่าว่าง
                        // กำหนด data attribute ชื่อ totalitem  ให้มีค่าเท่ากับค่าที่ได้จาก ajax
                        $("#place_total2").data('totalitem2',''+response[0].num_total+'');
                 }else{
                     // ถ้าค่าที่ส่งกลับมา มากกว่าค่าเดิม
                     if(response[0].num_total > curentTotal){
                         
                         // กำหนด data attribute ชื่อ totalitem  ให้มีค่าเท่ากับค่าที่ได้จาก ajax ค่าใหม่
                         $("#place_total2").data('totalitem2',''+response[0].num_total+'');
                     }
                 }
                 // แสดงข้อความเป้จำนวนรายการทั้งหมด
                 $("#place_total2").text(response[0].num_total);  
             }
         });
    };
     
    // เรียกใช้งานฟังก์ชั่นครั้งแรกเมื่อเข้ามาหน้านี้
    getNewItem();
     
    // กำหนดทำงานทุกๆ 7000 เท่ากับ 7 วินาที // 1000 = 1 วินาที
    setInterval(function(){
        getNewItem();
    },7000);     
////////////// 
});

</script>


<script>
  /*$(document).ready(function() {
		$.ajax({
			type: "POST",
			url: "logF2.php",
			data: '',
			success: function(result) {
				var content = '';
				$.each(result, function(i, item){ // loop..
					content = content + "<li><a href = 'log.php?q="+item.chat_user1+"'>"+item.name+"</a><li>";
				}); // ..loop
				$('#getNewMessage').html(content);
			}
		});
	});*/

function getDataFromDb()
{
	$.ajax({ 
				url: "logF2.php" ,
				type: "POST",
				data: ''
			})
			.success(function(result) { 
				var obj = jQuery.parseJSON(result);
					if(obj != '')
					{
						  //$("#myTable tbody tr:not(:first-child)").remove();
						  $("#getNewMessage").empty();
						  $.each(obj, function(key, val) {

									var tr = "";
									tr = tr + "<li><a href = 'log.php?q="+val["chat_user1"]+"'>" +val["name"] +" &nbsp<span class='label label-danger' >"+val["total"]+"</span></a></li>";
									tr = tr + "";
									$('#myTable > ul:last').append(tr);
						  });
					}

			});
}

setInterval(getDataFromDb, 1000);   // 1000 = 1 second*/
</script>



