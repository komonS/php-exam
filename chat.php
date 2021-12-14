<?php
session_start();
// สำหรับใช้ในตัวอย่างการกำหนด session user_id
	$_SESSION['ses_user_id']=$_SESSION['userID'];


	$_SESSION['ses_user_id2']=$_SESSION['freindID'];

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">   


<style type="text/css">
div#messagesDiv{
	height: 280px;
	overflow: auto;
	background-color: #FDFDE0;
	margin: 5px 0px;
	border: 1px solid #CCC;
}
.left_box_chat{
	border: 1px solid #CCC;
	border-radius: 25px;
	margin: 5px;
	padding: 0px 10px;
	display:inline-block;
	float:left;
	clear:both;
	text-align:left;
	background-color:#FFF;	
}
.right_box_chat{
	border: 1px solid #CCC;
	border-radius: 25px;
	margin: 5px;
	padding: 0px 10px;
	display:inline-block;
	float:right;
	clear:both;
	text-align:right;
	background-color:#9F6;
}
</style>

<div class="row">
  <div class="col-xs-9" style="margin: 5px;">
<div class="panel panel-default">
  <div class="panel-body">
	<div id="messagesDiv">
	<!--<div class="left_box_chat">1</div>
	<div class="right_box_chat">2</div>-->
	</div>
  </div>
</div>

<div class="bg-info" style="padding:5px;">

	<input type="hidden" class="form-control" name="userID1" id="userID1" value="<?=(isset($_SESSION['ses_user_id']))?$_SESSION['ses_user_id']:''?>" placeholder="UserID 1">
	<input type="hidden" class="form-control" name="userID2" id="userID2" value="<?=(isset($_SESSION['ses_user_id2']))?$_SESSION['ses_user_id2']:''?>" placeholder="UserID 2">    
  
<!--  input hidden สำหรับ เก็บ chat_id ล่าสุดที่แสดง-->
  <input name="h_maxID" type="hidden" id="h_maxID" value="0">
  <table class="table-responsive" width="100%">
  	<tr>
  		<td width="95%">
  			<input type="text" class="form-control" name="msg" id="msg" placeholder="Message">
  		</td>
  		<td>
  			<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModalFile"><span class="glyphicon glyphicon-folder-open"></span></button>
  		</td>
  		<td>
  			<button type="button" id="btnSend" name="btnSend" class="btn btn-default">ส่ง</button>
  		</td>
  	</tr>
  </table>	
  </div>
</div>
</div>

<div id="myModalFile" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body" align="center">
        <form action="UploadSave.php" name="frmMain" method="post" enctype="multipart/form-data" target="iframe_target" onSubmit="return ChkSubmit();">
	<iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
	<script language="JavaScript">

		function ChkSubmit(result)
		{
			if(document.getElementById("filUpload").value == "")
			{
				alert('Please select file...');
				return false;
			}
			
			//document.getElementById("progress").style.visibility="visible"; 
			document.getElementById("divresult").innerHTML ="Uploading....";
			return true;
		}

		function showResult(result)
		{
			//document.getElementById("progress").style.visibility="hidden"; 
			if(result==1)
			{
				document.getElementById("divresult").innerHTML = "<font color=green> Save successfully! </font>  <br>";
			}
			else
			{
				document.getElementById("divresult").innerHTML = "<font color=red> Error!! Cannot upload data </font> <br>";
			}
		}
	</script>
	<div id="divresult"></div>
	<!--<div id="progress" style="visibility:hidden"><img src="progress.gif"></div>-->
	<input type="file" name="filUpload" id="filUpload">
	  <input type="submit" name="submit" value="submit">
	  </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>      
