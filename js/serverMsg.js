$(document).ready(function(){
	if($(".sucessful").text() != "An error has occured!!!" && $(".sucessful").text() == "You have sucessfully added album!!!")
	{
		$(".sucessful").css({"color" : "#547634"});
	}
	else
	{
		$(".sucessful").text("");
	}
});