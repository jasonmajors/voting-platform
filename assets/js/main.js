$("#register-cta").click(function() {
	// the jquery hole begins
	$("#register-handle").hide();
	$("#council-register").show();
	$('html, body').animate({
        scrollTop: $("#council-register").offset().top
    }, 2000);
});
