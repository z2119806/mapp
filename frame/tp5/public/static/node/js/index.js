$(window).resize(function() 
{
	index()
});

var index = function ()
{
	if (isOs() == false)
	{
		$(".im-login").css("width", "100%");
		$(".im-for").css("width", "100%");

	}else
	{
		$(".im-login").css("width", "46%");
		$(".im-for").css("width", "46%");
	}
}

index();