$(document).ready(function(){
	var checkFields = function(){
		
		var id = $(this).attr("id");
		var valueOfInput = $(this).val();
		var trimmedInputValue = valueOfInput.trim();
		
		$("#" + id + "Error").empty();
		
		if (trimmedInputValue == ""){
			$("#" + id + "Error").text("This field is required!");
		}
		if (trimmedInputValue != "" && id == "username"){
			if(trimmedInputValue.length < 4 || trimmedInputValue.length > 55){
				$("#" + id + "Error").text("Input must be between 4 and 55 characters!");
			}
		}
		if (trimmedInputValue != "" && id != "username"){
			if(trimmedInputValue.length < 4 || trimmedInputValue.length > 255){
				$("#" + id + "Error").text("Input must be between 4 and 255 characters!");
			}
		}
	}
	
	var allInputs = $("input");
	$(allInputs).blur(checkFields);
	$("form").submit(checkFields);
});