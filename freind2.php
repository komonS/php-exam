
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
  
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
						  $("#myBody").empty();
						  $.each(obj, function(key, val) {
									var tr = "<tr>";
									tr = tr + "<td><a href = 'log.php?q="+val["chat_user2"]+"'>" +val["name"] +"</a></td><td><span class='label label-danger' >"+val["total"]+"</span></td>";
									tr = tr + "</tr>";
									$('#myTable > tbody:last').append(tr);
						  });
					}

			});
}

setInterval(getDataFromDb, 1000);   // 1000 = 1 second
</script>
<table class="table table-bordered" id="myTable">
<!-- head table -->
<thead>
  <tr>
    <th colspan="2" align="center">Freind</th>
   </tr>
</thead>
<!-- body dynamic rows -->
<tbody id="myBody"></tbody>
</table>
