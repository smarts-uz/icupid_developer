function runRegistrationValidation(id,domain){

	var r_username = $("#regUsername").val();
	var r_email = $("#regEmail").val();
	var r_password = $("#regPassword").val();
	var r_rpassword = $("#regRPassword").val();
	//var r_file_1 = $('input[name="uploadFile00"]').val();
	//var r_file_2 = $('input[name="uploadFile01"]').val();
	//var r_tnc = $("#t&C :checked").length;
	
	var ret = true;
	
	if(r_username == ""){
		$("#regUsername").css('border' , '1px solid #FF0000');
		ret = false;
	}
	if(r_email == ""){
		$("#regEmail").css('border' , '1px solid #FF0000');
		ret = false;
	}
	if(r_password == ""){
		$("#regPassword").css('border' , '1px solid #FF0000');
		ret = false;
	}
	if(r_rpassword == ""){
		$("#regRPassword").css('border' , '1px solid #FF0000');
		ret = false;
	}


	if(r_username == ""){
		$("#response_span").html('<img src="images/DEFAULT/_icons/16/alert.gif"> Please type your desired username.');
		$("#response_span").show();
		ret = false;
	}
	if(r_email == ""){
		$("#response_span_email").html('<img src="images/DEFAULT/_icons/16/alert.gif"> Please type your email id.');
		$("#response_span_email").show();
		ret = false;
	}
	if(r_password == ""){
		$("#response_span_pass").html('<img src="images/DEFAULT/_icons/16/alert.gif"> Please type your desired password.');
		$("#response_span_pass").show();
		ret = false;
	}
	if(r_rpassword == ""){
		$("#response_span_rpass").html('<img src="images/DEFAULT/_icons/16/alert.gif"> Please re-type your password.');
		$("#response_span_rpass").show();
		ret = false;
	}


	if(!ret){
		$("#main-message-bad span").text("Please fill all the mandatory fields.");
    	$("#main-message-bad").show();
    	$('html, body').animate({
            scrollTop: $("body").offset().top
        }, 500);
        return false;
	}
	var response = grecaptcha.getResponse();

	if(response.length == 0){
		$("#main-message-bad span").text("Please verify the code.");
    	$("#main-message-bad").show();
    	$('html, body').animate({
            scrollTop: $("body").offset().top
        }, 500);
        return false;
	}

	$('input[name="action"]').val('register_validate');

	var formData = new FormData($("form#slideRegister")[0]);
	$.ajax({
        url: domain + "inc/ajax/_actions_register.php",
        type:"POST",
        data: formData,
        contentType: false,       
        cache: false,             
        processData:false,
        success:function(data) {    
            console.log('success!');
            $('input[name="action"]').val('register');
            var rlt = $.parseJSON( data );
            if(rlt.code == 'activateAccount' || rlt.code == 'complete' ){
            	var slidesContainerId = "#" + id;
			    var i = $(slidesContainerId+" .cslide-slide.cslide-active").index();
			    var n = i+1;

			    if (!$(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-last")) {
			        
			        $("#reg-pagination .active").addClass('visited').removeClass('active');
			        $("#reg-pagination .step").each(function(){
			            if(!$(this).hasClass('visited')){
			                $(this).addClass('active');
			                return false;
			            }
			        });

			    }

			    var slideLeft = "-"+n*100+"%";
			    if (!$(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-last")) {
			        $(slidesContainerId+" .cslide-slide.cslide-active").removeClass("cslide-active").next(".cslide-slide").addClass("cslide-active");
			        $(slidesContainerId+" .cslide-slides-container").animate({
			            marginLeft : slideLeft
			        },250);
			        if ($(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-last")) {
			            $(slidesContainerId+" .cslide-next").addClass("cslide-disabled");
			        }
			    }
			    if ((!$(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-first")) && $(".cslide-prev").hasClass("cslide-disabled")) {
			        $(slidesContainerId+" .cslide-prev").removeClass("cslide-disabled");
			    }
            }
            else{
				
            	$("#main-message-bad span").text(rlt.code);
            	$("#main-message-bad").show();
            	$('html, body').animate({
                    scrollTop: $("body").offset().top
                }, 500);
            }
        },
        error: function (a, b, c) {
            console.log(a)
            console.log(b)
            console.log(c)
        }
        
    });

}

function registerRemoveStyle(id){
	if(id == "regUsername"){ $("#response_span").hide(); }
	if(id == "regEmail"){ $("#response_span_email").hide(); }
	if(id == "regPassword"){ $("#response_span_pass").hide(); }
	if(id == "regRPassword"){ $("#response_span_rpass").hide(); }

	$("#" + id).removeAttr("style");
}