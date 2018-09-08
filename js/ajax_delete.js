/*$(document).ready(function(){
	
});

$(document).on('click', '.delete', function(){
   var album_id = $(".id_album").attr("id");
   var action = "Delete";
   if(confirm("Are you sure you want to delete this?"))
   {
	$.ajax({
	 url:"delete.php",
	 method:"POST",
	 data:{album_id:album_id, action:action},
	 success:function(data)
	 {
	  alert(data);
	  load_data();
	 }
	});
   }
   else
   {
	return false;
   }
  });
	
*/
