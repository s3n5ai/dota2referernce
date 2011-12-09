$(document).ready(function(){





/*
--------------

var select = null;
 
$(".item a").live("mouseenter", function() {
    if(select === null) $(this).next("em").fadeIn();
});
 
$(".item a").live("mouseout", function() {
    if(select === null) $(this).next("em").fadeOut();
});
 
$(".item a").live("click", function() {
    if($(this) == $(select)) $(select).fadeOut();
    else if(select === null) $(this).next("em").fadeIn();
    else {
        $(select).fadeOut();
        $(this).next("em").fadeIn();
    }
});

------------------



	$(".item a").hover(function() {
		$(this).next("em").animate({opacity: "show"});
		$(this).click(function(){
				if (this.id == "show"){
					$(this).next("em").animate({opacity: "hide"});
					this.id="hide";
				}
				else{
					$(this).next("em").animate({opacity: "show"});
					this.id = "show";
				}
			});

	}, function() {
		if(this.id != "show"){
			$(this).next("em").animate({opacity: "hide"});
		}
	});

*/	


	$(".item a").hover(function() {
		$(this).next("em").animate({opacity: "show"}, "slow").stop(true,true);
	}, function() {
		$(this).next("em").animate({opacity: "hide"}, "fast").stop(true,true);
	});



	$(".item-right a").hover(function() {
		$(this).next("em").animate({opacity: "show"}, "slow");
	}, function() {
		$(this).next("em").animate({opacity: "hide"}, "fast");
	});

	$(".item-bottom-right a").hover(function() {
		$(this).next("em").animate({opacity: "show"}, "slow");
	}, function() {
		$(this).next("em").animate({opacity: "hide"}, "fast");
	});

	$(".item-bottom-left a").hover(function() {
		$(this).next("em").animate({opacity: "show"}, "slow");
	}, function() {
		$(this).next("em").animate({opacity: "hide"}, "fast");
	});



});

function search(query){
	alert(query.value);
	
}