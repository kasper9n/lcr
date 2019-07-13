$(".links-toggle").click(function(){
	$(this).parent("form").children(".track-links").slideToggle("fast");
});

$(".expand-all").click(function(){
		$(".track-links").slideDown("fast");
});

$(".retract-all").click(function(){
		$(".track-links").slideUp("fast");
});
