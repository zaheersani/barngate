
/********************************\
|    POP-OP (login, registro)    |
\********************************/
function validar(idForma)
{
	var error = false;
	var camposRequeridos = '#'+idForma + ' [data-required="true"]';

 	$(camposRequeridos).each(function(index, element) {
		if($(this).val() == '')
		{
			var selectorCampo = '#' + idForma + ' [name="' + $(this).attr('name') + '"]';
			console.log($(this).attr('name') + ' vacío');
			$(selectorCampo).attr('placeholder', $(this).attr('data-name') + ' requerido').addClass('requerido');
			error = true;
		}
    }); // Cierra $(camposRequeridos).each

	var correo = '#'+idForma + ' [data-mail="true"]';

	$(correo).each(function(index, element) {

        var selectorCorreo = '#' + idForma + ' [name="' + $(this).attr('name') + '"]';

		var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);

		if($(this).val() !== '')
		{
			if(!pattern.test($(this).val()))
			{
				$(selectorCorreo).attr('placeholder', 'Correo inválido').addClass('requerido');
				$(selectorCorreo).val('');
				console.log($(this).attr('name') + ' incorrecto');
				error = true;
			} // if(!pattern.test($(this).val()))
		} // Cierra if($(this).val() !== '')
    }); // Cierra $(correo).each

    var camposSelect = '#'+idForma + ' [data-select="true"]';

 	$(camposSelect).each(function(index, element) {
		if($(this).val() == 'vacio') {
			$(this).addClass('requerido');
			error = true;   
		} else {
			$(this).removeClass('requerido');
		}
	});

	return error;
}


$('.form-inline').submit(function(e) {
	if(validar('signup')){ 
		e.preventDefault();
	} else {
		e.preventDefault();
		$("#message").html("Registering your information...");		

		$.ajax({
			url: '../mailchimp/News.php', // proper url to your "store-address.php" file
			type: 'POST', // <- IMPORTANT
			data: $('#signup').serialize() + '&ajax=true',
			success: function(msg) {

				var message = $.parseJSON(msg),
					result = '';

				if (message.status === 'subscribed') { // success
					$('#signup').html('<p class="fz-20 mb-5">Thank you for subscribing to our newsletter!</p>');
				} else { // error
					result = 'Error: ' + message.detail + 'message.status';
					$('#message').html(result); // display the message
				} 
			}
		});
	}
});

jQuery('.show-log').click(function(e){
	e.preventDefault();
	jQuery('.shadowbox#login').fadeIn(300);
	jQuery('body').css('overflow', 'hidden');
});

jQuery('.show-registro').click(function(e){
	e.preventDefault();
	jQuery('.shadowbox#registro').fadeIn(300);
	jQuery('body').css('overflow', 'hidden');
});

jQuery('.show-info').click(function(e){
	e.preventDefault();
	jQuery('.shadowbox#editinfo').fadeIn(300);
	jQuery('body').css('overflow', 'hidden');
});

jQuery('.close').click(function(e) {
	jQuery('.shadowbox').fadeOut(300);
	jQuery('body').css('overflow', 'auto');
	$(".err").prev().css("margin-bottom", "15px");
	$(".err").remove();
});



jQuery('.vista1').click(function(){
	jQuery('.fav').removeClass('active');
	jQuery('.vista2').removeClass('active');
	jQuery(this).addClass('active');
	jQuery('.row-lista').hide();
	jQuery('.row-fav').hide();
	jQuery('.row-vista').show();
});

jQuery('.vista2').click(function(){
	jQuery('.fav').removeClass('active');
	jQuery('.vista1').removeClass('active');
	jQuery(this).addClass('active');
	jQuery('.row-vista').hide();
	jQuery('.row-fav').hide();
	jQuery('.row-lista').show();
});

jQuery('.fav').click(function(){
	jQuery('.vista1').removeClass('active');
	jQuery('.vista2').removeClass('active');
	jQuery(this).addClass('active');
	jQuery('.row-vista').hide();
	jQuery('.row-lista').hide();
	jQuery('.row-fav').show();
});

jQuery('.tab-p').click(function () {     
   jQuery(this).toggleClass('tab-active');  
   jQuery(this).next('.bullet-tab').slideToggle();
});


/************************\
|    MENU HAMBURGUESA    |
\************************/

$("#menu").mmenu({
    "slidingSubmenus": false,
    "extensions": [
      "position-right",
      "theme-light"
    ],
    navbar: {
      title: "Menú"
    }
});

$('.slide-account').slick({
	arrows: true,
	infinite: true,
	slidesToShow: 4,
	slidesToScroll: 1,
	responsive: [
	{
	  breakpoint: 1024,
	  settings: {
		slidesToShow: 3
	  }
	},
	{
	  breakpoint: 767,
	  settings: {
		slidesToShow: 2
	  }
	},
	{
	  breakpoint: 500,
	  settings: {
		slidesToShow: 1
	  }
	}
	// You can unslick at a given breakpoint now by adding:
	// settings: "unslick"
	// instead of a settings object
  ]
});

$('.slide-animal').slick({
	dots: true,
	arrows: false,
	infinite: true,
	slidesToShow: 1,
	slidesToScroll: 1
});

$('.slide-principal').slick({
	dots: false,
	arrows: true,
	infinite: true,
	fade: true,
	slidesToShow: 1,
	slidesToScroll: 1,
	asNavFor: '.slide-thumbs'
});

$('.slide-thumbs').slick({
	dots: false,
	arrows: true,
	infinite: true,
	slidesToShow: 4,
	slidesToScroll: 1,
	focusOnSelect: true,
	asNavFor: '.slide-principal'
});

$("input[type=range]").mousemove(function (e) {
    var val = ($(this).val() - $(this).attr('min')) / ($(this).attr('max') - $(this).attr('min'));
    var percent = val * 100;

    $(this).css('background-image',
        '-webkit-gradient(linear, left top, right top, ' +
        'color-stop(' + percent + '%, #ED4A44), ' +
        'color-stop(' + percent + '%, #E5E9F2)' +
        ')');

    $(this).css('background-image',
        '-moz-linear-gradient(left center, #ED4A44 0%, #ED4A44 ' + percent + '%, #E5E9F2 ' + percent + '%, #E5E9F2 100%)');
});

$(document).ready(function() {

    var val = ($(".flex-auto input[type=range]").val() - $(".flex-auto input[type=range]").attr('min')) / ($(".flex-auto input[type=range]").attr('max') - $(".flex-auto input[type=range]").attr('min'));

    var percent = val * 100;

    $(".flex-auto input[type=range]").css('background-image',
            '-webkit-gradient(linear, left top, right top, ' +
            'color-stop(' + percent + '%, #ED4A44), ' +
            'color-stop(' + percent + '%, #E5E9F2)' +
            ')');

    $(".flex-auto input[type=range]").css('background-image',
            '-moz-linear-gradient(left center, #ED4A44 0%, #ED4A44 ' + percent + '%, #E5E9F2 ' + percent + '%, #E5E9F2 100%)');
    
});

/******************\
|  NOTIFICACIONES  |
\******************/

let txt_notificacion = document.querySelectorAll(".s-notificacion li div, .container .txt-notificacion");
if (txt_notificacion) {
	$(".s-notificacion li div, .container .txt-notificacion").click(function(e) {
		window.location.href = $(this).attr("data-href");
	})
}


let remove_img = document.querySelectorAll(".remove_img-edit");
if (remove_img) {
	for (var i = 0; i <= remove_img.length - 1; i++) {
		remove_img[i].addEventListener("click", e => {
			e.target.classList.add("mystyle");
			$("#remove_img").css("display", "block");
		});
	}
}

accpt_remove_img = document.querySelector(".accpt_remove-img");
if (accpt_remove_img) {
	accpt_remove_img.addEventListener("click", e => {

		let token = document.querySelector("input[name='_token']");
		let sale_id = document.querySelector("input[name='nick']");
		let url_img = document.querySelector(".mystyle").getAttribute('data-url');
		let data = {
			"_token": token.value,
			"url_img": url_img,
			"sale_id": sale_id.value
		};

		$("#remove_img").css("display", "none");
		$("#loading").css("display", "block");

		if (token.value != '' && url_img != '' && sale_id.value != '' || token.value != null && url_img != null && sale_id.value != null) {

			request
			   	.post('/removeImgEdit')
			   	.send(data)
			   	.set('Accept', 'application/json')
			   	.then(res => {
			   		if (res.body.message == 'ok') {
			   			$(".mystyle").parent().remove();
			   			$("#loading").css("display", "none");
			   		}
			   		else {
			   			location.reload();
			   			//$("#loading").css("display", "none");
			   			//$("#remove_img-error").css("display", "block");
			   		}
			   	})
			   	.catch(err => {
	      			// err.message, err.response
	      			console.log(err.message);
	      			error(password_confirm, "A problem happened, try again later");
	      			e.target.disabled = false;
	   			});
	   	}

	});
}


cancel_remove_img = document.querySelector(".cancel_remove-img");
if (cancel_remove_img) {
	cancel_remove_img.addEventListener("click", e => {
		$("#remove_img").css("display", "none");
	});
}

/********************************************\
|    VALIDAR Y PROCESAR DATOS DE REGISTRO    |
\********************************************/

let request =  window.superagent;
let register_send = document.querySelector(".register-send");

if (register_send) {

	register_send.addEventListener('click', e => {
		e.preventDefault();

		let email = document.querySelector("input[name='email_register']");
		let username = document.querySelector("input[name='username']");
		let password = document.querySelector("input[name='password_register']");
		let password_confirm = document.querySelector("input[name='password_confirmation']");
		let captcha = document.querySelector("textarea[name='g-recaptcha-response']");
		let token = document.querySelector("#form_register input[name='_token']");

		//Eliminar errores
		$(".err").remove();


		if (email.value == '') {
			error(email, "The email field is required");
			email.style.marginBottom = "0px";
			$(".err").css("marginBottom", "15px");
			return false;
		}
		else if (!validar_email(email.value)) {
			error(email, "The email must be a valid email address.");
			email.style.marginBottom = "0px";
			$(".err").css("marginBottom", "15px");
			return false;
		}
		else {
			email.style.marginBottom = "15px";
		}


		if (username.value == '') {
			error(username, "The username field is required");
			username.style.marginBottom = "0px";
			$(".err").css("marginBottom", "15px");
			return false;
		}
		else if (!espacios_blanco_none(username.value)) {
			error(username, "The username field does not accept spaces");
			username.style.marginBottom = "0px";
			$(".err").css("marginBottom", "15px");
			return false;
		}
		else {
			username.style.marginBottom = "15px";
		}


		if (password.value == '') {
			error(password, "The password field is required");
			password.style.marginBottom = "0px";
			$(".err").css("marginBottom", "15px");
			return false;
		}
		else if (password.value.length < 8) {
			error(password, "The password must be at least 8 characters.");
			password.style.marginBottom = "0px";
			$(".err").css("marginBottom", "15px");
			return false;
		}
		else {
			password.style.marginBottom = "15px";
		}


		if (password_confirm.value != password.value) {
			error(password_confirm, "The password confirmation does not match.");
			password_confirm.style.marginBottom = "0px";
			$(".err").css("marginBottom", "15px");
			return false;
		}
		else {
			password_confirm.style.marginBottom = "15px";
		}


		if (captcha.value == '') {
			error(captcha, "The field is required");
			$(".register-send").css("margin-top", '38px');
			return false;
		}


		e.target.disabled = true;
		$("#loading").css("display", "block");
		$("#registro").css("display", "none");
		$(".register-send").css("margin-top", '10px');

		let data = { 
			"email": email.value, 
			"username": username.value,
			"password": password.value, 
			"password_confirmation": password_confirm.value,
			"g-recaptcha-response": captcha.value,
			"_token": token.value 
		};

		request
		   	.post('/register')
		   	.send(data)
		   	.set('Accept', 'application/json')
		   	.then(res => {

		   		if (res.body.email) {
		   			error(email, res.body.email[0]);
		   			e.target.disabled = false;
		   			$("#loading").css("display", "none");
					$("#registro").css("display", "block");
					return false;
		   		}
		   		else if (res.body.username) {
		   			error(username, res.body.username[0]);
		   			e.target.disabled = false;
		   			$("#loading").css("display", "none");
					$("#registro").css("display", "block");
					return false;
		   		}
		   		else if (res.body.password) {
		   			error(password, res.body.password[0]);
		   			e.target.disabled = false;
		   			$("#loading").css("display", "none");
					$("#registro").css("display", "block");
					return false;
		   		}
		   		else if (res.body.password_confirm) {
		   			error(password_confirm, res.body.password_confirm[0]);
		   			e.target.disabled = false;
		   			$("#loading").css("display", "none");
					$("#registro").css("display", "block");
					return false;
		   		}
		   		else if (res.body.message == 'ok') {
		   			$("#loading").css("display", "none");
		   			$(".container-form").html("<h2 style='text-align:center;color:green'> Successfully registered </h2>");
		   			setTimeout( () => { location.reload() }, 2000);
		   			e.target.disabled = false;
		   			return false;
		   		}
		   		else if (res.body.message == 'off') {
		   			error(password_confirm, "A problem happened, try again later");
		   			e.target.disabled = false;
		   			$("#loading").css("display", "none");
					$("#registro").css("display", "block");
					return false;
		   		}
		   		else if (res.body.message == 'error_captcha') {
		   			error(captcha, "The field is required");
					$(".register-send").css("margin-top", '38px');
					$("#loading").css("display", "none");
					$("#registro").css("display", "block");
					return false;
		   		}
		   	})
		   	.catch(err => {
      			// err.message, err.response
      			console.log(err.message);
      			error(password_confirm, "A problem happened, try again later");
      			e.target.disabled = false;
   			});
	});
}



