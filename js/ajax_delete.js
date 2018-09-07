$(document).ready(function(){
	$("#delete").click(function(){
		var idAlbum = $("#id_album").val();
		$.ajax({
			type : 'POST',
			url : 'modules_BL/album/albumBL.class.php',
			dataType : 'json',
			data : { value : idAlbum},
			sucess: function(data){
				console.log(data.responseText);
			}
		});
	});
});

