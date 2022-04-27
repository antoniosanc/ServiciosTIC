$().ready(function() {

$(".image_effects").on({
	 "mouseover" : function() {
		$( this ).addClass( "pulse" );
	  },
	  "mouseout" : function() {
		$( ".image_effects" ).one( 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){ $(this).removeClass( "pulse" ); } );
	  }
});
$(".image_effects2").on({
	 "mouseover" : function() {
		$( this ).addClass( "wobble" );
	  },
	  "mouseout" : function() {
		$( ".image_effects2" ).one( 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){ $(this).removeClass( "wobble" ); } );
	  }
});


/*$('ul.nav li.dropdown').hover(function(){
       $(this).children('ul.dropdown-menu').slideDown(200);
		return false;
    }, function(){
       $(this).children('ul.dropdown-menu').slideUp(200); 
		return false;
});*/

	$('ul.nav li.dropdown').hover(function() {
		if (!$('.navbar-toggle').is(':visible')) {
			$(this).toggleClass('open', true);
		}
	}, function() {
		if (!$('.navbar-toggle').is(':visible')) {
			$(this).toggleClass('open', false);
		}
	});
	$('ul.nav li.dropdown a').click(function(){
		if (!$('.navbar-toggle').is(':visible') && $(this).attr('href') != '#') {
			$(this).toggleClass('open', false);
			window.location = $(this).attr('href')
		}
	});

$("#frm_contacto").validate({
		rules: {
			contacto_nombre: {
				required: true,
				minlength: 5
			},
			contacto_email: {
				required: true,
				email: true
			},
			contacto_telefono: {
				required: true,
				digits: true
			},
			contacto_direccion: {
				required: true,
				minlength: 5
			},
			contacto_asunto: {
				required: true,
				minlength: 10
			},
			contacto_comentario: {
				required: true,
				minlength: 30
			}
		},
		messages: {
			contacto_nombre: {
				required: "Escriba su nombre o el de su empresa",
				minlength: "Escriba su nombre completo o el de su empresa"
			},
			contacto_email: {
				required: "Ingrese un correo electr&oacute;nico v&aacute;lido",
				email: "Escriba una direcci&oacute;n de Correo electr&oacute;nico correcta."
			},
			contacto_telefono: {
				required: "Es necesario ingresar su tel&eacute;fono de contacto",
				digits: "Escriba solo n&uacute;meros."
			},
			contacto_direccion: {
				required: "Escriba de donde nos contacta",
				minlength: "Escriba su direcci&oacute;n de contacto completa"
			},
			contacto_asunto: {
				required: "Escriba un asunto de contacto",
				minlength: "El asunto debe ser m&aacute;s especifico"
			},
			contacto_comentario: {
				required: "Ingrese su comentario",
				minlength: "Su comentario debe ser m&aacute;s especifico"
			}
		}
	});
	
	$("#frm_solicita_soporte").validate({
		rules: {
			solicita_soporte_nombre: {
				required: true,
				minlength: 5
			},
			solicita_soporte_telefono: {
				required: true,
				digits: true
			},
			solicita_soporte_email: {
				required: true,
				email: true
			},
			solicita_soporte_comentario: {
				required: false,
				minlength: 10
			}
		}
	});
	
	
});