name_sarch = document.querySelector("select[name='animal-search']");
if (name_sarch) {
	name_sarch.addEventListener("change", e => {

		let token = document.querySelector("input[name='_token']");
		let animals = e.target;
		let data = { "_token": token.value, "animal": animals.value };

		//console.log(animals.value);
		if (animals.value == 0 || animals.value == '' || animals.value == null || animals.value == undefined) {
			return false;
		}

		request
		   	.post('/animal_config')
		   	.send(data)
		   	.set('Accept', 'application/json')
		   	.then(res => {
		   		console.log(res);
		   		if (res.body.message == 'ok') {
		   			breedso = '<option value=""> Make a selection </option>'
							  +'<option value=""> All Breed </option>';
		   			for (var i = 0; i <= res.body.result.breeds.length - 1; i++) {
		   				breedso += "<option value='"+res.body.result.breeds[i].breed_id+"'>"+res.body.result.breeds[i].name+"</option>";
		   			}

		   			$("select[name='breeds']").html(breedso);

		   			colors = '<option value=""> Make a selection </option>'
							  +'<option value=""> All Colors </option>';
		   			for (var i = 0; i <= res.body.result.color.length - 1; i++) {
		   				colors += "<option value='"+res.body.result.color[i].color_id+"'>"+res.body.result.color[i].name+"</option>";
		   			}

		   			$("select[name='colors']").html(colors);
		   		}
		   		
		   	})
		   	.catch(err => {
      			// err.message, err.response
      			console.log(err.message);
   			});
	});
}



/**********************\
|    VALIDATE LOGIN    |
\**********************/

let login_send = document.querySelector(".login_send");

if (login_send) {
	login_send.addEventListener("click", e => {
		e.preventDefault();

		let email = document.querySelector("input[name='email_login']");
		let password = document.querySelector("input[name='password']");
		let token = document.querySelector("#form_login input[name='_token']");

		//Eliminar errores
		$(".err").remove();

		if (email.value == '') {
			error(email, "The email field is required");
			email.style.marginBottom = "0px";
			$(".err").css("marginBottom", "15px");
			return false;
		}
		else if (!validar_email(email.value)) {
			error(email, "The email must be a valid email address.");
			return false;
		}
		else {
			email.style.marginBottom = "15px";
		}


		if (password.value == '') {
			error(password, "The password field is required");
			password.style.marginBottom = "0px";
			$(".err").css("marginBottom", "15px");
			return false;
		}
		else {
			password.style.marginBottom = "15px";
		}


		e.target.disabled = true;
		$("#loading").css("display", "block");
		$("#login").css("display", "none");

		let data = {
			"email": email.value,
			"password": password.value,
			"_token": token.value
		};


		request
		   	.post('/ajaxLogin')
		   	.send(data)
		   	.set('Accept', 'application/json')
		   	.then(res => {

		   		if (res.body.auth == false) {
                    if (res.body.message == 'password') {
                        error(password, "The password is incorrect");
                        password.style.marginBottom = "0px";
						$(".err").css("marginBottom", "15px");
                        e.target.disabled = false;
                    }
                    else if (res.body.message == 'email') {
                        error(email, "The email is not registered");
                        email.style.marginBottom = "0px";
						$(".err").css("marginBottom", "15px");
                        e.target.disabled = false;
                    }

                    $("#loading").css("display", "none");
                    $("#login").css("display", "block");
                }
                else if (res.body.password) {
                	 error(password, res.body.password[0]);
                	 password.style.marginBottom = "0px";
					$(".err").css("marginBottom", "15px");
                     e.target.disabled = false;
                      $("#loading").css("display", "none");
                      $("#login").css("display", "block");
                }
                else if (res.body.email) {
                	 error(email, res.body.email[0]);
                	 email.style.marginBottom = "0px";
					$(".err").css("marginBottom", "15px");
                     e.target.disabled = false;
                     $("#loading").css("display", "none");
                     $("#login").css("display", "block");
                }
                else if (res.body.auth == true) {
                    location.reload();
                }
		   	})
		   	.catch(err => {
      			// err.message, err.response
      			console.log(err.message);
      			//error(password_confirm, "A problem happened, try again later");
   			});

	});
}


/***************************************************\
|      VALIDAR QUE EL PRECIO SOLO SEAN NUMEROS      |
\***************************************************/

let price = document.querySelector("input[name='price']");

if (price) {

	price.addEventListener('keypress', (e) => {
        var key = window.event ? e.which : e.keyCode;
        if (key < 48 || key > 57) {
            e.preventDefault();
        }
        if (e.target.value.length > 8) {
			e.preventDefault();
		}
    });

	price.addEventListener('input', e => {
		e.target.value = format(e.target.value);
	});
}



/************************************************\
|      VALIDAR QUE EL ZIP SOLO SEAN NUMEROS      |
\************************************************/

let zip = document.querySelector("input[name='zip']");

if (zip) {

	zip.addEventListener('keypress', (e) => {
        var key = window.event ? e.which : e.keyCode;
        if (key < 48 || key > 57) {
            e.preventDefault();
        }
        if (e.target.value.length >= 5) {
			e.preventDefault();
		}
    });
}


/**************************************************\
|      VALIDAR QUE EL PHONR SOLO SEAN NUMEROS      |
\**************************************************/

let phone_number = document.querySelector("input[name='phone_number']");

if (phone_number) {

	phone_number.addEventListener('keypress', (e) => {
        var key = window.event ? e.which : e.keyCode;
        if (key < 48 || key > 57) {
            e.preventDefault();
        }
        if (e.target.value.length >= 13) {
			e.preventDefault();
		}
    });
}



/***************************************************\
|    VALIDAR PARA INICIAR EL PLUGIN DE UPLOAD FILE   |
\***************************************************/

if ($(".step3").is(":visible") || $(".step2").is(":visible") || $(".step3").is(":visible") || $(".step4").is(":visible") || $(".step1").is(":visible")) {

	if ($(".step4").is(":visible")) {
		$('html, body').animate({scrollTop: $(".alert-danger").offset().top - 300},1000);
	}

	//STEP-1
	let err = document.querySelector(".err");
	if (err) {
		$('html, body').animate({scrollTop: $(err).prev().offset().top - 50},1500);
	}
	let animals = document.querySelector("select[name='animals']");
	if (animals.value == 1) {

		$(".sale-row div").css("display", "none");
		$("input[name='conditions']").parent().css("display", "none");
		$("input[name='weight']").parent().css("display", "none");
		$("input[name='number_of_head']").parent().css("display", "none");
		$(".temperament-ok").css("display", "none");

		$("select[name='animals']").parent().css("display", "block");
		$("select[name='breeds']").parent().css("display", "block");
		$("select[name='categories']").parent().css("display", "block");
		$("input[name='number_of_head']").parent().css("display", "block");
		$("select[name='ages']").parent().css("display", "block");
		$("input[name='weight']").parent().css("display", "block");
		$("select[name='vaccinations']").parent().css("display", "block");
		$("select[name='horns']").parent().css("display", "block");
		$("input[name='conditions']").parent().css("display", "block");	
	}
	else if (animals.value == 2) {

		$(".sale-row div").css("display", "none");
		$("input[name='conditions']").parent().css("display", "none");
		$("input[name='weight']").parent().css("display", "none");
		$("input[name='number_of_head']").parent().css("display", "none");
		$(".temperament-ok").css("display", "none");

		$("select[name='animals']").parent().css("display", "block");
		$("select[name='genders']").parent().css("display", "block");
		$("select[name='breeds']").parent().css("display", "block");
		$("select[name='colors']").parent().css("display", "block");
		$("select[name='discipline']").parent().css("display", "block");
		$("select[name='ages']").parent().css("display", "block");
		$(".temperament-ok").css("display", "block");
		$("select[name='categories']").css("display", "block");
	}
	else if (animals.value == 3) {

		$(".sale-row div").css("display", "none");
		$("input[name='conditions']").parent().css("display", "none");
		$("input[name='weight']").parent().css("display", "none");
		$("input[name='number_of_head']").parent().css("display", "none");
		$(".temperament-ok").css("display", "none");

		$("select[name='animals']").parent().css("display", "block");
		$("select[name='breeds']").parent().css("display", "block");
		$("select[name='genders']").parent().css("display", "block");
		$("select[name='class']").parent().css("display", "block");
		$("input[name='number_of_head']").parent().css("display", "block");
		$("select[name='ages']").parent().css("display", "block");
		$("select[name='horns']").parent().css("display", "block");
		$("input[name='weight']").parent().css("display", "block");
	}
	else if (animals.value == 4) {

		$(".sale-row div").css("display", "none");
		$("input[name='conditions']").parent().css("display", "none");
		$("input[name='weight']").parent().css("display", "none");
		$("input[name='number_of_head']").parent().css("display", "none");
		$(".temperament-ok").css("display", "none");


		$("select[name='animals']").parent().css("display", "block");
		$("select[name='breeds']").parent().css("display", "block");
		$("select[name='genders']").parent().css("display", "block");
		$("select[name='class']").parent().css("display", "block");
		$("select[name='type']").parent().css("display", "block");
		$("select[name='horns']").parent().css("display", "block");
		$("select[name='ages']").parent().css("display", "block");
		$("input[name='number_of_head']").parent().css("display", "block");
		$("input[name='weight']").parent().css("display", "block");
	}
	else if (animals.value == 5) {

		$(".sale-row div").css("display", "none");
		$("input[name='conditions']").parent().css("display", "none");
		$("input[name='weight']").parent().css("display", "none");
		$("input[name='number_of_head']").parent().css("display", "none");
		$(".temperament-ok").css("display", "none");

		$("select[name='animals']").parent().css("display", "block");
		$("select[name='breeds']").parent().css("display", "block");
		$("select[name='genders']").parent().css("display", "block");
		$("select[name='class']").parent().css("display", "block");
		$("select[name='ages']").parent().css("display", "block");
		$("input[name='number_of_head']").parent().css("display", "block");
		$("input[name='weight']").parent().css("display", "block");
	}
	else if (animals.value == 6) {

		$(".sale-row div").css("display", "none");
		$("input[name='conditions']").parent().css("display", "none");
		$("input[name='weight']").parent().css("display", "none");
		$("input[name='number_of_head']").parent().css("display", "none");
		$(".temperament-ok").css("display", "none");

		$("select[name='animals']").parent().css("display", "block");
		$("select[name='ages']").parent().css("display", "block");
		$("select[name='colors']").parent().css("display", "block");
		$("select[name='breeds']").parent().css("display", "block");
		$("select[name='genders']").parent().css("display", "block");
		$("select[name='size']").parent().css("display", "block");
	}
	else if (animals.value == 7) {

		$(".sale-row div").css("display", "none");
		$("input[name='conditions']").parent().css("display", "none");
		$("input[name='weight']").parent().css("display", "none");
		$("input[name='number_of_head']").parent().css("display", "none");
		$(".temperament-ok").css("display", "none");

		$("select[name='animals']").parent().css("display", "block");
		$("select[name='ages']").parent().css("display", "block");
		$("select[name='colors']").parent().css("display", "block");
		$("select[name='breeds']").parent().css("display", "block");
		$("select[name='genders']").parent().css("display", "block")
		$("select[name='size']").parent().css("display", "block");
		$("select[name='declawed']").parent().css("display", "block");
	}




	//VALIDAR QUE TIPO DE ANIMAL ES PARA CAMBIAR EL PRECIO DE LOS PLANES
	if (document.querySelector("select[name='animals']").value == 6) {
		$(".standard").text("$5");
		$(".premium").text("$10");
	}
	else {
		$(".standard").text("$10");
		$(".premium").text("$20");
	}

	//MOSTRAR EL CUADRO DE VIDEOS SI SE NECESITA
	planes = $("input[name='planSelect']").val();
	if (planes == 1 || planes == 2) {
		$("textarea[name='url-videos']").css("display", "none");
		$("textarea[name='url-videos']").prev().css("display", "none");
	}
	

	//MOSTRAR DE NUEVO EL TOTAL DEL PAGO.
	let precio = $(".plan-selected span").html();
	let subtotal = precio.replace('$','');
	let home = 0;

	if ($("input[name='hompage']").is(":checked")) {
		$("input[name='hompage2']").prop("checked", true);
		home = 20;

	}

	subtotal = (isNaN(subtotal)) ? 0 : subtotal;
	let total = parseInt(subtotal) + home;
	$(".row-total h3").html("Total: $"+total);

	if ($(".step3").is(":visible")) {
		//VALIDAR EL PLAN PARA SABER SI VA A PAGAR CON STRIPE O NO
		if ($("input[name='planSelect']").val() == 1) {
			//$("input[type='file']").attr('data-max-files', 1);
			if ($("input[name='hompage']").is(":checked")) {
				$(".not-freeplan").css("display", "block");
				$(".finish").text("Pay and post ad >");
			}
			else {
				$(".not-freeplan").css("display", "none");
				$(".finish").text("Post ad >");
			}
			
			initFile("1");
		}
		else if ($("input[name='planSelect']").val() == 2) {
			//$("input[type='file']").attr('data-max-files', 5);
			$(".not-freeplan").css("display", "block");
			$(".finish").text("Pay and post ad >");
			initFile("5");
		}
		else {
			$(".not-freeplan").css("display", "block");
			$(".finish").text("Pay and post ad >");
			initFile();
		}
	}
	
}