<script type="text/javascript">
var load_chat; // กำหนดตัวแปร สำหรับเป็นฟังก์ชั่นเรียกข้อมูลมาแสดง
var first_load=1; // กำหนดตัวแปรสำหรับโหลดข้อมูลครั้งแรกให้เท่ากับ 1
load_chat = function(userID){
	var maxID = $("#h_maxID").val(); // chat_id ล่าสุดที่แสดง
	$.post("ajax_chat.php",{
		viewData:first_load,
		userID:userID,
		maxID:maxID
	},function(data){
		if(first_load==1){ // ถ้าเป็นการโหลดครั้งแรก ให้ดึงข้อมูลทั้งหมดที่เคยบันทึกมาแสดง
			for(var k=0;k<data.length;k++){ // วนลูปแสดงข้อความ chat ที่เคยบันทึกไว้ทั้งหมด
				if(parseInt(data[0].max_id)>parseInt(maxID)){ // เทียบว่าข้อมูล chat_id .ใหม่กว่าที่แสดงหรือไม่
					$("#h_maxID").val(data[k].max_id); // เก็บ chat_id เป็น ค่าล่าสุด
					// แสดงข้อความการ chat มีการประยุกต์ใช้ ตำแหน่งข้อความ เพื่อจัด css class ของข้อความที่แสดง
					$("#messagesDiv").append("<div class=\""+data[k].data_align+"_box_chat\">"+data[k].data_msg+"</div>"); 
					$("#messagesDiv")[0].scrollTop = $("#messagesDiv")[0].scrollHeight; // เลือน scroll ไปข้อความล่าสุด  	
				}
			};
		}else{ // ถ้าเป็นข้อมูลที่เพิ่งส่งไปล่าสุด
			if(parseInt(data[0].max_id)>parseInt(maxID)){ // เทียบว่าข้อมูล chat_id .ใหม่กว่าที่แสดงหรือไม่
				$("#h_maxID").val(data[0].max_id); // เก็บ chat_id เป็น ค่าล่าสุด
				// แสดงข้อความการ chat มีการประยุกต์ใช้ ตำแหน่งข้อความ เพื่อจัด css class ของข้อความที่แสดง
				$("#messagesDiv").append("<div class=\""+data[0].data_align+"_box_chat\">"+data[0].data_msg+"</div>"); 
				$("#messagesDiv")[0].scrollTop = $("#messagesDiv")[0].scrollHeight;   // เลือน scroll ไปข้อความล่าสุด
			}
		}
		first_load++;// บวกค่า first_load
	});		
}
// กำหนดให้ทำงานทกๆ 2.5 วินาทีเพิ่มแสดงข้อมูลคู่สนทนา
setInterval(function(){
	var userID = $("#userID2").val(); // id user ของผู้รับ
	load_chat(userID); // เรียกใช้งานฟังก์ช่นแสดงข้อความล่าสุด
},2500);	
$(function(){
 /// เมื่อพิมพ์ข้อความ แล้วกดส่ง
  $("#msg").keypress(function (e) { // เมื่อกดที่ ช่องข้อความ  
	if (e.keyCode == 13) { // ถ้ากดปุ่ม enter  
	  var user1 = $("#userID1").val(); // เก็บ id user  ผู้ใช้ที่ส่ง
	  var user2 = $("#userID2").val(); // เก็บ id user  ผู้ใช้ที่รับ
	  var msg = $("#msg").val();  // เก็บค่าข้อความ  
	  $.post("ajax_chat.php",{
		  user1:user1,
		  user2:user2,
		  msg:msg
	  },function(data){
		  	load_chat(user2);// เรียกใช้งานฟังก์ช่นแสดงข้อความล่าสุด
	  		$("#msg").val(""); // ล้างค่าช่องข้อความ ให้พร้อมป้อนข้อความใหม่  		  
	  });

	}  
  });  
  
});

$(function(){
 /// เมื่อพิมพ์ข้อความ แล้วกดส่ง
  $("#btnSend").click(function (e) { // เมื่อกดที่ ช่องข้อความ  
	 // ถ้ากดปุ่ม enter  
	  var user1 = $("#userID1").val(); // เก็บ id user  ผู้ใช้ที่ส่ง
	  var user2 = $("#userID2").val(); // เก็บ id user  ผู้ใช้ที่รับ
	  var msg = $("#msg").val();  // เก็บค่าข้อความ  
	  $.post("ajax_chat.php",{
		  user1:user1,
		  user2:user2,
		  msg:msg
	  },function(data){
		  	load_chat(user2);// เรียกใช้งานฟังก์ช่นแสดงข้อความล่าสุด
	  		$("#msg").val(""); // ล้างค่าช่องข้อความ ให้พร้อมป้อนข้อความใหม่  		  
	  });

	 
  });  
  
});


</script>
