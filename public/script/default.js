$(document).ready(function(){

	var logInFormStatus = false;
	var regFormStatus = false;
	
	$(window).scroll(function(){
		if ($(window).scrollTop() > 50) {
			$(".navbar").addClass('navbar-fixed-top');
			$("#login-field").slideUp("slow");			
			$("#register-field").slideUp("slow");
			logInFormStatus = false;
			regFormStatus = false;
		}
		if ($(window).scrollTop() < 50) {
			$(".navbar").removeClass('navbar-fixed-top');
		}
	});

	$("#login-toggle").click(function(){
		$("#login-field").slideToggle("slow");
		logInFormStatus = true;
		if(regFormStatus) {
			$("#register-field").slideUp("slow");
			regFormStatus = false;
		}
	});

	$("#register-toggle").click(function(){
		$("#register-field").slideToggle("slow");
		regFormStatus = true;
		if(logInFormStatus) {{
			$("#login-field").slideUp("slow");
			logInFormStatus = false;
		}}
	});

});