/**********************\
|    VALIDATE SALE    |
\**********************/
let next = document.querySelector("a.nexts1");

if (next) {
	next.addEventListener("click", e => {
		e.preventDefault();

		let animals = document.querySelector("select[name='animals']");
		let breeds = document.querySelector("select[name='breeds']");
		let colors = document.querySelector("select[name='colors']");
		let genders = document.querySelector("select[name='genders']");
		let ages = document.querySelector("select[name='ages']");
		let discipline = document.querySelector("select[name='discipline']");
		let temperament = document.querySelector("input[name='temperament']");
		let price = document.querySelector("input[name='price']");
		let description = document.querySelector("textarea[name='description']");
		let city = document.querySelector("select[name='city']");
		let region = document.querySelector("select[name='region']");
		let zip = document.querySelector("input[name='zip']");
		let country = document.querySelector("select[name='country']");
		let number_of_head = document.querySelector("input[name='number_of_head']");
		let weight = document.querySelector("input[name='weight']");
		let vaccinations = document.querySelector("select[name='vaccinations']");
		let horns = document.querySelector("select[name='horns']");
		let conditions = document.querySelector("input[name='conditions']");
		let classo = document.querySelector("select[name='class']");
		let type = document.querySelector("select[name='type']");
		let size = document.querySelector("select[name='size']");
		let declawed = document.querySelector("select[name='declawed']");
		let conta = 0;

		//Eliminar errores
		$(".err").remove();


		if (animals.value == '' || animals.value == 0 || animals.value == null || animals.value == undefined || isNaN(animals.value) == true) {
			error(animals, "The animals field is required");
			$('html, body').animate({scrollTop: $(animals).offset().top - 50},1000);
			return false;
		}


		if (animals.value == 1) {

			if (breeds.value == '' || breeds.value == 0 || breeds.value == null || breeds.value == undefined || isNaN(breeds.value) == true) {
				error(breeds, "The breeds field is required");
				$('html, body').animate({scrollTop: $(breeds).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (ages.value == '' || ages.value == 0 || ages.value == null || ages.value == undefined || isNaN(ages.value) == true) {
				error(ages, "The ages field is required");
				$('html, body').animate({scrollTop: $(ages).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (vaccinations.value == '' || vaccinations.value == 0 || vaccinations.value == null || vaccinations.value == undefined || isNaN(vaccinations.value) == true) {
				error(vaccinations, "The vaccinations field is required");
				$('html, body').animate({scrollTop: $(vaccinations).offset().top - 50},1000);
				conta = 1;
				return false;
			}

			if (horns.value == '' || horns.value == 0 || horns.value == null || horns.value == undefined || isNaN(horns.value) == true) {
				error(horns, "The horns field is required");
				$('html, body').animate({scrollTop: $(horns).offset().top - 50},1000);
				conta = 1;
				return false;
			}

			if (weight.value == '' || weight.value == null || weight.value == undefined) {
				error(weight, "The weight field is required");
				$('html, body').animate({scrollTop: $(weight).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (conditions.value == '' || conditions.value == null || conditions.value == undefined) {
				error(conditions, "The conditions field is required");
				$('html, body').animate({scrollTop: $(conditions).offset().top - 50},1000);
				conta = 1;
				return false;
			}

			if (number_of_head.value == '' || number_of_head.value == null || number_of_head.value == undefined || isNaN(number_of_head.value) == true) {
				error(number_of_head, "the number of heads is required");
				$('html, body').animate({scrollTop: $(number_of_head).offset().top - 50},1000);
				conta = 1;
				return false;
			}
		}

		if (animals.value == 2) {

			if (breeds.value == '' || breeds.value == 0 || breeds.value == null || breeds.value == undefined || isNaN(breeds.value) == true) {
				error(breeds, "The breeds field is required");
				$('html, body').animate({scrollTop: $(breeds).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (colors.value == '' || colors.value == 0 || colors.value == null || colors.value == undefined || isNaN(colors.value) == true) {
				error(colors, "The colors field is required");
				$('html, body').animate({scrollTop: $(colors).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (genders.value == '' || genders.value == 0 || genders.value == null || genders.value == undefined || isNaN(genders.value) == true) {
				error(genders, "The genders field is required");
				$('html, body').animate({scrollTop: $(genders).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (ages.value == '' || ages.value == 0 || ages.value == null || ages.value == undefined || isNaN(ages.value) == true) {
				error(ages, "The ages field is required");
				$('html, body').animate({scrollTop: $(ages).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (discipline.value == '' || discipline.value == 0 || discipline.value == null || discipline.value == undefined || isNaN(discipline.value) == true) {
				error(discipline, "The discipline field is required");
				$('html, body').animate({scrollTop: $(discipline).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (temperament.value == '' || temperament.value == 0 || temperament.value == null || temperament.value == undefined || isNaN(temperament.value) == true) {
				error(temperament, "The temperament field is required");
				$('html, body').animate({scrollTop: $(temperament).offset().top - 50},1000);
				conta = 1;
				return false;	
			}
		}

		if (animals.value == 3) {

			if (breeds.value == '' || breeds.value == 0 || breeds.value == null || breeds.value == undefined || isNaN(breeds.value) == true) {
				error(breeds, "The breeds field is required");
				$('html, body').animate({scrollTop: $(breeds).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (genders.value == '' || genders.value == 0 || genders.value == null || genders.value == undefined || isNaN(genders.value) == true) {
				error(genders, "The genders field is required");
				$('html, body').animate({scrollTop: $(genders).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (ages.value == '' || ages.value == 0 || ages.value == null || ages.value == undefined || isNaN(ages.value) == true) {
				error(ages, "The ages field is required");
				$('html, body').animate({scrollTop: $(ages).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (classo.value == '' || classo.value == 0 || classo.value == null || classo.value == undefined || isNaN(classo.value) == true) {
				error(classo, "The class field is required");
				$('html, body').animate({scrollTop: $(classo).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (horns.value == '' || horns.value == 0 || horns.value == null || horns.value == undefined || isNaN(horns.value) == true) {
				error(horns, "The horns field is required");
				$('html, body').animate({scrollTop: $(horns).offset().top - 50},1000);
				conta = 1;
				return false;
			}

			if (weight.value == '' || weight.value == null || weight.value == undefined) {
				error(weight, "The weight field is required");
				$('html, body').animate({scrollTop: $(weight).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (number_of_head.value == '' || number_of_head.value == null || number_of_head.value == undefined || isNaN(number_of_head.value) == true) {
				error(number_of_head, "the number of heads is required");
				$('html, body').animate({scrollTop: $(number_of_head).offset().top - 50},1000);
				conta = 1;
				return false;
			}
		}

		if (animals.value == 4) {

			if (breeds.value == '' || breeds.value == 0 || breeds.value == null || breeds.value == undefined || isNaN(breeds.value) == true) {
				error(breeds, "The breeds field is required");
				$('html, body').animate({scrollTop: $(breeds).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (genders.value == '' || genders.value == 0 || genders.value == null || genders.value == undefined || isNaN(genders.value) == true) {
				error(genders, "The genders field is required");
				$('html, body').animate({scrollTop: $(genders).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (ages.value == '' || ages.value == 0 || ages.value == null || ages.value == undefined || isNaN(ages.value) == true) {
				error(ages, "The ages field is required");
				$('html, body').animate({scrollTop: $(ages).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (classo.value == '' || classo.value == 0 || classo.value == null || classo.value == undefined || isNaN(classo.value) == true) {
				error(classo, "The class field is required");
				$('html, body').animate({scrollTop: $(classo).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (type.value == '' || type.value == 0 || type.value == null || type.value == undefined || isNaN(type.value) == true) {
				error(type, "The type field is required");
				$('html, body').animate({scrollTop: $(type).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (horns.value == '' || horns.value == 0 || horns.value == null || horns.value == undefined || isNaN(horns.value) == true) {
				error(horns, "The horns field is required");
				$('html, body').animate({scrollTop: $(horns).offset().top - 50},1000);
				conta = 1;
				return false;
			}

			if (weight.value == '' || weight.value == null || weight.value == undefined) {
				error(weight, "The weight field is required");
				$('html, body').animate({scrollTop: $(weight).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (number_of_head.value == '' || number_of_head.value == null || number_of_head.value == undefined || isNaN(number_of_head.value) == true) {
				error(number_of_head, "the number of heads is required");
				$('html, body').animate({scrollTop: $(number_of_head).offset().top - 50},1000);
				conta = 1;
				return false;
			}
		}

		if (animals.value == 5) {

			if (breeds.value == '' || breeds.value == 0 || breeds.value == null || breeds.value == undefined || isNaN(breeds.value) == true) {
				error(breeds, "The breeds field is required");
				$('html, body').animate({scrollTop: $(breeds).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (genders.value == '' || genders.value == 0 || genders.value == null || genders.value == undefined || isNaN(genders.value) == true) {
				error(genders, "The genders field is required");
				$('html, body').animate({scrollTop: $(genders).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (ages.value == '' || ages.value == 0 || ages.value == null || ages.value == undefined || isNaN(ages.value) == true) {
				error(ages, "The ages field is required");
				$('html, body').animate({scrollTop: $(ages).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (classo.value == '' || classo.value == 0 || classo.value == null || classo.value == undefined || isNaN(classo.value) == true) {
				error(classo, "The class field is required");
				$('html, body').animate({scrollTop: $(classo).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (weight.value == '' || weight.value == null || weight.value == undefined) {
				error(weight, "The weight field is required");
				$('html, body').animate({scrollTop: $(weight).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (number_of_head.value == '' || number_of_head.value == null || number_of_head.value == undefined || isNaN(number_of_head.value) == true) {
				error(number_of_head, "the number of heads is required");
				$('html, body').animate({scrollTop: $(number_of_head).offset().top - 50},1000);
				conta = 1;
				return false;
			}
		}

		if (animals.value == 6) {

			if (breeds.value == '' || breeds.value == 0 || breeds.value == null || breeds.value == undefined || isNaN(breeds.value) == true) {
				error(breeds, "The breeds field is required");
				$('html, body').animate({scrollTop: $(breeds).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (colors.value == '' || colors.value == 0 || colors.value == null || colors.value == undefined || isNaN(colors.value) == true) {
				error(colors, "The colors field is required");
				$('html, body').animate({scrollTop: $(colors).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (genders.value == '' || genders.value == 0 || genders.value == null || genders.value == undefined || isNaN(genders.value) == true) {
				error(genders, "The genders field is required");
				$('html, body').animate({scrollTop: $(genders).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (ages.value == '' || ages.value == 0 || ages.value == null || ages.value == undefined || isNaN(ages.value) == true) {
				error(ages, "The ages field is required");
				$('html, body').animate({scrollTop: $(ages).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (size.value == '' || size.value == 0 || size.value == null || size.value == undefined || isNaN(size.value) == true) {
				error(size, "The size field is required");
				$('html, body').animate({scrollTop: $(size).offset().top - 50},1000);
				conta = 1;
				return false;	
			}
		}

		if (animals.value == 7) {

			if (breeds.value == '' || breeds.value == 0 || breeds.value == null || breeds.value == undefined || isNaN(breeds.value) == true) {
				error(breeds, "The breeds field is required");
				$('html, body').animate({scrollTop: $(breeds).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (colors.value == '' || colors.value == 0 || colors.value == null || colors.value == undefined || isNaN(colors.value) == true) {
				error(colors, "The colors field is required");
				$('html, body').animate({scrollTop: $(colors).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (genders.value == '' || genders.value == 0 || genders.value == null || genders.value == undefined || isNaN(genders.value) == true) {
				error(genders, "The genders field is required");
				$('html, body').animate({scrollTop: $(genders).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (ages.value == '' || ages.value == 0 || ages.value == null || ages.value == undefined || isNaN(ages.value) == true) {
				error(ages, "The ages field is required");
				$('html, body').animate({scrollTop: $(ages).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (size.value == '' || size.value == 0 || size.value == null || size.value == undefined || isNaN(size.value) == true) {
				error(size, "The size field is required");
				$('html, body').animate({scrollTop: $(size).offset().top - 50},1000);
				conta = 1;
				return false;	
			}

			if (declawed.value == '' || declawed.value == 0 || declawed.value == null || declawed.value == undefined || isNaN(declawed.value) == true) {
				error(declawed, "The declawed field is required");
				$('html, body').animate({scrollTop: $(declawed).offset().top - 50},1000);
				conta = 1;
				return false;	
			}
		}

		if (conta == 1) {
			return false;
		}

	
		if (price.value == '' || price.value == 0 || price.value == null || price.value == undefined) {
			error(price, "The price field is required");
			$('html, body').animate({scrollTop: $(price).offset().top - 50},1000);
			return false;	
		}

		if (description.value == '' || description.value == null || description.value == undefined) {
			error(description, "The description field is required");
			$('html, body').animate({scrollTop: $(description).offset().top - 50},1000);
			return false;	
		}

		if (city.value == '' || city.value == null || city.value == undefined || city.value == 0) {
			error(city, "The city field is required");
			$('html, body').animate({scrollTop: $(city).offset().top - 50},1000);
			return false;	
		}

		if (region.value == '' || region.value == null || region.value == undefined || region.value == 0) {
			error(region, "The region field is required");
			$('html, body').animate({scrollTop: $(region).offset().top - 50},1000);
			return false;	
		}

		if (zip.value == '' || zip.value == null || zip.value == undefined) {
			error(zip, "The zip field is required");
			$('html, body').animate({scrollTop: $(zip).offset().top - 50},1000);
			return false;	
		}

		if (isNaN(zip.value)) {
			error(zip, "The zip must be a number.");
			$('html, body').animate({scrollTop: $(zip).offset().top - 50},1000);
			return false;
		}

		if (zip.value.length > 5) {
			error(zip, "The zip may not be greater than 5");
			$('html, body').animate({scrollTop: $(zip).offset().top - 50},1000);
			return false;
		}

		if (zip.value.length < 5) {
			error(zip, "The zip must be at least 5.");
			$('html, body').animate({scrollTop: $(zip).offset().top - 50},1000);
			return false;
		}


		if (country.value == '' || country.value == null || country.value == undefined || country.value == 0) {
			error(country, "The country field is required");
			$('html, body').animate({scrollTop: $(country).offset().top - 50},1000);
			return false;	
		}


		//VALIDAR SI ES PERRO U OTRO ANIMAL PARA CAMBIAR EL PRECIO
		if (animals.value == 6) {
			$(".standard").text("$5");
			$(".premium").text("$10");
		}
		else {
			$(".standard").text("$10");
			$(".premium").text("$20");
		}


		document.querySelector(".step1").style.display = "none";
		document.querySelector(".step2").style.display = "block";
		window.scrollTo(0, $(".step2").position().top);
	});
}


/***************************************\
|    SELECCION DE ESTADOS - CIUDADES    |
\***************************************/

let region = document.querySelector("select[name='region']");
if (region) {

	region.addEventListener("change", function(e) {
		e.preventDefault();


		let estado = e.target;
		let token = document.querySelector("input[name='_token']");
		if (estado.value == '' || estado.value == null || estado.value == 0 || isNaN(estado.value) == true) {
			error(estado, "The region field is required");
			$('html, body').animate({scrollTop: $(estado).offset().top - 50},1000);
			return false;	
		}

		data = {
			"estado": estado.value, 
			"_token": token.value 
		};

		request
		   	.post('/searchState')
		   	.send(data)
		   	.set('Accept', 'application/json')
		   	.then(res => {
		   		//console.log(res);
		   		if (res.body.message == 'ok') {
		   			let html = "";
		   			for (var i = 0; i < res.body.result.length; i++) {
		   				html += "<option value='"+res.body.result[i]["id_ciudad"]+"'>"+res.body.result[i]["ciudad"]+"</option>";
		   			}
		   			$("select[name='city']").html(html);
		   		}
		 
		   	})
		   	.catch(err => {
      			// err.message, err.response
      			console.log(err.message);
      			error(estado, "A problem occurred, try again later");
				$('html, body').animate({scrollTop: $(estado).offset().top - 50},1000);
				return false;	
   			});


	});
}



/**********************\
|    DEL PASO 2 AL 3    |
\**********************/

let next2 = document.querySelector("a.nexts2");

if (next2) {
	next2.addEventListener("click", e => {
		e.preventDefault();

		let planSelect = $("input[name='planSelect']");
		let nexts2 = document.querySelector(".nexts2");
		let images = 1;

		//Eliminar errores
		$(".err").remove();

		if (planSelect.val() == "" || isNaN(planSelect.val())) {
			error(nexts2, "Choose a plan to continue");
			return false;
		}

		if (planSelect.val() == 1) {
			$("textarea[name='url-videos']").css("display", "none");
			$("textarea[name='url-videos']").prev().css("display", "none");

			$("input[type='file']").attr('data-max-files', "1");
			if ($("input[name='hompage']").is(":checked")) {
				$(".not-freeplan").css("display", "block");
				$(".finish").text("Pay and post ad >");
			}
			else {
				$(".not-freeplan").css("display", "none");
				$(".finish").text("Post ad >");
			}

			initFile("1");
		}
		else if (planSelect.val() == 2) {
			$("textarea[name='url-videos']").css("display", "none");
			$("textarea[name='url-videos']").prev().css("display", "none");

			$("input[type='file']").attr('data-max-files', "5");
			$(".not-freeplan").css("display", "block");
			$(".finish").text("Pay and post ad >");

			initFile("5");
		}
		else {
			$(".not-freeplan").css("display", "block");
			$(".finish").text("Pay and post ad >");
			initFile();
		}

		
		//initFile();


		document.querySelector(".step2").style.display = "none";
		document.querySelector(".step3").style.display = "block";
		window.scrollTo(0, $(".step3").position().top);
	});
}


/****************************\
|    DEL PASO 3 AL ULTIMO    |
\****************************/

let next3 = document.querySelector("a.next3");
if (next3) {
	next3.addEventListener("click", e => {
		e.preventDefault();

		let videos = document.querySelector("textarea[name='url-videos']");
		let fotos = document.querySelector("input[name='filepond[]'][type='hidden']");
		let planSelect = document.querySelector("input[name='planSelect']");
		let formFile = document.querySelector(".form-file");

		//Eliminar errores
		$(".err").remove();

		if (fotos == null || fotos == undefined) {
			error(formFile, "The fotos field is required");
			$('html, body').animate({scrollTop: $(fotos).offset().top - 50},1000);
			return false;
		}

		if (fotos.value == '') {
			error(formFile, "The fotos field is required");
			$('html, body').animate({scrollTop: $(fotos).offset().top - 50},1000);
			return false;
		}

		// if (planSelect.value == 3) {
		// 	if (videos.value == '') {
		// 		error(videos, "The video field is required");
		// 		$('html, body').animate({scrollTop: $(videos).offset().top - 50},1000);
		// 		return false;
		// 	}
		// }

		//OBTENER DATOS DEL PLAN ELEGIDO
		let skills = $(".plan-selected ul").html();
		let titulo_plan = $(".plan-selected h3").html();
		let precio = $(".plan-selected span").html();
		let subtotal = precio.replace('$','');
		let home = 0;

		// MOSTRAR EL PLAN ELEGIDO EN EL PASO FINAL
		$(".skills").html(skills);
		$(".plan-title").html(titulo_plan+" <span>"+precio+"</span>");

		if ($("input[name='hompage']").is(":checked")) {
			$("input[name='hompage2']").prop("checked", true);
			home = 20;
		}

		subtotal = (isNaN(subtotal)) ? 0 : subtotal;
		let total = parseInt(subtotal) + home;
		$(".row-total h3").html("Total: $"+total);


		//PASAR A LA PAGINA FINAL
		document.querySelector(".step3").style.display = "none";
		document.querySelector(".step4").style.display = "block";
		window.scrollTo(0, $(".step4").position().top);
	});
}


/**********************\
|    CLICK HOMEPAGE    |
\**********************/

let hompage2 = document.querySelector("input[name='hompage2']");
if (hompage2) {
	hompage2.addEventListener('click', e => {
		planes = $("input[name='planSelect']").val();
		if($("input[name='hompage2']").is(":checked")) {
				let total = precio_planes();
				let twich =  total + 20;
				$(".row-total h3").html("Total: $"+twich);
				$(".not-freeplan").css("display", "block");
				$(".finish").text("Pay and post ad >");
		}
		else {
			if (planes == 1) {
				let total = precio_planes();
				$(".row-total h3").html("Total: $"+total);
				$(".not-freeplan").css("display", "none");
				$(".finish").text("Post ad >");
			}
			else {
				let total = precio_planes();
				$(".row-total h3").html("Total: $"+total);
			}
		}
	});
}




/******************************\
|      CLICK A LOS PLANES      |
\******************************/

let plancenter = document.querySelectorAll(".plancenter");
if (plancenter) {
    $(".plancenter").click(function() {
		$(".plancenter").removeClass("plan-selected");
		$(this).addClass("plan-selected");
		$("input[name='planSelect']").val($(this).attr("data-plan"));
	})
}


/*************************\
|      RANGE REGISTRO      |
\*************************/

var elInput = document.querySelector('#input');
if (elInput) {
	var etiqueta = document.querySelector('#etiqueta');

	if (etiqueta) {
		etiqueta.innerHTML = elInput.value;
		elInput.addEventListener('input', function() {
			etiqueta.innerHTML = elInput.value;
		}, false);
  	}
}



/*******************\
|    UPDATE PLAN    |
\*******************/

let nexts2_plan = document.querySelector(".nexts2_plan");
if (nexts2_plan) {
	nexts2_plan.addEventListener("click", e => {

		//OBTENER DATOS DEL PLAN ELEGIDO
		let skills = $(".plan-selected ul").html();
		let titulo_plan = $(".plan-selected h3").html();
		let precio = $(".plan-selected span").html();
		let subtotal = precio.replace('$','');
		let home = 0;

		// MOSTRAR EL PLAN ELEGIDO EN EL PASO FINAL
		$(".skills").html(skills);
		$(".plan-title").html(titulo_plan+" <span>"+precio+"</span>");

		if ($("input[name='hompage']").is(":checked")) {
			$("input[name='hompage2']").prop("checked", true);
			home = 20;
		}

		subtotal = (isNaN(subtotal)) ? 0 : subtotal;
		let total = parseInt(subtotal) + home;
		$(".row-total h3").html("Total: $"+total);

		if (total <= 0) {
			$(".not-freeplan").css("display", "none");
		}

		//CAMBIAR STEP
		$(".step2_plan").css("display", "none");
		$(".step3_plan").css("display", "block");
	});
}



/*************************\
|      RANGE FILTROS      |
\*************************/

var price_filtro = document.querySelector('#price_filtro');
if (price_filtro) {
	var etiqueta = document.querySelector('#etiqueta');

	if (etiqueta) {
		etiqueta.innerHTML = price_filtro.value;
		price_filtro.addEventListener('input', function() {
			etiqueta.innerHTML = format(price_filtro.value);
			searchWP();
		}, false);
  	}
}


/*************************\
|      PAGO EN STRIPE      |
\*************************/

let finish = document.querySelector(".finish");
if (finish) {

	var $form = $(".require-validation");
	$('form.require-validation').bind('submit', function(e) {

		let planSelect = $("input[name='planSelect']");
		if (planSelect.val() != 1 || (planSelect.val() == 1 && ($("input[name='hompage']").is(":checked") || $("input[name='hompage2']").is(":checked")))) {

			var $form = $(".require-validation"),
			    inputSelector = ['input[type=email]', 'input[type=password]',
			                             'input[type=text]', 'input[type=file]',
			                             'textarea'].join(', '),
			    $inputs       = $form.find('.required').find(inputSelector),
	            $errorMessage = $form.find('div.error'),
	            valid         = true;
	            $errorMessage.addClass('hide');
			     
	        $('.has-error').removeClass('has-error');
	        var vont = 0;
	        $inputs.each(function(i, el) {
				var $input = $(el);
				if ($input.val() === '') {
					vont = 1;
		            $input.parent().addClass('has-error');
		            $errorMessage.removeClass('hide');
		            e.preventDefault();
				}
	        });

	        if (vont == 0) {
	        	$("#loading-sale").css("display", "block");
	        }
			      
			if (!$form.data('cc-on-file')) {
			    e.preventDefault();
				Stripe.setPublishableKey($form.data('stripe-publishable-key'));
				Stripe.createToken({
		            number: $('.card-number').val(),
		            cvc: $('.card-cvc').val(),
		            exp_month: $('.card-expiry-month').val(),
		            exp_year: $('.card-expiry-year').val()
				}, stripeResponseHandler);
			}
		}
		else {
			$("#loading-sale").css("display", "block");
		}
	});
}


/*********************\
|      FAVORITES      |
\*********************/

let favorites = document.querySelector(".button_favorite");
if (favorites) {
	favorites.addEventListener("click", e => {
		$("#favorite").css("display", "block");
	});
}


let cancel = document.querySelector(".cancel-favorite");
if (cancel) {
	cancel.addEventListener("click", e => {
		$("#favorite").css("display", "none");
	});
}

let accept = document.querySelector(".accpt-favorite");
if (accept) {
	accept.addEventListener("click", e => {

		let idProducto = document.querySelector("#nick");
		let token = document.querySelector("input[name='_token']");

		data = {
			"idProducto": idProducto.value, 
			"_token": token.value 
		};

		$("#favorite").fadeOut();
		$("#loading").fadeIn();

		request
		   	.post('/addFavorite')
		   	.send(data)
		   	.set('Accept', 'application/json')
		   	.then(res => {
		   		//console.log(res);
		   		if (res.body.message == 'ok') {
		   			$("#loading .wrapper-form img").css("display", "none");
		   			$("#loading .wrapper-form").append("<div class='container-form'> <h2> Successfully added </h2> </div>");
		   			setTimeout(function() { location.reload() }, 2000);
		   		}
		   		else {
		   			$("#loading .wrapper-form img").css("display", "none");
		   			$("#loading .wrapper-form").append("<div class='container-form'> <h2> There was a problem, try again later </h2> </div>");
		   			setTimeout(function() { location.reload() }, 2000);
		   		}
		   	})
		   	.catch(err => {
      			// err.message, err.response
      			console.log(err.message);
      			$("#loading .wrapper-form img").css("display", "none");
	   			$("#loading .wrapper-form").append("<div class='container-form'> <h2> There was a problem, try again later </h2> </div>");
	   			setTimeout(function() { location.reload() }, 2000);
   			});
	});
}



let add_favorite = document.querySelectorAll(".add-favorite");
if (add_favorite) {
	for (var i = 0; i <= add_favorite.length - 1; i++) {
		add_favorite[i].addEventListener("click", e => {
			$("#favorite").css("display", "block");
			$(".nick").removeClass("favoriteAcc");
			let b = e.target;
			$(b).next().addClass("favoriteAcc");
		});
	}
}



let accepta = document.querySelector(".accpta-favorite");
if (accepta) {
	accepta.addEventListener("click", e => {

		let idProducto = document.querySelector(".favoriteAcc");
		let token = document.querySelector("input[name='_token']");

		data = {
			"idProducto": idProducto.value, 
			"_token": token.value 
		};

		$("#favorite").fadeOut();
		$("#loading").fadeIn();

		request
		   	.post('/addFavorite')
		   	.send(data)
		   	.set('Accept', 'application/json')
		   	.then(res => {
		   		//console.log(res);
		   		if (res.body.message == 'ok') {
		   			$(".favoriteAcc").prev().remove();
		   			$("#loading").css("display", "none");
		   			$("#favorite_success").css("display", "block");
		   		}
		   		else {
		   			$("#loading").css("display", "none");
		   			$("#favorite_error").css("display", "block");
		   		}
		   	})
		   	.catch(err => {
      			// err.message, err.response
      			console.log(err.message);
      			$("#loading .wrapper-form img").css("display", "none");
	   			$("#loading .wrapper-form").append("<div class='container-form'> <h2> There was a problem, try again later </h2> </div>");
	   			setTimeout(function() { location.reload() }, 2000);
   			});
	});
}



/************************\
|      CALIFICACION      |
\************************/

jQuery('#calificacion .close').click(function(e) {
	jQuery('.shadowbox').fadeOut(300);
	jQuery('body').css('overflow', 'auto');
	$(".activeParent .starta").css("color", "#fff");
	$(".activeParent .starta").removeClass("starta");
	$(".activeParent").removeClass("activeParent");
});

$(".fa-calificacion-send .fa-star").click(function() {
	$(".fa-calificacion-send ul li").removeClass("active");
	$(".fa-calificacion-send ul li i").removeClass("starta");
	$(this).parent().addClass("active");

	$(".fa-calificacion-send ul li").each(function(index) {
		if ($(this).hasClass("active")) {
			$(this).children().css("color", "#FFBA5C");
			$(this).children().addClass("starta");
			contador = index + 1;
			return false;
		}
		$(this).children().css("color", "#FFBA5C");
		$(this).children().addClass("starta");
	});

	$("input[name='contador']").val(contador);
	$(".fa-calificacion-send ul li i:not(.starta)").css("color", "#fff");
});

let sold = document.querySelectorAll(".sold");
let animal_id = "";
if (sold) {
	for (var i = 0; i <= sold.length - 1; i++) {
		sold[i].addEventListener("click", e => {
			e.preventDefault();
			$("#option_qualify").css("display", "block");
			animal_id = e.target.getAttribute("data-animal");
			$(e.target).parent(".btn-list").addClass("bonti");
		});
	}
}

let barngate_qualify = document.querySelector(".barngate_qualify");
if (barngate_qualify) {
		barngate_qualify.addEventListener("click", e => {
			e.preventDefault();
			$("#calificacion").css("display", "block");
		});
}


let contador = 0;
$(".lista-calificacion .fa-star").click(function() {
	$(".lista-calificacion ul li").removeClass("active");
	$(".lista-calificacion ul").removeClass("activeParent");
	$(this).parent().addClass("active");
	$(this).parent().parent().addClass("activeParent");
	$(".lista-calificacion ul li i").removeClass("starta");

	$(".lista-calificacion ul.activeParent li").each(function(index) {
		if ($(this).hasClass("active")) {
			$(this).children().css("color", "#FFBA5C");
			$(this).children().addClass("starta");
			contador = index + 1;
			return false;
		}
		$(this).children().css("color", "#FFBA5C");
		$(this).children().addClass("starta");
	});

	$(".lista-calificacion ul.activeParent li i:not(.starta)").css("color", "#fff");
});



let qualify_v = document.querySelector(".qualify_v");
if (qualify_v) {
	qualify_v.addEventListener("click", e => {
		e.preventDefault();
		let mycontador = document.querySelector("input[name='contador']").value;
		if (mycontador == '' || mycontador == 0 || isNaN(mycontador) || mycontador > 5 || mycontador < 0) {
			$("#error_report").css("display", "block");
			return false;
		}

		$("#loading").css("display", "block");
		$("#form_qualify").submit();
	});
}

let other_way = document.querySelector(".other_way");
if (other_way) {
	other_way.addEventListener("click", e => {
		e.preventDefault();

		let data = {
			"_token": document.querySelector("input[name='_token']").value,
			"animal_id": animal_id,
		};

		$("#option_qualify").css("display", "none");
		$("#loading").css("display", "block");

		//ajax
		request
		   	.post('/addqualifylOther')
		   	.send(data)
		   	.set('Accept', 'application/json')
		   	.then(res => {
		   		//console.log(res);
		   		if (res.body.message == 'ok') {
		   			$(".bonti .sold").remove();
		   			$(".bonti").append('<a href="#" class="mw-150 btn btn-primary botton-public" data-animal="'+animal_id+'">Post again</a>');
		   			$(".bonti").append('<a href="#" class="mw-150 btn btn-primary botton-remove" data-animal="'+animal_id+'">Remove</a>');
		   			$("#error_report h3").html("Thanks");
		   			$("#loading").css("display", "none");
		   			$("#error_report").css("display", "block");

		   			let botton_public = document.querySelectorAll(".botton-public");
					if (botton_public) {
						for (var i = 0; i <= botton_public.length - 1; i++) {
							botton_public[i].addEventListener("click", e => {
								e.preventDefault();
								$(".btn-list").removeClass("post-a__gain");
								$(e.target).parent(".btn-list").addClass("post-a__gain");
								$("#animal_again-post").css("display", "block");
							});
						}
					}


					let botton_remove = document.querySelectorAll(".botton-remove");
					if (botton_remove) {
						for (var i = 0; i <= botton_remove.length - 1; i++) {
							botton_remove[i].addEventListener("click", e => {
								e.preventDefault();
								$("#animal_remove").css("display", "block");
								idAnimal = e.target.getAttribute("data-animal");
							});
						}
					}
		   		}
		   	})
		   	.catch(err => {
	  			// err.message, err.response
	  			console.log(err.message);
			});
	});
}



let qualify = document.querySelectorAll(".qualify");
if (qualify) {
	$(".qualify").click(function() {
		$(this).prev(".qualify_calc").val(contador);
		let data = {
			"contador": contador,
			"_token": document.querySelector("input[name='_token']").value,
			"username": document.querySelector("ul.activeParent").getAttribute("data-user"),
			"animal_id": animal_id,
		};

		$("#calificacion").css("display", "none");
		$("#loading").css("display", "block");


		//ajax
		request
		   	.post('/addqualifyl')
		   	.send(data)
		   	.set('Accept', 'application/json')
		   	.then(res => {
		   		//console.log(res);
		   		if (res.body.message == 'ok') {
		   			$(".bonti .sold").remove();
		   			$(".bonti").append('<a href="#" class="mw-150 btn btn-primary botton-public" data-animal="'+animal_id+'">Post again</a>');
		   			$(".bonti").append('<a href="#" class="mw-150 btn btn-primary botton-remove" data-animal="'+animal_id+'">Remove</a>');
		   			$("#error_report h3").html("Was rated correctly");
		   			$("#loading").css("display", "none");
		   			$("#error_report").css("display", "block");

		   			let botton_public = document.querySelectorAll(".botton-public");
					if (botton_public) {
						for (var i = 0; i <= botton_public.length - 1; i++) {
							botton_public[i].addEventListener("click", e => {
								e.preventDefault();
								$(".btn-list").removeClass("post-a__gain");
								$(e.target).parent(".btn-list").addClass("post-a__gain");
								$("#animal_again-post").css("display", "block");
							});
						}
					}


					let botton_remove = document.querySelectorAll(".botton-remove");
					if (botton_remove) {
						for (var i = 0; i <= botton_remove.length - 1; i++) {
							botton_remove[i].addEventListener("click", e => {
								e.preventDefault();
								$("#animal_remove").css("display", "block");
								idAnimal = e.target.getAttribute("data-animal");
							});
						}
					}

		   		}
		   	})
		   	.catch(err => {
      			// err.message, err.response
      			console.log(err.message);
   			});
	});
}



/****************\
|      CHAT      |
\****************/

let button_chat = document.querySelector(".button__chat");
if (button_chat) {

	$(".msg-chat").animate({ scrollTop: $(document).height() }, 1000); //BAJAR EL SCROLL DEL CHAT
	Pusher.logToConsole = true;
	let pusher = new Pusher('fa91802443afec1d96ac', {
      	cluster: 'us2',
      	forceTLS: true
    });

	let canal = document.querySelector("#channel").value;
    let channel = pusher.subscribe(canal);
    channel.bind(canal+'-message', function(data) {
    	
    	let html = '<li class="msg-chat__item msg-chat__item_left-person">'+
    					'<div class="msg-chat__time">'+data.hora+'</div> '+
    					'<div class="msg-chat__bubble msg-chat__bubble_first-in-group msg-chat__bubble_third-person msg-chat__bubble_third-person__first-in-group"> <div class="msg-chat__text">'+data.mensaje+'</div></div>'+
    				'</li>';

    	$(".msg-chat__items").append(html);
    	$(".msg-chat").animate({ scrollTop: $(document).height() }, 1000);
    	//console.log(JSON.stringify(data));
    });

	button_chat.addEventListener("click", e => {
		
		let token = document.querySelector("input[name='_token']");
		let message = document.querySelector("#messaging-widget-textarea").value;

		if (message.trim() == '' || message.trim() == null || message.trim() == undefined) {
			return false;
		}


		let data = {
			"canal": canal, 
			"_token": token.value,
			"message": message,
			"socket_id": pusher.connection.socket_id
		};

		//TIEMPO
		let today = new Date();
		let date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
		let time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
		let fecha = date+" "+time;

		//ESCRIBIR EL MENSAJE EN EL CHAT LOCAL
		let html = '<li class="msg-chat__item msg-chat__item_right-person">'+
		   							'<div class="msg-chat__time">'+fecha+'</div> '+
		   							'<div class="msg-chat__bubble msg-chat__bubble_first-in-group msg-chat__bubble_first-person msg-chat__bubble_first-person__first-in-group">'+
		   								'<div class="msg-chat__text">'+message+'</div>'+
		   							'</div>'+
		   						'</li>';

		$(".msg-chat__items").append(html);
		$("#messaging-widget-textarea").val("");
		$(".msg-chat").animate({ scrollTop: $(document).height() }, 1000);

		request
		   	.post('/messageSend')
		   	.send(data)
		   	.set('Accept', 'application/json')
		   	.then(res => {
		   		//console.log(res);
		   		if (res.body.message == 'ok') {
		   			console.log("ok");
		   		}
		   	})
		   	.catch(err => {
      			// err.message, err.response
      			console.log(err.message);
   			});

	});
}



/********************\
|      CONTACTO      |
\********************/

let enviar_contacto = document.querySelector(".enviar_contacto");
if (enviar_contacto) {
	enviar_contacto.addEventListener("click", function(e) {
		e.preventDefault();

		let first_name = document.querySelector("input[name='first_name']");
		let last_name = document.querySelector("input[name='last_name']");
		let email = document.querySelector("input[name='email_contact']");
		//let phone = document.querySelector("input[name='phone']");
		let questions = document.querySelector("textarea[name='questions']");


		$(".error").html("");

		if (first_name.value == '') {
			$(".error").html("The first name field is required");
			return false;
		}

		if (last_name.value == '') {
			$(".error").html("The last name field is required");
			return false;
		}


		if (email.value == '') {
			$(".error").html("The email field is required");
			return false;
		}

		if (!validar_email(email.value)) {
			$(".error").html("the email field is not valid");
			return false;
		}

		// if (isNaN(phone.value)) {
		// 	$(".error").html("the phone field has to be numeric");
		// 	return false;
		// }

		// if (phone.value == '') {
		// 	$(".error").html("The phone field is required");
		// 	return false;
		// }

		if (questions.value.trim() == '') {
			$(".error").html("The questions field is required");
			return false;
		}


		
		$("#loading").css("display", "block");
		$(".clearfix").submit();
	});
}




/************************************************************\
|      VALIDAR QUE EL PHONE - CONTACT SOLO SEAN NUMEROS      |
\************************************************************/

let phone = document.querySelector("input[name='phone']");
if (phone) {
	phone.addEventListener('keypress', (e) => {
        var key = window.event ? e.which : e.keyCode;
        if (key < 48 || key > 57) {
            e.preventDefault();
        }
        if (e.target.value.length >= 13) {
			e.preventDefault();
		}
    });
}




/*************************\
|      EDITAR PERFIL      |
\*************************/

let info_user = document.querySelector(".edit-info_user");
if (info_user) {

	info_user.addEventListener("click", function() {

		let email = document.querySelector("input[name='email']");
		let username = document.querySelector("input[name='username']");
		let password = document.querySelector("input[name='password_register']");
		let name = document.querySelector("input[name='name_contact']");
		let phone = document.querySelector("input[name='phone']");
		let address = document.querySelector("input[name='address']");
		let postal = document.querySelector("input[name='postal']");
		let state = document.querySelector("select[name='state']");
		let token = document.querySelector("input[name='_token']");


		//Eliminar errores
		$(".err").remove();


		if (email.value.trim() == '') {
			error(email, "The email field is required");
			email.style.marginBottom = "0px";
			$(".err").css("marginBottom", "15px");
			return false;	
		}
		else {
			email.style.marginBottom = "15px";
		}

		if (!validar_email(email.value)) {
			$(email).after("The email must be a valid email address.");
			email.style.marginBottom = "0px";
			$(".err").css("marginBottom", "15px");
			return false;
		}
		else {
			email.style.marginBottom = "15px";
		}

		if (username.value.trim() == '') {
			$(username).after("The username field is required");
			username.style.marginBottom = "0px";
			$(".err").css("marginBottom", "15px");
			return false;
		}
		else {
			username.style.marginBottom = "15px";
		}

		if (name.value.trim() == '') {
			error(name, "The name field is required");
			name.style.marginBottom = "0px";
			$(".err").css("marginBottom", "15px");
			return false;	
		}
		else {
			name.style.marginBottom = "15px";
		}

		if (phone.value.trim() == '') {
			error(phone, "The phone field is required");
			phone.style.marginBottom = "0px";
			$(".err").css("marginBottom", "15px");
			return false;	
		}
		else {
			phone.style.marginBottom = "15px";
		}

		if (address.value.trim() == '') {
			error(address, "The address field is required");
			address.style.marginBottom = "0px";
			$(".err").css("marginBottom", "15px");
			return false;	
		}
		else {
			address.style.marginBottom = "15px";
		}

		if (postal.value.trim() == '') {
			error(postal, "The postal field is required");
			postal.style.marginBottom = "0px";
			$(".err").css("marginBottom", "15px");
			return false;	
		}
		else {
			postal.style.marginBottom = "15px";
		}

		if (state.value.trim() == '' || state.value.trim() == null || state.value.trim() == undefined || state.value.trim() == 0) {
			error(state, "The state field is required");
			state.style.marginBottom = "0px";
			$(".err").css("marginBottom", "15px");
			return false;	
		}
		else {
			state.style.marginBottom = "15px";
		}


		data = {
			"email": email.value,
			"username": username.value,
			"password": password.value,
			"name": name.value,
			"phone": phone.value,
			"address": address.value,
			"postal": postal.value,
			"state": state.value,
			"_token": token.value  
		};

		$("#editinfo").fadeOut();
		$("#loading").fadeIn();

		request
		   	.post('/myaccount/editProfile')
		   	.send(data)
		   	.set('Accept', 'application/json')
		   	.then(res => {
		   		//console.log(res);
		   		if (res.body.message == 'ok') {
		   			$("#loading .wrapper-form img").css("display", "none");
		   			$("#loading .wrapper-form").append("<div class='container-form'><h2>Your data has been updated correctly!</h2> </div>");
		   			setTimeout(function() { location.reload() }, 2200);
		   		}
		   		else {

		   			$("#editinfo").fadeIn();
					$("#loading").fadeOut();

		   			if (res.body.username) {
		   				error(username, res.body.username[0]);
		   			}
		   			else if (res.body.email) {
		   				error(email, res.body.email[0]);
		   			}
		   			else if (res.body.password) {
		   				error(password, res.body.password[0]);
		   			}
		   			else if (res.body.name) {
		   				error(name, res.body.name[0]);
		   			}
		   			else if (res.body.phone) {
		   				error(phone, res.body.phone[0]);
		   			}
		   			else if (res.body.address) {
		   				error(address, res.body.address[0]);
		   			}
		   			else if (res.body.postal) {
		   				error(postal, res.body.postal[0]);
		   			}
		   			else if (res.body.country) {
		   				error(country, res.body.country[0]);
		   			}
		   		}
		   	})
		   	.catch(err => {
      			// err.message, err.response
      			console.log(err.message);
   			});


	});
}




/*******************************\
|    ANIMAL SELECT - OPTIONS    |
\*******************************/

let animal = document.querySelector("select[name='animals']");
if (animal) {
	animal.addEventListener("change", e => {

		let token = document.querySelector("input[name='_token']");
		let animals = document.querySelector("select[name='animals']");
		let data = { "_token": token.value, "animal": animals.value };

		//console.log(animals.value);
		if (animals.value == 0 || animals.value == '' || animals.value == null || animals.value == undefined) {
			return false;
		}

		request
		   	.post('/animal_config')
		   	.send(data)
		   	.set('Accept', 'application/json')
		   	.then(res => {
		   		//console.log(res);
		   		if (res.body.message == 'ok') {
		   			//console.log(res.body.result.breeds.length);
		   			$(".sale-row .select-sale").css("display", "none");
		   			$("input[name='conditions']").parent().css("display", "none");
		   			$(".temperament-ok").css("display", "none");

		   			if (animals.value == 1) {
		   				let breedso = "<option value='0'>Make a selection</option>";

		   				for (var i = 0; i <= res.body.result.breeds.length - 1; i++) {
		   					breedso += "<option value='"+res.body.result.breeds[i].breed_id+"'>"+res.body.result.breeds[i].name+"</option>";
		   				}

		   				$("select[name='animals']").parent().css("display", "block");
		   				$("select[name='breeds']").html(breedso).parent().css("display", "block");
		   				$("select[name='categories']").parent().css("display", "block");
		   				$("input[name='number_of_head']").parent().css("display", "block");
		   				$("select[name='ages']").parent().css("display", "block");
		   				$("input[name='weight']").parent().css("display", "block");
		   				$("select[name='vaccinations']").parent().css("display", "block");
		   				$("select[name='horns']").parent().css("display", "block");
		   				$("input[name='conditions']").parent().css("display", "block");	
		   			}

		   			else if (animals.value == 2) {
		   				let breedso = "<option value='0'>Make a selection</option>",
		   					coloro = "<option value='0'>Make a selection</option>",
		   					gendero = "<option value='0'>Make a selection</option>";

		   				for (var i = 0; i <= res.body.result.breeds.length - 1; i++) {
		   					breedso += "<option value='"+res.body.result.breeds[i].breed_id+"'>"+res.body.result.breeds[i].name+"</option>";
		   				}

		   				for (var i = 0; i <= res.body.result.color.length - 1; i++) {
		   					coloro += "<option value='"+res.body.result.color[i].color_id+"'>"+res.body.result.color[i].name+"</option>";
		   				}

		   				for (var i = 0; i <= res.body.result.genders.length - 1; i++) {
		   					gendero += "<option value='"+res.body.result.genders[i].gender_id+"'>"+res.body.result.genders[i].name+"</option>";
		   				}

		   				$("select[name='animals']").parent().css("display", "block");
		   				$("select[name='genders']").html(gendero).parent().css("display", "block");
		   				$("select[name='breeds']").html(breedso).parent().css("display", "block");
		   				$("select[name='colors']").html(coloro).parent().css("display", "block");
		   				$("select[name='discipline']").parent().css("display", "block");
		   				$("select[name='ages']").parent().css("display", "block");
		   				$(".temperament-ok").css("display", "block");
		   				$("select[name='categories']").css("display", "block");
		   			}

		   			else if (animals.value == 3) {

		   				let breedso = "<option value='0'>Make a selection</option>",
		   					classo = "<option value='0'>Make a selection</option>",
		   					gendero = "<option value='0'>Make a selection</option>";

		   				for (var i = 0; i <= res.body.result.breeds.length - 1; i++) {
		   					breedso += "<option value='"+res.body.result.breeds[i].breed_id+"'>"+res.body.result.breeds[i].name+"</option>";
		   				}

		   				for (var i = 0; i <= res.body.result.class.length - 1; i++) {
		   					classo += "<option value='"+res.body.result.class[i].class_id+"'>"+res.body.result.class[i].name+"</option>";
		   				}

		   				for (var i = 0; i <= res.body.result.genders.length - 1; i++) {
		   					gendero += "<option value='"+res.body.result.genders[i].gender_id+"'>"+res.body.result.genders[i].name+"</option>";
		   				}

		   				$("select[name='animals']").parent().css("display", "block");
		   				$("select[name='breeds']").html(breedso).parent().css("display", "block");
		   				$("select[name='genders']").html(gendero).parent().css("display", "block");
		   				$("select[name='class']").html(classo).parent().css("display", "block");
		   				$("input[name='number_of_head']").parent().css("display", "block");
		   				$("select[name='ages']").parent().css("display", "block");
		   				$("select[name='horns']").parent().css("display", "block");
		   				$("input[name='weight']").parent().css("display", "block");
		   			}

		   			else if (animals.value == 4) {

		   				let breedso = "<option value='0'>Make a selection</option>",
		   					classo = "<option value='0'>Make a selection</option>",
		   					gendero = "<option value='0'>Make a selection</option>";

		   				for (var i = 0; i <= res.body.result.breeds.length - 1; i++) {
		   					breedso += "<option value='"+res.body.result.breeds[i].breed_id+"'>"+res.body.result.breeds[i].name+"</option>";
		   				}

		   				for (var i = 0; i <= res.body.result.class.length - 1; i++) {
		   					classo += "<option value='"+res.body.result.class[i].class_id+"'>"+res.body.result.class[i].name+"</option>";
		   				}

		   				for (var i = 0; i <= res.body.result.genders.length - 1; i++) {
		   					gendero += "<option value='"+res.body.result.genders[i].gender_id+"'>"+res.body.result.genders[i].name+"</option>";
		   				}

		   				$("select[name='animals']").parent().css("display", "block");
		   				$("select[name='breeds']").html(breedso).parent().css("display", "block");
		   				$("select[name='genders']").html(gendero).parent().css("display", "block");
		   				$("select[name='class']").html(classo).parent().css("display", "block");
		   				$("select[name='type']").parent().css("display", "block");
		   				$("select[name='horns']").parent().css("display", "block");
		   				$("select[name='ages']").parent().css("display", "block");
		   				$("input[name='number_of_head']").parent().css("display", "block");
		   				$("input[name='weight']").parent().css("display", "block");
		   			}

		   			else if (animals.value == 5) {

		   				let breedso = "<option value='0'>Make a selection</option>",
		   					classo = "<option value='0'>Make a selection</option>",
		   					gendero = "<option value='0'>Make a selection</option>";

		   				for (var i = 0; i <= res.body.result.breeds.length - 1; i++) {
		   					breedso += "<option value='"+res.body.result.breeds[i].breed_id+"'>"+res.body.result.breeds[i].name+"</option>";
		   				}

		   				for (var i = 0; i <= res.body.result.class.length - 1; i++) {
		   					classo += "<option value='"+res.body.result.class[i].class_id+"'>"+res.body.result.class[i].name+"</option>";
		   				}

		   				for (var i = 0; i <= res.body.result.genders.length - 1; i++) {
		   					gendero += "<option value='"+res.body.result.genders[i].gender_id+"'>"+res.body.result.genders[i].name+"</option>";
		   				}

		   				$("select[name='animals']").parent().css("display", "block");
		   				$("select[name='breeds']").html(breedso).parent().css("display", "block");
		   				$("select[name='genders']").html(gendero).parent().css("display", "block");
		   				$("select[name='class']").html(classo).parent().css("display", "block");
		   				$("select[name='ages']").parent().css("display", "block");
		   				$("input[name='number_of_head']").parent().css("display", "block");
		   				$("input[name='weight']").parent().css("display", "block");
		   			}

		   			else if (animals.value == 6) {

		   				let breedso = "<option value='0'>Make a selection</option>",
		   					gendero = "<option value='0'>Make a selection</option>",
		   					coloro = "<option value='0'>Make a selection</option>";

		   				for (var i = 0; i <= res.body.result.breeds.length - 1; i++) {
		   					breedso += "<option value='"+res.body.result.breeds[i].breed_id+"'>"+res.body.result.breeds[i].name+"</option>";
		   				}

		   				for (var i = 0; i <= res.body.result.genders.length - 1; i++) {
		   					gendero += "<option value='"+res.body.result.genders[i].gender_id+"'>"+res.body.result.genders[i].name+"</option>";
		   				}

		   				for (var i = 0; i <= res.body.result.color.length - 1; i++) {
		   					coloro += "<option value='"+res.body.result.color[i].color_id+"'>"+res.body.result.color[i].name+"</option>";
		   				}

		   				$("select[name='animals']").parent().css("display", "block");
		   				$("select[name='ages']").parent().css("display", "block");
		   				$("select[name='colors']").html(coloro).parent().css("display", "block");
		   				$("select[name='breeds']").html(breedso).parent().css("display", "block");
		   				$("select[name='genders']").html(gendero).parent().css("display", "block");
		   				$("select[name='size']").parent().css("display", "block");
		   			}

		   			else if (animals.value == 7) {

		   				let breedso = "<option value='0'>Make a selection</option>",
		   					gendero = "<option value='0'>Make a selection</option>",
		   					coloro = "<option value='0'>Make a selection</option>";

		   				for (var i = 0; i <= res.body.result.breeds.length - 1; i++) {
		   					breedso += "<option value='"+res.body.result.breeds[i].breed_id+"'>"+res.body.result.breeds[i].name+"</option>";
		   				}

		   				for (var i = 0; i <= res.body.result.genders.length - 1; i++) {
		   					gendero += "<option value='"+res.body.result.genders[i].gender_id+"'>"+res.body.result.genders[i].name+"</option>";
		   				}

		   				for (var i = 0; i <= res.body.result.color.length - 1; i++) {
		   					coloro += "<option value='"+res.body.result.color[i].color_id+"'>"+res.body.result.color[i].name+"</option>";
		   				}

		   				$("select[name='animals']").parent().css("display", "block");
		   				$("select[name='ages']").parent().css("display", "block");
		   				$("select[name='colors']").html(coloro).parent().css("display", "block");
		   				$("select[name='breeds']").html(breedso).parent().css("display", "block");
		   				$("select[name='genders']").html(gendero).parent().css("display", "block")
		   				$("select[name='size']").parent().css("display", "block");
		   				$("select[name='declawed']").parent().css("display", "block");
		   			}
		   		}
		   	})
		   	.catch(err => {
      			// err.message, err.response
      			console.log(err.message);
   			});

	});
}



/**************************\
|     Remover Animal       |
\**************************/

let botton_remove = document.querySelectorAll(".botton-remove");
let idAnimal;
if (botton_remove) {
	for (var i = 0; i <= botton_remove.length - 1; i++) {
		botton_remove[i].addEventListener("click", e => {
			e.preventDefault();
			$("#animal_remove").css("display", "block");
			idAnimal = e.target.getAttribute("data-animal");
		});
	}
}



/*********************\
|     Post Again      |
\*********************/

let botton_public = document.querySelectorAll(".botton-public");
if (botton_public) {
	for (var i = 0; i <= botton_public.length - 1; i++) {
		botton_public[i].addEventListener("click", e => {
			e.preventDefault();
			$(".btn-list").removeClass("post-a__gain");
			$(e.target).parent(".btn-list").addClass("post-a__gain");
			$("#animal_again-post").css("display", "block");
		});
	}
}



let accpt_remove = document.querySelector(".accpt_remove");
if (accpt_remove) {
	accpt_remove.addEventListener("click", e => {
		e.preventDefault();

		let token = document.querySelector("input[name='_token']").value;
		let animal_id = idAnimal;

		data = {
			"idAnimal": animal_id,
			"_token": token
		};

		$("#loading").css("display", "block");
		$("#animal_remove").css("display", "none");

		request
		   	.post('/myaccount/removeAnimal')
		   	.send(data)
		   	.set('Accept', 'application/json')
		   	.then(res => {
		   		//console.log(res);
		   		if (res.body.message == 'ok') {
		   			$(".botton-remove[data-animal='"+animal_id+"']").parent().parent().parent().remove();
		   			$("#loading").css("display", "none");
		   		}
		   		else if (res.body.message == 'not_delete') {
		   			$("#error_report .container-form h3").html("An error occurred while trying to delete the post");
		   			$("#loading").css("display", "none");
		   			$("#error_report").css("display", "block");
		   		}
		   		else if (res.body.message == 'not_user_animal') {
		   			$("#error_report .container-form h3").html("An error occurred while trying to delete the post");
		   			$("#loading").css("display", "none");
		   			$("#error_report").css("display", "block");
		   		}
		   		else if (res.body.message == 'not_parameters') {
		   			$("#error_report .container-form h3").html("An error occurred while trying to delete the post");
		   			$("#loading").css("display", "none");
		   			$("#error_report").css("display", "block");
		   		}
		   		else {
		   			$("#error_report .container-form h3").html("An error occurred while trying to delete the post");
		   			$("#loading").css("display", "none");
		   			$("#error_report").css("display", "block");
		   		}
		   	})
		   	.catch(err => {
      			// err.message, err.response
      			console.log(err.message);
   			});

	});
}


let edit_animal = document.querySelector(".edit_animal-button");
if (edit_animal) {
	
	initFile();

	edit_animal.addEventListener("click", e => {
		bPreguntar = false;
		$("#loading").css("display", "block");
	})

	bPreguntar = true;
}


/**************************\
|     Remove - Animal      |
\**************************/

let cancel_remove = document.querySelector(".cancel_remove");
if (cancel_remove) {
	cancel_remove.addEventListener("click", e => {
		e.preventDefault();
		$("#animal_remove").css("display", "none");
	});
}


/**************************\
|     Repost - Animal      |
\**************************/

let cancel_again = document.querySelector(".cancel_again");
if (cancel_again) {
	cancel_again.addEventListener("click", e => {
		e.preventDefault();
		$("#animal_again-post").css("display", "none");
	});
}



/********************************\
|     Again - Animal-accept      |
\********************************/

let accpt_again = document.querySelector(".accpt_again");
if (accpt_again) {
	accpt_again.addEventListener("click", postAgain);
}



/**************************\
|     Animal - Active      |
\**************************/
let col_animal = document.querySelectorAll(".content-serch .col-animal");
if (col_animal) {
	searchWP();
	for (let i = 0; i <= col_animal.length - 1; i++) {
        col_animal[i].addEventListener('click', function(e) {
        	$(".col-animal").removeClass("active-animal");
        	$(this).addClass("active-animal");
        });
    }
}

/**************************\
|     search input         |
\**************************/
let search = document.querySelector(".search input");
if (search) {
	search.addEventListener('input', function(e) {
		searchWP();
	});
}


/****************************\
|     search selects         |
\****************************/
let filtros = document.querySelectorAll(".row-filtros select");
if (filtros) {

	for (let i = 0; i <= filtros.length - 1; i++) {
        filtros[i].addEventListener('change', function(e) {
        	searchWP();
        });
    }
}


/**********************************\
|     ACTIVAR MAPA DEL FILTRO      |
\**********************************/
$(".go-to_map").click(initialize);



/***************************\
|     SETTINGS GUARDAR      |
\***************************/
let save_radio = document.querySelector(".save-radio");
if (save_radio) {
	save_radio.addEventListener("click", function() {
		let email_favorite = document.querySelector("input[name='email_favorite']");
		let email_update = document.querySelector("input[name='email_update']");
		let receive_text = document.querySelector("input[name='receive_text']");
		let token = document.querySelector("input[name='_token']");
		let email_favoriteq = 0;
		let email_updateq = 0;
		let receive_textq = 0;

		if ($(email_favorite).is(":checked")) {
			email_favoriteq = 1;
		}

		if ($(email_update).is(":checked")) {
			email_updateq = 1;
		}

		if ($(receive_text).is(":checked")) {
			receive_textq = 1;
		}

		$("#loading .wrapper-form img").css("display", "block");
		$("#loading").fadeIn();

		let data = {
			"email_favorite": email_favoriteq,
			"email_update": email_updateq,
			"receive_text": receive_textq,
			"_token": token.value
		};


		request
		   	.post('/saveSettings')
		   	.send(data)
		   	.set('Accept', 'application/json')
		   	.then(res => {
		   		//console.log(res.body);
		   		if (res.body.message == 'ok') {
		   			console.log("es ok");
		   			$("#loading .wrapper-form img").css("display", "none");
		   			$("#loading .wrapper-form").append("<div class='container-form'> <h2> Successfully added </h2> </div>");
		   			setTimeout(function() {
		   				$("#loading").fadeOut();
						$("#loading .wrapper-form .container-form").remove();
		   			}, 2000);
		   		}
		   		else if (res.body.message == 'error_save') {
		   			$("#loading .wrapper-form img").css("display", "none");
		   			$("#loading .wrapper-form").append("<div class='container-form'> <h2> An error occurred, try again later </h2> </div>");
		   			setTimeout(function() {
		   				$("#loading").fadeOut();
						$("#loading .wrapper-form .container-form").remove();
		   			}, 2000);
		   		}
		   		else {
		   			$("#loading .wrapper-form img").css("display", "none");
		   			$("#loading .wrapper-form").append("<div class='container-form'> <h2> An error occurred, try again later </h2> </div>");
		   			setTimeout(function() {
		   				$("#loading").fadeOut();
						$("#loading .wrapper-form .container-form").remove();
		   			}, 2000);
		   		}
		   	})
		   	.catch(err => {
      			// err.message, err.response
      			console.log(err.message);
      			//error(password_confirm, "A problem happened, try again later");
   			});

	});
}



/*****************\
|  IMAGEN PERFIL  |
\*****************/
let image = document.querySelector("input[name='upload']");
if (image) {

	$(image).change(function(e) {
     	addImage(e);
     	let img = document.querySelector("#upload");
     	let token = document.querySelector("input[name='_token']");

     	if (img.value != '' && img.value != null && img.value != undefined) {


     		var formData = new FormData(document.getElementById("formupload"));
	        //formData.append("img", img);
	        formData.append( "_token", token.value);

     		request
		   	.post('/saveImgMyaccount')
		   	.send(formData)
		   	.set('Accept', 'application/json')
		   	.then(res => {
		   		//console.log(res.body);
		   		if (res.body.message == 'ok') {
		   			$("#img_changue h2").html("Your profile picture was changed correctly");
		   			$("#img_changue").css("display", "block");
		   			setTimeout(function(){ $("#img_changue").fadeOut(300) }, 2500);
		   		}
		   		else {
		   			$("#img_changue h2").html("An error occurred, try again later");
		   			$("#img_changue").css("display", "block");
		   			setTimeout(function(){ $("#img_changue").fadeOut(300) }, 2500);
		   		}
		   	})
		   	.catch(err => {
      			// err.message, err.response
      			console.log(err.message);
      			//error(password_confirm, "A problem happened, try again later");
   			});
     	}

    });
}




/*********************\
|      FUNCIONES      |
\*********************/

function validar_email( email ) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}

function error(element, msg) {
	$(element)
		//.css("margin-bottom", "0px")
		.after("<span class='err' style='display:block;color:red'>"+msg+"</span>");
}


function addImage(e){
    var file = e.target.files[0],
    imageType = /image.*/;
    
    if (!file.type.match(imageType))
    	return;
  
    	var reader = new FileReader();
      	reader.onload = function(e){
        	var result=e.target.result;
        	$('#imgSalida').css("background-image", "url("+result+")").css("display", "block");
        	$('.img_mini').css("background-image", "url("+result+")");
    	}
      	reader.readAsDataURL(file);
}

function espacios_blanco_none(valor) {
	var noValido = /\s/;

	if (noValido.test(valor)) {
	    return false;
	}

	return true;
}


var format = function(num) {

    var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(".") > 0) {
        parts = str.split(".");
        str = parts[0];
    }
    str = str.split("").reverse();
    for(var j = 0, len = str.length; j < len; j++) {
        if(str[j] != ",") {
            output.push(str[j]);
            if(i%3 == 0 && j < (len - 1)) {
                output.push(",");
            }
            i++;
        }
    }
    formatted = output.reverse().join("");
    return(formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    //return("$" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
};



function precio_planes() {
	let planSelect = document.querySelector("input[name='planSelect']").value;
	let animal = document.querySelector("select[name='animals']");

	if (animal == null || animal == false || animal == undefined) {
		animal = document.querySelector("input[name='animal_d']");
	}

	if (animal.value == 6) {
		if (planSelect == 1) { total = 0; }
		else if (planSelect == 2) { total = 5; }
		else if (planSelect == 3) { total = 10; }
	}
	else {
		if (planSelect == 1) { total = 0; }
		else if (planSelect == 2) { total = 10; }
		else if (planSelect == 3) { total = 20; }
	}

	return total;
}


function initFile(max = null) {
	let filepond = document.querySelector("input[name='filepond[]']");
	if (filepond) {
		// Get a reference to the file input element
		var inputElement = document.querySelector('input[type="file"]');
		
		if (max != null) {
			console.log("entro");
			inputElement.setAttribute("data-max-files", max);			
		}

		FilePond.registerPlugin(FilePondPluginFileValidateType);
		FilePond.registerPlugin(FilePondPluginFileEncode);
		FilePond.registerPlugin(FilePondPluginFileValidateSize);

		// Create the FilePond instance
		var pond = FilePond.create(inputElement, {
			labelIdle: "<h2> Upload Image </h2>",
			checkValidity: true,
			allowFileEncode: true,
			getFileEncodeDataURL: false,
			acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg']
		});


		var pondDemoMultiple = pond;
        var pondMultipleTimeout;
        pondDemoMultiple.onwarning = function() {
            var container = pondDemoMultiple.element.parentNode;
            var error = container.querySelector('p.filepond--warning');
            var numer = 0;
            if (!error) {
                error = document.createElement('p');
                error.className = 'filepond--warning';

                if ($("input[name='planSelect']").val() == 1) {
                	numer = 1;
                }
                if ($("input[name='planSelect']").val() == 2) {
                	numer = 5;
                }

                $(".err").remove();
                error.textContent = 'The maximum number of files is '+numer;
                container.appendChild(error);
            }
            requestAnimationFrame(function() {
                error.dataset.state = 'visible';
            });
            clearTimeout(pondMultipleTimeout);
            pondMultipleTimeout = setTimeout(function() {
                error.dataset.state = 'hidden';
            }, 5000);
        };
        pondDemoMultiple.onaddfile = function() {
            clearTimeout(pondMultipleTimeout);
            var container = pondDemoMultiple.element.parentNode;
            var error = container.querySelector('p.filepond--warning');
            if (error) {
                error.dataset.state = 'hidden';
            }
        };
	}
}



function searchWP() {

	let selector = ".back-animal";
	let selector2 = ", .list-animal";
	let animal = $("select[name='animal-search']").val();
	let breeds = $("select[name='breeds']").val();
	let colors = $("select[name='colors']").val();
	let age = $("select[name='age']").val();
	let gender = $("select[name='gender']").val();
	let discipline = $("select[name='discipline']").val();
	let search = $(".search input").val();
	let price_filtro = $("#price_filtro").val();
	let state = $("select[name='estado']").val();
	let vaccination = $("select[name='vaccination']").val();
	let horns = $("select[name='horns']").val();
	let categorie = $("select[name='categorie']").val();
	let types = $("select[name='type']").val();
	let clase = $("select[name='class']").val();
	let size = $("select[name='size']").val();

	if (animal != null && animal != 0 && animal != '') {
		selector += "[data-animal='"+animal+"']";
		selector2 += "[data-animal='"+animal+"']";
	}

	if (breeds != null && breeds != 0 && breeds != '') {
		selector += "[data-breed='"+breeds+"']";
		selector2 += "[data-breed='"+breeds+"']";
	}

	if (vaccination != null && vaccination != 0 && vaccination != '') {
		selector += "[data-vaccination='"+vaccination+"']";
		selector2 += "[data-vaccination='"+vaccination+"']";
	}

	if (types != null && types != 0 && types != '') {
		selector += "[data-type='"+types+"']";
		selector2 += "[data-type='"+types+"']";
	}

	if (size != null && size != 0 && size != '') {
		selector += "[data-size='"+size+"']";
		selector2 += "[data-size='"+size+"']";
	}

	if (clase != null && clase != 0 && clase != '') {
		selector += "[data-class='"+clase+"']";
		selector2 += "[data-class='"+clase+"']";
	}

	if (horns != null && horns != 0 && horns != '') {
		selector += "[data-horns='"+horns+"']";
		selector2 += "[data-horns='"+horns+"']";
	}

	if (categorie != null && categorie != 0 && categorie != '') {
		selector += "[data-categorie='"+categorie+"']";
		selector2 += "[data-categorie='"+categorie+"']";
	}

	if (colors != null && colors != 0 && colors != '') {
		selector += "[data-color='"+colors+"']";
		selector2 += "[data-color='"+colors+"']";
	}

	if (age != null && age != 0 && age != '') {
		selector += "[data-age='"+age+"']";
		selector2 += "[data-age='"+age+"']";
	}

	if (gender != null && gender != 0 && gender != '') {
		selector += "[data-gender='"+gender+"']";
		selector2 += "[data-gender='"+gender+"']";
	}

	if (discipline != null && discipline != 0 && discipline != '') {
		selector += "[data-discipline='"+discipline+"']";
		selector2 += "[data-discipline='"+discipline+"']";
	}

	if (search != '' && search != null) {
		selector += "[data-description *= '"+search+"' i]";
		selector2 += "[data-description *= '"+search+"' i]";
	}

	if (state != '' && state != null && state != undefined && state != 0) {
		selector += "[data-state='"+state+"']";
		selector2 += "[data-state='"+state+"']";
	}

	//console.log(selector);
	//console.log(selector2);

	$(".back-animal, .list-animal").css("display", "none");
	$(selector + selector2).css("display", "block");

	if (price_filtro != 0 && price_filtro != null) {
		$(".back-animal[style*='block'], .list-animal[style*='block']").each(function() {
			let precio = $(this).attr("data-price");
			if (parseFloat(precio) <= parseFloat(price_filtro)) {
				$(this).css("display", "block");
			}
			else {
				$(this).css("display", "none");
			}
		});
	}

	//dar mensaje si no hay animales
	cuentas = $(".back-animal:visible").length;
	//console.log(cuentas);
	if (cuentas <= 0 || cuentas == null || cuentas == undefined || cuentas == '') {
		$(".row-vista .msj-not, .row-lista .msj-not").remove();
		$(".row-vista, .row-lista").append("<h2 class='msj-not' style='text-align: center'>No animals yet</h2>");
	}
	else if (cuentas > 0) {
		$(".row-vista .msj-not, .row-lista .msj-not").remove();
	}

	//cordenadas();
}


function stripeResponseHandler(status, response) {
    if (response.error) {
        $('.error')
            .removeClass('hide')
            .find('.alert')
            .text(response.error.message);
        $("#loading").css("display", "none");
    } else {
        // token contains id, last4, and card type
        var token = response['id'];
        // insert the token into the form so it gets submitted to the server
        $form.find('input[type=text]').empty();
        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        $form.get(0).submit();
    }
}



function initialize(e) {
	e.preventDefault();

	if ($(".back-animal").is(":visible") == false && $(".list-animal").is(":visible") == false) {
		return false;
	}


	var locationArray = [];
	var address = [];
	$(".back-animal[style*='block']").each(function() {
		let ficha = '<a href="'+ $(this).find("a").attr('href')+'">' 
						+'<div class="img-lista" style="background-image: url('+$(this).find(".img-lista").attr('src')+')"></div>'
						+'<h3 class="fz-20 mt-10"> '+$(this).attr('data-titulo')+ '</h3>'
						+'<p class="mb-20"><strong><em>Price: $'+$(this).attr('data-price_other')+'</em></strong></p>';
					+'</a>'

		address.push( { address: $(this).attr('data-address'), "ficha": ficha  } );
	});

    if (address == '') {
        return false;
    }


    var geocoder = new google.maps.Geocoder();
    for (let i = 0; i <= address.length - 1; i++) {
    	geocoder.geocode({ 'address': address[i].address}, function(results, status) {
            if (status == 'OK') {
                var latitud = results[0].geometry.location.lat();
                var longitud = results[0].geometry.location.lng();
                locationArray[i] = [ address[i], latitud, longitud ];

         		var ultimo = locationArray.length - 1;
                var map = new google.maps.Map(document.getElementById('map-canvas'), {
					zoom: 4,
					center: new google.maps.LatLng(39.7396016, -102.976532),
					mapTypeId: google.maps.MapTypeId.ROADMAP
				});

                var infowindow = new google.maps.InfoWindow();
  				var marker, j;
                for (j = 0; j <= locationArray.length - 1; j++) {  
					marker = new google.maps.Marker({
						position: new google.maps.LatLng(locationArray[j][1], locationArray[j][2]),
						map: map
					});

					google.maps.event.addListener(marker, 'mouseover', (function(marker, j) {

						let fichas = locationArray.filter(function(otro, index, prototipo) {
							if (otro[2] == locationArray[j][2] && otro[1] == locationArray[j][1]) {
								return otro;
							}
						});

						return function() {
							let content = '';
							for (var b = 0; b <= fichas.length - 1; b++) {
								content += fichas[b][0].ficha;
							}

					    	infowindow.setContent(content);
					    	infowindow.open(map, marker);	
					  	}

					})(marker, j));
					// google.maps.event.addListener(marker, 'mouseout', (function(marker, j) {
					// 	return function() {
					// 		infowindow.close();
					//   	}
					// })(marker, j));
				}

				$("#show-map").css("display", "block");

            }
            else {
                console.log("Geocoding no tuvo éxito debido a: " + status);
            }
        });
    }
}



function postAgain(e) {

	e.preventDefault();
	let idAnimal = document.querySelector(".post-a__gain .botton-public").getAttribute("data-animal");
	let data = {
		"id_animal": idAnimal,
		"_token": document.querySelector("input[name='_token']").value
	};

	$("#animal_again-post").css("display", "none");
	$("#loading").css("display", "block");

	request
	   	.post('/postagain')
	   	.send(data)
	   	.set('Accept', 'application/json')
	   	.then(res => {
	   		//console.log(res.body);
	   		if (res.body.message == 'ok') {
	   			$(".post-a__gain .botton-public").remove();
	   			$(".post-a__gain .botton-remove").remove();

	   			$(".post-a__gain").append('<a href="#" class="mw-150 btn btn-primary sold" data-animal="'+idAnimal+'">Sold</a>');
	   			let sold = document.querySelectorAll(".sold");
				let animal_id = "";
				if (sold) {
					for (var i = 0; i <= sold.length - 1; i++) {
						sold[i].addEventListener("click", e => {
							e.preventDefault();
							$("#calificacion").css("display", "block");
							animal_id = e.target.getAttribute("data-animal");
							$(e.target).parent(".btn-list").addClass("bonti")
						});
					}
				}

				$("#loading").css("display", "none");
	   		}
	   		else {
	   			if (res.body.input == 'not_parameters') {
	   				$("#error_report h3").html("An error occurred, please try again later");
		   			$("#loading").css("display", "none");
		   			$("#error_report").css("display", "block");
	   			}
	   			else if (res.body.input == 'not_animal') {
	   				$("#error_report h3").html("An error occurred, please try again later");
		   			$("#loading").css("display", "none");
		   			$("#error_report").css("display", "block");
	   			}
	   		}
	   	})
	   	.catch(err => {
			// err.message, err.response
			console.log(err.message);
		});	
}