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

$(".bouncer").on({
	 "mouseover" : function() {
		$( this ).addClass( "bounce" );
	  },
	  "mouseout" : function() {
		$( ".bouncer" ).one( 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){ $(this).removeClass( "bounce" ); } );
	  }
});

$(".replace").on({
	 "mouseover" : function() {
		var img = $( this ).attr("src");	
		nimg = img.replace(".jpg","");
		
		$( this ).attr("src", nimg + "_r" + ".jpg"  );
	  },
	  "mouseout" : function() {
		$( this ).attr("src", nimg +  ".jpg" );
	  }
});

	$('[data-toggle="tooltip"]').tooltip();

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
				required: "Ingrese un correo electrónico válido",
				email: "Escriba una dirección de Correo electrónico correcta."
			},
			contacto_telefono: {
				required: "Es necesario ingresar su teléfono de contacto",
				digits: "Escriba solo números."
			},
			contacto_direccion: {
				required: "Escriba de donde nos contacta",
				minlength: "Escriba su dirección de contacto completa"
			},
			contacto_asunto: {
				required: "Escriba un asunto de contacto",
				minlength: "El asunto debe ser más especifico"
			},
			contacto_comentario: {
				required: "Ingrese su comentario",
				minlength: "Su comentario debe ser más especifico"
			}
		}
	});

	$("#frm_contacto_aspel").validate({
		rules: {
			aspel_nombre: {
				required: true,
				minlength: 5
			},
			aspel_email: {
				required: true,
				email: true
			},
			aspel_telefono: {
				required: true,
				digits: true
			},
			aspel_direccion: {
				required: true,
				minlength: 5
			},
			aspel_asunto: {
				required: true,
				minlength: 10
			},
			aspel_comentario: {
				required: true,
				minlength: 30
			}
		},
		messages: {
			aspel_nombre: {
				required: "Escriba su nombre o el de su empresa",
				minlength: "Escriba su nombre completo o el de su empresa"
			},
			aspel_email: {
				required: "Ingrese un correo electrónico válido",
				email: "Escriba una dirección de Correo electrónico correcta."
			},
			aspel_telefono: {
				required: "Es necesario ingresar su teléfono de contacto",
				digits: "Escriba solo números."
			},
			aspel_direccion: {
				required: "Escriba de donde nos contacta",
				minlength: "Escriba su dirección de contacto completa"
			},
			aspel_asunto: {
				required: "Escriba un asunto de contacto",
				minlength: "El asunto debe ser más especifico"
			},
			aspel_comentario: {
				required: "Ingrese su comentario",
				minlength: "Su comentario debe ser más especifico"
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


	/*Tabs*/
	if(!$('#bloque1').hasClass('in'))
	{
	$('#panel1').addClass('icono-menos');
	$('#bloque1').addClass('in');
	}
	       
	/*else{
	$('#panel1').addClass('icono-menos');

	}*/

	$('#panel1').on({
	'click' : function(){

	$("#panel2, #panel3, #panel4, #panel5, #panel6, #panel7").removeClass('icono-menos');
	$("#panel2, #panel3, #panel4, #panel5, #panel6, #panel7").addClass('icono-mas');

	var $valor2 = $('#panel-element-267462').hasClass('in');

	if($valor2){
	$('#panel1').removeClass('icono-menos');
	$('#panel1').addClass('icono-mas');
	}else{
	$('#panel1').removeClass('icono-mas');
	$('#panel1').addClass('icono-menos');
	}
	}
	});
	$('#panel2').on({
	'click' : function(){

	$("#panel1, #panel3, #panel4, #panel5, #panel6, #panel7").removeClass('icono-menos');
	$("#panel1, #panel3, #panel4, #panel5, #panel6, #panel7").addClass('icono-mas');

	var $valor2 = $('#panel-element-267462').hasClass('in');

	if($valor2){
	$('#panel2').removeClass('icono-menos');
	$('#panel2').addClass('icono-mas');
	}else{
	$('#panel2').removeClass('icono-mas');
	$('#panel2').addClass('icono-menos');
	}
	}
	});
	$('#panel3').on({
	'click' : function(){

	$("#panel1, #panel2, #panel4, #panel5, #panel6, #panel7").removeClass('icono-menos');
	$("#panel1, #panel2, #panel4, #panel5, #panel6, #panel7").addClass('icono-mas');

	var $valor2 = $('#panel-element-267463').hasClass('in');

	if($valor2){
	$('#panel3').removeClass('icono-menos');
	$('#panel3').addClass('icono-mas');
	}else{
	$('#panel3').removeClass('icono-mas');
	$('#panel3').addClass('icono-menos');
	}
	}
	});
	$('#panel4').on({
	'click' : function(){

	$("#panel1, #panel2, #panel3, #panel5, #panel6, #panel7").removeClass('icono-menos');
	$("#panel1, #panel2, #panel3, #panel5, #panel6, #panel7").addClass('icono-mas');

	var $valor2 = $('#panel-element-267464').hasClass('in');

	if($valor2){
	$('#panel4').removeClass('icono-menos');
	$('#panel4').addClass('icono-mas');
	}else{
	$('#panel4').removeClass('icono-mas');
	$('#panel4').addClass('icono-menos');
	}
	}
	});
	$('#panel5').on({
	'click' : function(){

	$("#panel1, #panel2, #panel3, #panel4, #panel6, #panel7").removeClass('icono-menos');
	$("#panel1, #panel2, #panel3, #panel4, #panel6, #panel7").addClass('icono-mas');

	var $valor2 = $('#panel-element-267465').hasClass('in');

	if($valor2){
	$('#panel5').removeClass('icono-menos');
	$('#panel5').addClass('icono-mas');
	}else{
	$('#panel5').removeClass('icono-mas');
	$('#panel5').addClass('icono-menos');
	}
	}
	});
	$('#panel6').on({
	'click' : function(){

	$("#panel1, #panel2, #panel3, #panel4, #panel5, #panel7").removeClass('icono-menos');
	$("#panel1, #panel2, #panel3, #panel4, #panel5, #panel7").addClass('icono-mas');

	var $valor2 = $('#panel-element-267466').hasClass('in');

	if($valor2){
	$('#panel6').removeClass('icono-menos');
	$('#panel6').addClass('icono-mas');
	}else{
	$('#panel6').removeClass('icono-mas');
	$('#panel6').addClass('icono-menos');
	}
	}
	});

	$('#panel7').on({
	'click' : function(){

	$("#panel1, #panel2, #panel3, #panel4, #panel5, #panel6").removeClass('icono-menos');
	$("#panel1, #panel2, #panel3, #panel4, #panel5, #panel6").addClass('icono-mas');

	var $valor2 = $('#panel-element-267467').hasClass('in');

	if($valor2){
	$('#panel7').removeClass('icono-menos');
	$('#panel7').addClass('icono-mas');
	}else{
	$('#panel7').removeClass('icono-mas');
	$('#panel7').addClass('icono-menos');
	}
	}
	});
	/*Tabs*/ 
});